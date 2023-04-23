	<?php
	// Inclui arquivos necessários
	require_once 'blades/header.php';
	require_once 'blades/session.php';
	require_once '../model/database.php';
	require_once '../controller/crudProdutos.php';

	// Trata entrada do usuário
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Definir função limparEntrada
    function limparEntrada($entrada)
    {
        // Remove espaços em branco no início e no fim da string
        $saida = trim($entrada);
        // Remove tags HTML e caracteres especiais
        $saida = filter_var($saida, FILTER_SANITIZE_STRING);
        return $saida;
    }

    $palavraChave = isset($_POST["busca"]) ? limparEntrada($_POST["busca"]) : '';
    try {
        $resultadoBusca = buscarProdutoPorNome($palavraChave);
    } catch (Exception $e) {
        echo "Erro ao buscar produto por nome: " . $e->getMessage();
    } 
}
	?>
		<h1>Gerenciamento de Produtos</h1>
		<h2>Buscar Produtos</h2>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<input type="text" name="busca" placeholder="Digite uma palavra-chave">
				<input type="submit" name="buscar" value="Buscar">
			</form>
	<?php
		// Exibe resultados da busca, se houver
		$palavraChave = '';
		if (!empty($resultadoBusca)) { ?>
			<form method="post" action="../controller/crudProdutos.php">
				<label>Nome do Produto:</label><br>
				<input type="text" name="nome" value="<?php echo isset($resultadoBusca['nome']) ? htmlspecialchars($resultadoBusca['nome']) : ''; ?>"><br>
				<label>Preço do Produto:</label><br>
				<input type="text" name="preco" value="<?php echo isset($resultadoBusca['preco']) ? htmlspecialchars($resultadoBusca['preco']) : ''; ?>"><br>
				<label>Descrição do Produto:</label><br>
				<textarea name="descricao"><?php echo isset($resultadoBusca['descricao']) ? htmlspecialchars($resultadoBusca['descricao']) : ''; ?></textarea><br>
				<label>Tamanho:</label><br>
				<input type="text" name="tamanho" value="<?php echo isset($resultadoBusca['tamanho']) ? htmlspecialchars($resultadoBusca['nome']) : ''; ?>"><br>
				<label>Quantidade do Produto:</label><br>
				<input type="number" name="quantidade" value="<?php echo isset($resultadoBusca['quantidade']) ? htmlspecialchars($resultadoBusca['quantidade']) : ''; ?>"><br>
				<label>Espécie:</label><br>
					<?php 
						// verifica se o resultado busca 'especie' é uma array, se não o converte a uma
						if (!is_array($resultadoBusca['especie'])) {				
							$resultadoBusca['especie'] = array();
					?>
				<input type="checkbox" name="especie[]" value="cachorro" <?php if (in_array('cachorro', $resultadoBusca['especie'])) { echo 'checked'; } ?>>CÃES
				<input type="checkbox" name="especie[]" value="gato" <?php if (in_array('gato', $resultadoBusca['especie'])) { echo 'checked'; } ?>>GATOS
				<input type="checkbox" name="especie[]" value="ave" <?php if (in_array('ave', $resultadoBusca['especie'])) { echo 'checked'; } ?>>AVES
				<input type="checkbox" name="especie[]" value="roedor" <?php if (in_array('roedor', $resultadoBusca['especie'])) { echo 'checked'; } ?>>ROEDORES
				<input type="checkbox" name="especie[]" value="peixe" <?php if (in_array('peixe', $resultadoBusca['especie'])) { echo 'checked'; } ?>>PEIXES
				<?php } ?>
				<br><br>
				<input type="submit" name="atualizar" value="Atualizar Produto">
			</form>
		<?php
			} else {
				echo "Nenhum resultado encontrado para a palavra-chave: " . $palavraChave;
			}

	include("blades/footer.php"); ?>