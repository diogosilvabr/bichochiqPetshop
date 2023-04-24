	<?php
	include("blades/header.php");
	include("blades/session.php");

	// IMPORTA O ARQUIVO DE CONEXÃO E O ARQUIVO RESPONSÁVEL PELAS FUNÇÕES DO CRUD
	require '../model/database.php';
	require '../controller/crudProdutos.php';
	require_once '../vendor/autoload.php';
	?>

	<link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
	<script src="../vendor/components/jquery/jquery.min.js"></script>

	<?php
	// Função para limpar entrada do usuário
	function limparEntrada($entrada)
	{
		if (is_array($entrada)) {
			// se a entrada for um array, cria um novo array para armazenar os valores limpos
			$saida = array();
			foreach ($entrada as $chave => $valor) {
				// remove espaços em branco no início e no fim da string
				$saida[$chave] = is_string($valor) ? trim($valor) : $valor;
			}
			return $saida;
		} else {
			// se a entrada não for um array, remove espaços em branco no início e no fim da string
			return is_string($entrada) ? trim($entrada) : $entrada;
		}
	}
	?>
	<div class="container">
		<h1 class="display-4">Gerenciamento de Produtos</h1>
		<!-- Nav tabs -->
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link active" href="#buscar" data-toggle="tab">Buscar Produtos</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="addProduto.php" data-toggle="tab">Cadastrar Produto</a>
			</li>

		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="buscar">
				<form class="form-control" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<div class="form-group">
						<input class="form-control" type="text" name="busca" placeholder="Digite uma palavra-chave">
					</div>
					<input class="btn btn-primary" type="submit" name="buscar" value="Buscar">
				</form>
			</div>
		<?php
		// Verifica se o formulário foi enviado
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (isset($_POST["busca"])) { // Verifica se a variável $_POST["busca"] está definida
				$palavraChave = limparEntrada($_POST["busca"]);
				$resultadoBusca = buscarProdutoPorNome($palavraChave); ?>
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nome</th>
								<th>Preço</th>
								<th>Descrição</th>
								<th>Tamanho</th>
								<th>Quantidade</th>
								<th>Espécie</th>
								<th>Categoria</th>
							</tr>
						</thead>
						<tbody>
				<?php
					if (!empty($resultadoBusca)) {
						foreach ($resultadoBusca as $produto) {
					?>
					<tr>
						<td><?php echo $produto['_id']; ?></td>
						<td><?php echo $produto['nome']; ?></td>
						<td><?php echo $produto['preco']; ?></td>
						<td><?php echo $produto['descricao']; ?></td>
						<td><?php echo $produto['tamanho']; ?></td>
						<td><?php echo $produto['quantidade']; ?></td>
						<td><?php echo implode(",", $produto['especie']); ?></td>
						<td><?php echo $produto['categoria']; ?></td>
						<td>
							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
								<input type="hidden" name="id" value="<?php echo $produto['_id']; ?>">
								<input class="btn btn-danger"type="submit" name="excluir" value="Excluir">
							</form>
						</td>
						<td>
							<form method="post" action="updateProduto.php">
								<input type="hidden" name="id" value="<?php echo $produto['_id']; ?>">
								<input class="btn btn-success"type="submit" value="Editar">
							</form>
							
						</td>
					</tr>
					<?php
						}
					}
					?>
				</tbody>
			</table>
		</div> <?php
				} else {
					echo "Nenhum produto encontrado com a palavra-chave informada.";
				}
			}
				if (isset($_POST["excluir"])) {
					$id = limparEntrada($_POST["id"]);
					$produtoDeletado = deletarProduto($id);
					if ($produtoDeletado) {
					echo "Produto deletado com sucesso.";
						} else {
					echo "Erro ao deletar o produto.";
					}
				}
		?>
		<script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
		<?php include("blades/footer.php"); ?>