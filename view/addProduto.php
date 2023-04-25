<?php 
include("blades/session.php");
require_once '../model/database.php';
require_once '../vendor/autoload.php'; ?>

<!-- IMPORTA A BIBLIOTECA BOOTSTRAP E JQUERY-->
<link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
<script src="../vendor/components/jquery/jquery.min.js"></script>

<?php include("blades/header.php"); ?>

<div class="m-4">
    <h1 class="display-4">Adicionar Produto</h1>
    <hr>
    <a class="btn btn-success" href="dashboardProduto.php">Voltar</a><br><br>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nome" name="nome" placeholder="nome do produto">
            <label for="nome">Nome do Produto</label>
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
        </div><br>
        <div class="input-group mb-3">
            <label class="input-group-text" for="imagem"><strong>Foto do produto</strong></label>
            <input type="file" class="form-control" id="imagem" name="imagem" required> 
        </div><br>
        <button type="submit" name="cadastrar" class="btn btn-primary">Cadastrar</button>
    </form>
</div>

<?php

// SE O BOTÃO 'cadastrar' for clicado armazena os valores dos campos nas variáveis abaixo
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

// SE O BOTÃO 'cadastrar' for clicado executa a função 'criarProduto' e armazena os valores das variáveis no banco
if (isset($_POST["cadastrar"])) {
    $idProduto = criarProduto($nome, $preco, $descricao, $tamanho_array, $quantidade, $especie, $categoria, $nomeImagem);
    if ($idProduto) {
        echo "Produto cadastrado com sucesso. ID do Produto: " . $idProduto;
    } else {
        echo "Erro ao cadastrar o produto.";
    }
}

// DECLARAÇÃO DA FUNÇÃO PARA CADASTRO DO PRODUTO
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

// DECLARAÇÃO DA FUNÇÃO PARA LIMPAR A ENTRADA
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
?>

<!-- IMPORTA BIBLIOTECA JS BOOTSTRAP -->
<script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<?php include("blades/footer.php"); ?>