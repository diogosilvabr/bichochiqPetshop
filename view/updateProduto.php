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
    <div class="container">
        <h1 class="display-4">Atualizar Produto</h1>
        <?php 
            $idProduto = $_POST['id'];
            $produtos = $colecao->findOne(['_id' => new MongoDB\BSON\ObjectID($idProduto)]); ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <input type="text" name="id" value="<?php echo $idProduto; ?>">
            <div class="form-group">
                <label for="nome">Nome do Produto:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $produtos['nome']; ?>">
            </div>
            <div class="form-group">
                <label for="preco">Preço do Produto:</label>
                <input type="text" class="form-control" id="preco" name="preco" value="<?php echo $produtos['preco']; ?>">
            </div>  
            <div class="form-group">
                <label for="descricao">Descrição do Produto:</label>
                <textarea class="form-control" id="descricao" name="descricao"><?php echo $produtos['descricao']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="tamanho">Tamanho:</label>
                <input type="text" class="form-control" id="tamanho" name="tamanho" value="<?php echo $produtos['tamanho']; ?>">
            </div>
            <div class="form-group">
                <label for="quantidade">Quantidade do Produto:</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?php echo $produtos['quantidade']; ?>">
            </div>
            <div class="form-group">
                <label>Espécies:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="especie[]" id="cachorro" value="cachorro"<?php echo ($produtos['especie'] == 'cachorro') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="cachorro">CÃES</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="especie[]" id="gato" value="gato"<?php echo ($produtos['especie'] == 'gato') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="gato">GATOS</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="especie[]" id="ave" value="ave" <?php echo ($produtos['especie'] == 'ave') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="ave">AVES</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="especie[]" id="roedor" value="roedor"<?php echo ($produtos['especie'] == 'roedor') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="roedor">ROEDORES</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="especie[]" id="peixe" value="peixe"<?php echo ($produtos['especie'] == 'peixe') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="peixe">PEIXES</label>
                </div>
            </div>
            <div class="form-group">
                <label for="categoria">Categoria:</label>
                <select class="form-control" id="categoria" name="categoria">
                    <option value=""></option>
                    <option value="banho&tosa" <?php echo ($produtos['categoria'] == 'banho&tosa') ? 'selected' : ''; ?>>BANHO & TOSA</option>
                    <option value="alimentacao" <?php echo ($produtos['categoria'] == 'alimentacao') ? 'selected' : ''; ?>>ALIMENTAÇÃO</option>
                    <option value="medicamentos" <?php echo ($produtos['categoria'] == 'medicamentos') ? 'selected' : ''; ?>>MEDICAMENTOS</option>
                    <option value="acessorios" <?php echo ($produtos['categoria'] == 'acessorios') ? 'selected' : ''; ?>>ACESSÓRIOS</option>
                    <option value="brinquedos" <?php echo ($produtos['categoria'] == 'brinquedos') ? 'selected' : ''; ?>>BRINQUEDOS</option>
                    <option value="cuidados" <?php echo ($produtos['categoria'] == 'cuidados') ? 'selected' : ''; ?>>CUIDADOS</option>
                </select>
            </div>
            <label for="imagem">Imagem do Produto:</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="imagem" name="imagem">
                <label class="custom-file-label" for="imagem">Escolher arquivo</label>
            </div>
            <button type="submit" name="atualizar" class="btn btn-primary">Atualizar</button>
        </form>
    </div>


<?php
if (isset($_POST["atualizar"])) {
    $id = limparEntrada($_POST["id"]);
    $nome = limparEntrada($_POST["nome"]);
    $preco = floatval(limparEntrada($_POST["preco"]));
    $descricao = limparEntrada($_POST["descricao"]);
    $tamanho = limparEntrada($_POST["tamanho"]);
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

    if(isset($_POST["atualizar"])) {
        $produtoAtualizado = atualizarProduto($id, $nome, $preco, $descricao, $quantidade, $tamanho, $especie, $categoria);
        echo "Produto atualizado com sucesso. Número de produtos atualizados:";
        } else {
            echo "Erro ao atualizar produto";
    }
?>
<script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<?php
include("blades/footer.php");
?>