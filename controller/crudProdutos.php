<?php
require '../model/database.php';
use MongoDB\Driver\Manager;
use MongoDB\BSON\ObjectId;
use MongoDB\Driver\Exception\Exception;

function criarProduto($nome, $preco, $descricao, $tamanho, $quantidade, $especies, $categoria)
{   
    global $colecao;
    
    // Verifica se $especies é um array
    if (is_array($especies)) {
        // Converte o array em uma string com vírgulas entre os valores
        $especies = implode(',', $especies);
    }
    
    $produto = array(
        "nome" => $nome,
        "preco" => $preco,
        "descricao" => $descricao,
        "tamanho" => $tamanho,
        "quantidade" => $quantidade,
        "especie" => $especies,
        "categoria" => $categoria
    );
    $resultado = $colecao->insertOne($produto);
    return $resultado->getInsertedId();
}

function buscarProdutoPorNome($nome)
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

function atualizarProduto($id, $nome, $preco, $descricao, $tamanho, $quantidade, $especie, $categoria)
{
    global $colecao;
    $atualizacao = array(
        '$set' => array(
            "nome" => $nome,
            "preco" => $preco,
            "descricao" => $descricao,
            "tamanho" => $tamanho,
            "quantidade" => $quantidade,
            "especie" => $especie,
            "categoria" => $categoria
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

?>
