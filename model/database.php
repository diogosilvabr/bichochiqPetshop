<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;

$cliente = new MongoDB\Client("mongodb://localhost:27017");
$bancoDados = $cliente->bicho_chique;
$colecao = $bancoDados->produtos;



// Função para excluir um produto
function excluirProduto($idProduto) {
    global $colecao;
    $resultado = $colecao->deleteOne(['_id' => new MongoDB\BSON\ObjectID($idProduto)]);
    return $resultado;
}

// Exemplo de uso das funções
$idProduto = "123456789012345678901234"; // ID do produto a ser editado ou excluído
$dadosProduto = [
    'nome' => 'Produto X',
    'preco' => 9.99,
    'descricao' => 'Descrição do produto X'
]; // Dados do produto a ser cadastrado ou editado

$resultado = excluirProduto($idProduto); // Excluir um produto existente

?>