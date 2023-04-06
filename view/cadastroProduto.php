<?php include("blades/header.php"); 

session_start();

// VERIFICA SE O USUÁRIO ESTÁ AUTENTICADO AO TENTAR ACESSAR UMA PÁGINA PROTEGIDA
if(!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM') {
    header('Location:../view/login.php?login=erro2');   
}
?>
	<h1>Cadastrar Produto</h1>
	<form method="post" action="../controller/controllerProdutos.php">
		<label for="nome">Nome:</label>
		<input type="text" name="nome" required>
		<br>
		<label for="preco">Preço:</label>
		<input type="text" name="preco" step="0.01" min="0" required>
		<br>
        <label for="quantidade">Quantidade:</label>
		<input type="number" name="quantidade" step="0.01" min="0" required>
		<br>
		<label for="descricao">Descrição:</label>
		<textarea name="descricao" required></textarea>
		<br>
		<input type="submit" value="Cadastrar">
	</form>
</body>
</html>

<? include('blades/footer.php'); ?>


<?php include("blades/footer.php"); ?>