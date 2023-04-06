<?php
// Arquivo de conexão com o banco
require '../model/database.php';

// Função para criar um novo produto
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

// Função para buscar um produto pelo ID
function buscarProduto($id)
{
    global $colecao;
    $resultado = $colecao->findOne(["_id" => new MongoDB\BSON\ObjectId($id)]);
    return $resultado;
}

// Função para atualizar um produto pelo ID
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

// Função para deletar um produto pelo ID
function deletarProduto($id)
{
    global $colecao;
    $resultado = $colecao->deleteOne(["_id" => new MongoDB\BSON\ObjectId($id)]);
    return $resultado->getDeletedCount();
}

// Exemplo de uso das funções

// Cria um novo produto
$idProduto = criarProduto("Produto 1", 10.99, "Descrição do Produto 1", 1);
echo "ID do Produto criado: " . $idProduto . "<br>";

// Busca um produto pelo ID
$produto = buscarProduto($idProduto);
echo "Produto buscado: ";
print_r($produto);
echo "<br>";

// Atualiza um produto pelo ID
$produtoAtualizado = atualizarProduto($idProduto, "Produto 1 Atualizado", 15.99, "Nova descrição do Produto 1", 2);
echo "Número de produtos atualizados: " . $produtoAtualizado . "<br>";

// Busca novamente o produto pelo ID para verificar a atualização
$produtoAtualizado = buscarProduto($idProduto);
echo "Produto atualizado: ";
print_r($produtoAtualizado);
echo "<br>";

// Deleta um produto pelo ID
$produtoDeletado = deletarProduto($idProduto);
echo "Número de produtos deletados: " . $produtoDeletado . "<br>";
?>
