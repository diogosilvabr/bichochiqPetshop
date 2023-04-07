<?php 
include("blades/header.php");
//session_start();

// VERIFICA SE O USUÁRIO ESTÁ AUTENTICADO AO TENTAR ACESSAR UMA PÁGINA PROTEGIDA
//if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM') {
	//header('Location:../view/login.php?login=erro2');
// ?>

<?php
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

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST["busca"])) { // Verifica se a variável $_POST["busca"] está definida
		$palavraChave = limparEntrada($_POST["busca"]);
		$resultadoBusca = buscarProdutoPorNome($palavraChave);
		if (!empty($resultadoBusca)) {
			echo "Resultado da busca:<br>";
			foreach ($resultadoBusca as $produto) {
				echo "<table border='1'>";
				echo 	"<thead>";
				echo 		"<tr>";
				echo 			"<th>ID</th>";
				echo 			"<th>Nome</th>";
				echo 			"<th>Preço</th>";
				echo 			"<th>Descrição</th>";
				echo 			"<th>Tamanho</th>";
				echo 			"<th>Quantidade</th>";
				echo		"</tr>";
				echo	"</thead>";
				echo	"<tbody>";
				echo		"<tr>";
				echo			"<td>" . $produto['id'] . "'</td>";									
				echo			"<td>" . $produto['nome'] . "'</td>";									
				echo			"<td>" . $produto['preco'] . "'</td>";									
				echo			"<td>" . $produto['descricao'] . "'</td>";									
				echo			"<td>" . $produto['tamanho'] . "'</td>";									
				echo			"<td>" . $produto['quantidade'] . "'</td>";									
				echo 		"</tr>";									
				echo 	"</tbody>";									
				echo "</table>";
				echo "<br>";
			}
		} else {
			echo "Nenhum produto encontrado com a palavra-chave informada.";
		}
	} elseif (isset($_POST["cadastrar"]) || isset($_POST["atualizar"])) {
		$id = "";
		if (isset($_POST["atualizar"])) {
			$id = limparEntrada($_POST["id"]);
		}
		$nome = limparEntrada($_POST["nome"]);
		$preco = floatval(limparEntrada($_POST["preco"]));
		$descricao = limparEntrada($_POST["descricao"]);
		$tamanho = limparEntrada($_POST["tamanho"]);
		$quantidade = limparEntrada($_POST["quantidade"]);

		if (isset($_POST["cadastrar"])) {
			$idProduto = criarProduto($nome, $preco, $descricao, $quantidade, $tamanho);
			if ($idProduto) {
				echo "Produto cadastrado com sucesso. ID do Produto: " . $idProduto;
			} else {
				echo "Erro ao cadastrar o produto.";
			}
		} elseif (isset($_POST["atualizar"])) {
			$produtoAtualizado = atualizarProduto($id, $nome, $preco, $descricao, $quantidade, $tamanho);
			echo "Produto atualizado com sucesso. Número de produtos atualizados:";
		}
	} elseif (isset($_POST["excluir"])) {
		$id = limparEntrada($_POST["id"]);
		$produtoDeletado = deletarProduto($id);
		if ($produtoDeletado) {
			echo "Produto deletado com sucesso.";
		} else {
			echo "Erro ao deletar o produto.";
		}
	}
}
?>

<h1>Gerenciamento de Produtos</h1>
<h2>Buscar Produtos</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<input type="text" name="busca" placeholder="Digite uma palavra-chave">
	<input type="submit" name="buscar" value="Buscar">
</form>

<h2>Cadastrar Produto</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<label>Nome do Produto:</label><br>
	<input type="text" name="nome"><br>
	<label>Preço do Produto:</label><br>
	<input type="text" name="preco"><br>
	<label>Descrição do Produto:</label><br>
	<textarea name="descricao"></textarea><br>	
	<label>Tamanho:</label><br>
	<textarea name="tamanho"></textarea><br>
	<label>Quantidade do Produto:</label><br>
	<input type="number" name="quantidade"><br>
	<input type="submit" name="cadastrar" value="Cadastrar">
</form>

<!-- <h2>Atualizar Produto</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<label>ID do Produto:</label><br>
	<input type="number" name="id"><br>
	<label>Nome do Produto:</label><br>
	<input type="text" name="nome"><br>
	<label>Preço do Produto:</label><br>
	<input type="text" name="preco"><br>
	<label>Descrição do Produto:</label><br>
	<textarea name="descricao"></textarea><br>
	<label>Tamanho:</label><br>	
	<textarea name="tamanho"></textarea><br>
	<label>Quantidade do Produto:</label><br>
	<input type="number" name="quantidade"><br>
	<input type="submit" name="atualizar" value="Atualizar">
</form> -->

<!-- <h2>Excluir Produto</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<label>ID do Produto:</label><br>
	<input type="number" name="id"><br>
	<input type="submit" name="excluir" value="Excluir">
</form> -->

<?php include("blades/footer.php"); ?>