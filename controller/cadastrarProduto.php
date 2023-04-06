<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Carrega o arquivo de autoload
require_once __DIR__ . '/../model/dbCollection.php'; // Carrega o arquivo com as funções do MongoDB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$nome = $_POST['nome'];
	$preco = $_POST['preco'];
	$descricao = $_POST['descricao'];

	$dadosProduto = [
	    'nome' => $nome,
	    'preco' => $preco,
	    'descricao' => $descricao
	];

	function cadastrarProduto($dadosProduto) {
		global $colecao;
		$resultado = $colecao->insertOne($dadosProduto);
		return $resultado;
	}

	$resultado = cadastrarProduto($dadosProduto); // Cadastrar um novo produto

	if ($resultado->getInsertedCount() == 1) {
		echo "Produto cadastrado com sucesso!";
	} else {
		echo "Ocorreu um erro ao cadastrar o produto.";
	}
}


header("location:../view/index.php");
?>