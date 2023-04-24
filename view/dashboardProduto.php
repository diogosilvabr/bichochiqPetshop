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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
				<div class="form-group">
					<input class="btn mt-2" type="submit" name="buscar" value="Buscar" style="background-color: #1D9BF0; border-color: #1D9BF0;">
				</div>
			</form>
		</div>
		<?php
		// Verifica se o formulário foi enviado
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (isset($_POST["busca"])) { // Verifica se a variável $_POST["busca"] está definida
				$palavraChave = limparEntrada($_POST["busca"]);
				$resultadoBusca = buscarProdutoPorNome($palavraChave);
				if (!empty($resultadoBusca)) {
		?>
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
								foreach ($resultadoBusca as $produto) {
								?>
									<tr>
										<td><?php echo $produto['_id']; ?></td>
										<td><?php echo $produto['nome']; ?></td>
										<td>R$ <?php echo $produto['preco']; ?></td>
										<td><?php echo $produto['descricao']; ?></td>
										<td><?php echo $produto['tamanho']; ?></td>
										<td><?php echo $produto['quantidade']; ?></td>
										<td><?php echo implode(",", $produto['especie']); ?></td>
										<td><?php echo $produto['categoria']; ?></td>
										<td>
											<form method="post" action="updateProduto.php">
												<input type="hidden" name="id" value="<?php echo $produto['_id']; ?>">
												<input class="btn" type="submit" value="Editar" style="background-color: #1D9BF0; border-color: #1D9BF0;">
											</form>
										</td>
										<td>
											<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
												<input type="hidden" name="id" value="<?php echo $produto['_id']; ?>">
												<input class="btn btn-danger m-0" type="submit" name="excluir" value="Excluir">
											</form>
										</td>
										<td>
											<form method="post" action="addFavorito.php">
												<input type="hidden" name="id" value="<?php echo $produto['_id']; ?>">
												<button class="btn btn-primary" type="submit" name="favoritar">
													<i class="fa fa-star"></i>
												</button>
											</form>
										</td>
									</tr>
								<?php
								}
								?>
							</tbody>
						</table>
					</div>
		<?php
				} else {
					echo "Nenhum produto encontrado com a palavra-chave informada.";
				}
			} else {
				echo "A variável de busca não foi definida.";
			}
		}

		if (isset($_POST["excluir"])) {
			$id = limparEntrada($_POST["id"]);
			if (deletarProduto($id)) {
				echo "Produto deletado com sucesso.";
			} else {
				echo "Erro ao deletar o produto.";
			}
		}
		function buscarProdutoPorNome($nome)
		{
			try {
				$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
				$filter = [
					'$or' => [
						['nome' => ['$regex' => new MongoDB\BSON\Regex($nome, 'i')]],
						['categoria' => ['$regex' => new MongoDB\BSON\Regex($nome, 'i')]],
						['especie' => ['$regex' => new MongoDB\BSON\Regex($nome, 'i')]]
					]
				];
				$query = new MongoDB\Driver\Query($filter);
				$cursor = $manager->executeQuery('bichochique_db.produtos', $query);
				$data = [];
				foreach ($cursor as $document) {
					$data[] = (array)$document;
				}
				return $data;
			} catch (MongoDB\Driver\Exception\Exception $e) {
				echo "Erro ao buscar produto por nome: " . $e->getMessage();
			}
		}
		function deletarProduto($id)
		{
			global $colecao;
			if (!empty($id)) {
				$resultado = $colecao->deleteOne(["_id" => new MongoDB\BSON\ObjectId($id)]);
				return $resultado->getDeletedCount();
			} else {
				// Caso a variável $id esteja vazia
				return 0;
			}
		}
		?>
		<script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
		<?php include("blades/footer.php"); ?>