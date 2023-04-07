<?php
require '../model/database.php';
use MongoDB\Driver\Manager;
use MongoDB\BSON\ObjectId;
use MongoDB\Driver\Exception\Exception;

function criarProduto($nome, $preco, $descricao, $tamanho, $quantidade)
{
    global $colecao;
    $produto = array(
        "nome" => $nome,
        "preco" => $preco,
        "descricao" => $descricao,
        "tamanho" => $tamanho,
        "quantidade" => $quantidade
    );
    $resultado = $colecao->insertOne($produto);
    return $resultado->getInsertedId();
}

function buscarProdutoPorNome($nome)
{
    try {
        $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $filter = ['nome' => $nome];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $manager->executeQuery('bichochique_db.produtos', $query);
        $data = [];
        foreach ($cursor as $document) {
            $data[] = (array)$document;
        }
        return $data;
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo "Erro ao buscar produto por nome: " . $e->getMessage();
    }
}


function atualizarProduto($id, $nome, $preco, $descricao, $quantidade, $tamanho)
{
    global $colecao;
    $atualizacao = array(
        '$set' => array(
            "nome" => $nome,
            "preco" => $preco,
            "descricao" => $descricao,
            "tamanho" => $tamanho,
            "quantidade" => $quantidade
        )
    );
    $resultado = $colecao->updateOne(["_id" => new MongoDB\BSON\ObjectId($id)], $atualizacao);
    return $resultado->getModifiedCount();
}

function deletarProduto($id)
{
    global $colecao;
    $resultado = $colecao->deleteOne(["_id" => new MongoDB\BSON\ObjectId($id)]);
    return $resultado->getDeletedCount();
}
?>
