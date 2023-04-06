<?php
include("blades/header.php");
?>
    <h1>BEM VINDO AO NOSSO GITHUB DO PETSHOP</h1>
    <p>Teste</p>


    <!DOCTYPE html>
<html>
<head>
	<title>Cadastrar Produto</title>
</head>
<body>
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