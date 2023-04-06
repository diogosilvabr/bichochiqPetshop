<?php include("blades/header.php");

session_start();

// VERIFICA SE O USUÁRIO ESTÁ AUTENTICADO AO TENTAR ACESSAR UMA PÁGINA PROTEGIDA
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM') {
	header('Location:../view/login.php?login=erro2');
}

?>

<?php
// IMPORTA OS ARQUIVOS DE CONEXÃO E CRUD DOS PRODUTOS
require '../model/database.php';
require '../controller/crudProdutos.php';

// Função para limpar entrada do usuário
function limparEntrada($dados)
{
	$dados = trim($dados);
	$dados = stripslashes($dados);
	$dados = htmlspecialchars($dados);
	return $dados;
}

// Verifica se o formulário de cadastro foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cadastrar"])) {
	$nome = limparEntrada($_POST["nome"]);
	$preco = floatval(limparEntrada($_POST["preco"]));
	$descricao = limparEntrada($_POST["descricao"]);
	$quantidade = limparEntrada($_POST["quantidade"]);

	// Insere o novo produto no banco de dados
	$idProduto = criarProduto($nome, $preco, $descricao, $quantidade);
	if ($idProduto) {
		echo "Produto cadastrado com sucesso. ID do Produto: " . $idProduto;
	} else {
		echo "Erro ao cadastrar o produto.";
	}
}

// Verifica se o formulário de edição foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["atualizar"])) {
	$id = limparEntrada($_POST["id"]);
	$nome = limparEntrada($_POST["nome"]);
	$preco = floatval(limparEntrada($_POST["preco"]));
	$descricao = limparEntrada($_POST["descricao"]);
	$quantidade = limparEntrada($_POST["quantidade"]);

	// Atualiza o produto no banco de dados
	$produtoAtualizado = atualizarProduto($id, $nome, $preco, $descricao, $quantidade);
	echo "Produto atualizado com sucesso. Número de produtos atualizados: " . $produtoAtualizado . "<br>";
}

// Verifica se o formulário de exclusão foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["excluir"])) {
	$id = limparEntrada($_POST["id"]);

	// Deleta o produto do banco de dados
	$produtoDeletado = deletarProduto($id);
	echo "Produto deletado com sucesso. Número de produtos deletados: " . $produtoDeletado . "<br>";
}

?>

<!-- Formulário de Cadastro -->
<h2>Cadastrar Produto</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	Nome: <input type="text" name="nome" required><br>
	Preço: <input type="text" step="0.01" name="preco" required><br>
	Descrição: <input type="text" name="descricao" required><br>
	Quantidade: <input type="number" name="quantidade" required><br>
	<input type="submit" name="cadastrar" value="Cadastrar">
</form>

<!-- Formulário de Edição -->
<h2>Editar Produto</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	ID: <input type="text" name="id" required><br>
	Nome: <input type="text" name="nome" required><br>
	Preço: <input type="text" step="0.01" name="preco" required><br>
	Descrição: <input type="text" name="descricao" required><br>\
	Quantidade: <input type="number" name="quantidade" required><br>\
	<input type="submit" name="atualizar" value="Atualizar">
</form>

<!-- Formulário de Exclusão -->
<h2>Excluir Produto</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	ID: <input type="text" name="id" required><br>
	<input type="submit" name="excluir" value="Excluir">
</form>

<?php include("blades/footer.php"); ?>