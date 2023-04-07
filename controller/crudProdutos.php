<?php
require '../model/database.php';
use MongoDB\Driver\Manager;
use MongoDB\BSON\ObjectId;
use MongoDB\Driver\Exception\Exception;

function criarProduto($nome, $preco, $descricao, $quantidade)
{
    global $colecao;
    $produto = array(
        "nome" => $nome,
        "preco" => $preco,
        "descricao" => $descricao,
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
		// Resto do código aqui...
	} catch (MongoDB\Driver\Exception\Exception $e) {
		echo "Erro ao buscar produto por nome: " . $e->getMessage();
	}
}

function atualizarProduto($id, $nome, $preco, $descricao, $quantidade)
{
    global $colecao;
    $atualizacao = array(
        '$set' => array(
            "nome" => $nome,
            "preco" => $preco,
            "descricao" => $descricao,
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

$idProduto = criarProduto("Produto 1", 10.99, "Descrição do Produto 1", 1);
echo "ID do Produto criado: " . $idProduto . "<br>";

$produtoAtualizado = atualizarProduto($idProduto, "Produto 1 Atualizado", 15.99, "Nova descrição do Produto 1", 2);
echo "Número de produtos atualizados: " . $produtoAtualizado . "<br>";

$produtoDeletado = deletarProduto($idProduto);
echo "Número de produtos deletados: " . $produtoDeletado . "<br>";
?>
