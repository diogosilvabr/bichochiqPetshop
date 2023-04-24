<?php
include("blades/session.php");
require_once '../model/database.php';
require_once '../vendor/autoload.php';
?>
<link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
<script src="../vendor/components/jquery/jquery.min.js"></script>

<?php
// FUNÇÃO RESPONSÁVEL PELO CADASTRO DO PRODUTO
function criarProduto($nome, $preco, $descricao, $tamanho, $quantidade, $especies, $categoria, $nomeImagem)
{   
    global $colecao;
    
    // Verifica se $especies é um array
    if (!is_array($especies)) {
        // Converte o array em uma string com vírgulas entre os valores
        $especies = explode(',', $especies);

    } 
     if (is_array($tamanho)) {
        $tamanho = implode(',', $tamanho);
    } 
    
    $produto = array(
        "nome" => $nome,
        "preco" => $preco,
        "descricao" => $descricao,
        "tamanho" => $tamanho,
        "quantidade" => $quantidade,
        "especie" => $especies,
        "categoria" => $categoria,
        "imagem" => $nomeImagem
    );
    $resultado = $colecao->insertOne($produto);
    return $resultado->getInsertedId();
}

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
<div class="container">
    <h1 class="display-4">Adicionar Produto</h1><hr>
    <a class="btn btn-success" href="dashboardProduto.php">Voltar</a><br><br>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nome">Nome do Produto:</label>
            <input type="text" class="form-control" id="nome" name="nome">
        </div>
        <div class="form-group">
            <label for="preco">Preço do Produto:</label>
            <input type="text" class="form-control" id="preco" name="preco">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição do Produto:</label>
            <textarea class="form-control" id="descricao" name="descricao"></textarea>
        </div>
        <div class="form-group">
            <label for="tamanho">Tamanho:</label>
            <input type="text" class="form-control" id="tamanho" name="tamanho">
        </div>
        <div class="form-group">
            <label for="quantidade">Quantidade do Produto:</label>
            <input type="number" class="form-control" id="quantidade" name="quantidade">
        </div>
        <div class="form-group">
            <label>Espécies:</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="especie[]" id="cachorro" value="cachorro">
                <label class="form-check-label" for="cachorro">CÃES</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="especie[]" id="gato" value="gato">
                <label class="form-check-label" for="gato">GATOS</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="especie[]" id="ave" value="ave">
                <label class="form-check-label" for="ave">AVES</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="especie[]" id="roedor" value="roedor">
                <label class="form-check-label" for="roedor">ROEDORES</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="especie[]" id="peixe" value="peixe">
                <label class="form-check-label" for="peixe">PEIXES</label>
            </div>
        </div>
        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <select class="form-control" id="categoria" name="categoria">
                <option value=""></option>
                <option value="banho&tosa">BANHO & TOSA</option>
                <option value="alimentacao">ALIMENTAÇÃO</option>
                <option value="medicamentos">MEDICAMENTOS</option>
                <option value="acessorios">ACESSÓRIOS</option>
                <option value="brinquedos">BRINQUEDOS</option>
                <option value="cuidados">CUIDADOS</option>
            </select>
        </div>
        <label for="imagem">Imagem do Produto:</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="imagem" name="imagem">
            <label class="custom-file-label" for="imagem">Escolher arquivo</label>
        </div><br>
        <button type="submit" name="cadastrar" class="btn btn-primary">Cadastrar</button>
    </form>
</div>

<?php 

if (isset($_POST["cadastrar"])) {
    $id = "";
    $nome = limparEntrada($_POST["nome"]);
    $preco = floatval(limparEntrada($_POST["preco"]));
    $descricao = limparEntrada($_POST["descricao"]);
    $tamanho_array = limparEntrada(explode(",", $_POST['tamanho']));
    $quantidade = limparEntrada($_POST["quantidade"]);
    $especie = limparEntrada($_POST["especie"]);
    $categoria = limparEntrada($_POST["categoria"]);
    $nomeImagem = '';

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

if (isset($_POST["cadastrar"])) {
    $idProduto = criarProduto($nome, $preco, $descricao, $tamanho_array, $quantidade, $especie, $categoria, $nomeImagem);
    if ($idProduto) {
        echo "Produto cadastrado com sucesso. ID do Produto: " . $idProduto;
    } else {
        echo "Erro ao cadastrar o produto.";
    }
}
?>
<script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<?php
include("blades/footer.php"); 
?>
