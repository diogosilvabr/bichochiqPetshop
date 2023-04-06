<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Carrega o arquivo de autoload
require_once __DIR__ . '/../model/dbCollection.php'; // Carrega o arquivo com as funções do MongoDB


// Exemplo de uso das funções
$idProduto = "123456789012345678901234"; // ID do produto a ser editado ou excluído
$dadosProduto = [
    'nome' => 'Produto X',
    'preco' => 9.99,
    'descricao' => 'Descrição do produto X'
]; // Dados do produto a ser cadastrado ou editado

// Função para editar um produto
function editarProduto($idProduto, $dadosProduto) {
    global $colecao;
    $resultado = $colecao->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID($idProduto)],
        ['$set' => $dadosProduto]
    );
    return $resultado;
}

$resultado = editarProduto($idProduto, $dadosProduto); // Editar um produto existente

?>