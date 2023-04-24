<?php
include("blades/session.php");
require_once '../model/database.php';
require_once '../vendor/autoload.php';
require_once '../controller/crudProdutos.php';
?>

<link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
<script src="../vendor/components/jquery/jquery.min.js"></script>

<?php
function limparEntrada($entrada)
{
    if (is_array($entrada)) {
        // se a entrada for um array, cria um novo array para armazenar os valores limpos
        $saida = array();
        foreach ($entrada as $chave => $valor) {
            // remove espaços em branco no início e no fim da string
            $saida[$chave] = is_string($valor) ? trim($valor) : $valor;
        }
        return $saida;
    } else {
        // se a entrada não for um array, remove espaços em branco no início e no fim da string
        return is_string($entrada) ? trim($entrada) : $entrada;
    }
}

include("blades/header.php");
?>

<?php
        $idProduto = $_POST['id'];
        $produtos = $colecao->findOne(['_id' => new MongoDB\BSON\ObjectID($idProduto)]);

if (isset($_POST["favoritar"])) {
    $id = "";
    $nome = limparEntrada($produtos['nome']);
    $preco = floatval(limparEntrada($produtos['preco']));
    $descricao = limparEntrada($produtos['descricao']);
    $tamanho_array = limparEntrada(explode(",", $produtos['tamanho']));
    $quantidade = limparEntrada($produtos['quantidade']);
    $especie = limparEntrada($produtos['especie']);
    $categoria = limparEntrada($produtos['categoria']);
    $nomeImagem = $produtos["imagem"];

    // Verifica se foi enviado um arquivo de imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $nomeImagem = $_FILES['imagem']['name'];
        $extensao = pathinfo($nomeImagem, PATHINFO_EXTENSION);
        $destino = 'images/' . $nomeImagem;

        // Verifica se o arquivo é uma imagem válida
        $extensoesPermitidas = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array(strtolower($extensao), $extensoesPermitidas)) {
            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
                // arquivo movido com sucesso
            } else {
                // Tratar erro de tipo de arquivo inválido
            }
        }
    }
}

if (isset($_POST["favoritar"])) {
    $id = addFavorito($nome, $preco, $descricao,  $tamanho_array, $quantidade, $especie, $categoria, $nomeImagem);
} else {
    /* echo "Erro ao atualizar produto"; */
}

function addFavorito($nome, $preco, $descricao, $tamanho, $quantidade, $especies, $categoria, $nomeImagem)
{   
    global $colecaoFav;
    
    // Verifica se $especies é um array
    if (is_array($especies)) {
        // Converte o array em uma string com vírgulas entre os valores
        $especies = implode(',', $especies);

    } 
     if (is_array($tamanho)) {
        $tamanho = implode(',', $tamanho);
    } 
    
    $favorito = array(
        "nome" => $nome,
        "preco" => $preco,
        "descricao" => $descricao,
        "tamanho" => $tamanho,
        "quantidade" => $quantidade,
        "especie" => $especies,
        "categoria" => $categoria,
        "imagem" => $nomeImagem
    );
    $resultado = $colecaoFav->insertOne($favorito);
    return $resultado->getInsertedId();
}

?>
<script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<?php
include("blades/footer.php");
?>