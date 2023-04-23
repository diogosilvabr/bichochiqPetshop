<?php
require '../model/database.php';
use MongoDB\Driver\Manager;
use MongoDB\BSON\ObjectId;
use MongoDB\Driver\Exception\Exception;

function criarProduto($nome, $preco, $descricao, $tamanho, $quantidade, $especies, $categoria, $nomeImagem)
{   
    global $colecao;
    
    // Verifica se $especies é um array
    if (is_array($especies)) {
        // Converte o array em uma string com vírgulas entre os valores
        $especies = implode(',', $especies);
    }

    // Verifica se foi enviado um arquivo de imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0 && file_exists($_FILES['imagem']['tmp_name'])) {
        $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
        $tipoImagem = $_FILES['imagem']['type'];
        $imagemBSON = new MongoDB\BSON\Binary($imagem, MongoDB\BSON\Binary::TYPE_GENERIC);
    } else {
        $imagemBSON = null;
    }
    
    // Verifica se foi enviado um arquivo de imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0 && file_exists($_FILES['imagem']['tmp_name'])) {
        $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
        $tipoImagem = $_FILES['imagem']['type'];
        $imagemBSON = new MongoDB\BSON\Binary($imagem, MongoDB\BSON\Binary::TYPE_GENERIC);
    } else {
        $imagemBSON = null;
    }
    
    $produto = array(
        "nome" => $nome,
        "preco" => $preco,
        "descricao" => $descricao,
        "tamanho" => $tamanho,
        "quantidade" => $quantidade,
        "especie" => $especies,
        "categoria" => $categoria,
        "imagem" => $imagemBSON
    );
    $resultado = $colecao->insertOne($produto);
    return $resultado->getInsertedId();
}
function buscarProdutoPorNome($nome, $limite = 1)
{
    try {
        $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $filter = [
            '$or' => [
                ['nome' => ['$regex' => new MongoDB\BSON\Regex($nome, 'i')]],
                ['categoria' => ['$regex' => new MongoDB\BSON\Regex($nome, 'i')]],
                ['especie' => ['$regex' => new MongoDB\BSON\Regex($nome, 'i')]]
            ]
        ];
        $options = [
            'limit' => $limite
        ];
        $query = new MongoDB\Driver\Query($filter, $options);
        $cursor = $manager->executeQuery('bichochique_db.produtos', $query);
        foreach ($cursor as $document) {
            return (array)$document;
        }
        return null;
    } catch (MongoDB\Driver\Exception\Exception $e) {
        throw new Exception("Erro ao buscar produto por nome: " . $e->getMessage());
    }
}

// FUNÇÃO PARA ATUALIZAÇÃO DO PRODUTO
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
                $nomeImagem = '';
                // Tratar erro de movimentação do arquivo
            }
    } else {
        // Tratar erro de tipo de arquivo inválido
    }
}

    $produtoAtualizado = atualizarProduto($id, $nome, $preco, $descricao, $quantidade, $tamanho, $especie, $categoria);
    echo "Produto atualizado com sucesso. Número de produtos atualizados: " . $produtoAtualizado;
}  
      
function atualizarProduto($id, $nome, $preco, $descricao, $tamanho, $quantidade, $especies, $categoria)
{
        // Verifica se $especies é um array
        if (is_array($especies)) {
            // Converte o array em uma string com vírgulas entre os valores
            $especies = implode(',', $especies);
        }

    global $colecao;
    $atualizacao = array(
        '$set' => array(
            "nome" => $nome,
            "preco" => $preco,
            "descricao" => $descricao,
            "tamanho" => $tamanho,
            "quantidade" => $quantidade,
            "especie" => $especies,
            "categoria" => $categoria,
            "imagem" => $imagemBSON
        )
    );
    $resultado = $colecao->updateOne(["_id" => new MongoDB\BSON\ObjectId($id)], $atualizacao);
    return $resultado->getModifiedCount();
}

function deletarProduto($id)
{
    global $colecao;
    if(!empty($id)) {
        $resultado = $colecao->deleteOne(["_id" => new MongoDB\BSON\ObjectId($id)]);
        return $resultado->getDeletedCount();
    } else {
        // Caso a variável $id esteja vazia
        return 0;
    }
}
