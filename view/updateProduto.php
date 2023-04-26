<?php
include("blades/session.php");
require_once '../model/database.php';
require_once '../vendor/autoload.php';
require_once '../controller/crudProdutos.php'; ?>

<link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
<script src="../vendor/components/jquery/jquery.min.js"></script>

<?php include("blades/header.php"); ?>

<div class="m-4">
    <h1 class="display-4">Atualizar Produto</h1>
    <hr>
    <a class="btn btn-success" href="dashboardProduto.php">Voltar</a><br><br>
    <?php
    $idProduto = $_POST['id'];
    $produtos = $colecao->findOne(['_id' => new MongoDB\BSON\ObjectID($idProduto)]); ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="id">ID do Produto:</label>
            <input type="text" id="id" name="id" value="<?php echo $idProduto; ?>"><br><br>
        </div>
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
            <textarea class="form-control" id="descricao"
                name="descricao"><?php echo $produtos['descricao']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="tamanho">Tamanho:</label>
            <input type="text" class="form-control" id="tamanho" name="tamanho"
                value="<?php echo $produtos['tamanho']; ?>">
        </div>
        <div class="form-group">
            <label for="quantidade">Quantidade do Produto:</label>
            <input type="number" class="form-control" id="quantidade" name="quantidade"
                value="<?php echo $produtos['quantidade']; ?>">
        </div>
        <div class="form-group">
            <label>Espécies:</label><br>
            <?php
            $especies = implode(',', $produtos['especie']->getArrayCopy());
            $especies_array = explode(',', $especies);

            foreach ($especies_array as $especie) {
                $checked = in_array($especie, $especies_array) ? 'checked' : '';
                echo '<div class="form-check form-check-inline">';
                echo '<input class="form-check-input" type="checkbox" name="especie[]" id="' . $especie . '" value="' . $especie . '" ' . $checked . '>';
                echo '<label class="form-check-label" for="' . $especie . '">' . strtoupper($especie) . 'S</label>';
                echo '</div>';
            } ?>
        </div>
        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <select class="form-control" id="categoria" name="categoria">
                <option value=""></option>
                <option value="banho&tosa" <?php echo ($produtos['categoria'] == 'banho&tosa') ? 'selected' : ''; ?>>BANHO
                    & TOSA</option>
                <option value="alimentacao" <?php echo ($produtos['categoria'] == 'alimentacao') ? 'selected' : ''; ?>>
                    ALIMENTAÇÃO</option>
                <option value="medicamentos" <?php echo ($produtos['categoria'] == 'medicamentos') ? 'selected' : ''; ?>>
                    MEDICAMENTOS</option>
                <option value="acessorios" <?php echo ($produtos['categoria'] == 'acessorios') ? 'selected' : ''; ?>>
                    ACESSÓRIOS</option>
                <option value="brinquedos" <?php echo ($produtos['categoria'] == 'brinquedos') ? 'selected' : ''; ?>>
                    BRINQUEDOS</option>
                <option value="cuidados" <?php echo ($produtos['categoria'] == 'cuidados') ? 'selected' : ''; ?>>CUIDADOS
                </option>
            </select>
        </div><br>
        <div class="input-group mb-3">
            <label class="input-group-text" for="imagem"><strong>Foto do produto</strong></label>
            <input type="file" class="form-control" id="imagem" name="imagem" value="<?php echo $produtos['imagem']; ?>">
        </div>
        <button type="submit" name="atualizar" class="btn btn-primary">Atualizar</button>
    </form>
</div>

<?php

// VERIFICA SE O BOTÃO 'atualizar' FOI ACIONADO E ARMAZENA OS VALORES DOS CAMPOS NAS VARIÁVEIS
if (isset($_POST["atualizar"])) {
    $id = limparEntrada($_POST["id"]);
    $nome = limparEntrada($_POST["nome"]);
    $preco = floatval(limparEntrada($_POST["preco"]));
    $descricao = limparEntrada($_POST["descricao"]);
    $tamanho_array = limparEntrada(explode(",", $_POST['tamanho']));
    $quantidade = limparEntrada($_POST["quantidade"]);
    $especie = limparEntrada($_POST["especie"]);
    $categoria = limparEntrada($_POST["categoria"]);
    $nomeImagem = '';

    // Verifica se foi enviado um arquivo de imagem
    if (empty($_FILES['imagem'])) {
        $nomeImagem = $produtos['imagem'];
    } elseif (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
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

// EXECUTA A FUNÇÃO atualizarProduto caso ocorra o clique no botão 'atualizar'
if (isset($_POST["atualizar"])) {
    $produtoAtualizado = atualizarProduto($id, $nome, $preco, $descricao, $tamanho_array, $quantidade, $especie, $categoria, $nomeImagem);
    echo "Produto atualizado com sucesso. Número de produtos atualizados:";
} else {
    /* echo "Erro ao atualizar produto"; */
}

// FUNÇÕES ATUALIZAR PRODUTO E LIMPAR ENTRADA
function atualizarProduto($id, $nome, $preco, $descricao, $tamanho, $quantidade, $especie, $categoria, $nomeImagem)
{
    if (!preg_match('/^[0-9a-fA-F]{24}$/', $id)) {
        throw new InvalidArgumentException('Valor inválido para ID do produto');
    }

    if (!is_array($especie)) {
        // Converte o array em uma string com vírgulas entre os valores
        $especies = explode(',', $especie);

    }
    if (is_array($tamanho)) {
        $tamanho = implode(',', $tamanho);
    }

    global $colecao;
    $atualizacao = array(
        '$set' => array(
            "nome" => $nome,
            "preco" => $preco,
            "descricao" => $descricao,
            "tamanho" => $tamanho,
            "quantidade" => $quantidade,
            "especie" => $especie,
            "categoria" => $categoria,
            "imagem" => $nomeImagem
        )
    );
    $resultado = $colecao->updateOne(["_id" => new MongoDB\BSON\ObjectId($id)], $atualizacao);
    return $resultado->getModifiedCount();
}

// DECLARAÇÃO DA FUNÇÃO 'limparEntrada' utilizada no código
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