<?php
include("blades/header.php");
include("blades/session.php");

// IMPORTA O ARQUIVO DE CONEXÃO E O ARQUIVO RESPONSÁVEL PELAS FUNÇÕES DO CRUD
require '../model/database.php';
require '../controller/crudProdutos.php';

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
			<a class="nav-link" href="#cadastrar" data-toggle="tab">Cadastrar Produto</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#atualizar" data-toggle="tab">Atualizar Produto</a>
		</li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane active" id="buscar">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<div class="form-group">
					<input class="form-control" type="text" name="busca" placeholder="Digite uma palavra-chave">
				</div>
				<input class="btn btn-primary" type="submit" name="buscar" value="Buscar">
			</form>
		</div>

		<div class="tab-pane" id="cadastrar">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
				<div class="form-group">
					<label for="nome">Nome do Produto:</label>
					<input type="text" class="form-control" id="nome" name="nome">
				</div>
				<div class="form-group">
					<label for="preco">Preço do Produto:</label>
					<input type="text" class="form-control" id="preco" name="preco">
				</div>
				<div class="form-group">
					<label for="descricao">Descrição do Produto:</label>
					<textarea class="form-control" id="descricao" name="descricao"></textarea>
				</div>
				<div class="form-group">
					<label for="tamanho">Tamanho:</label>
					<input type="text" class="form-control" id="tamanho" name="tamanho">
				</div>
				<div class="form-group">
					<label for="quantidade">Quantidade do Produto:</label>
					<input type="number" class="form-control" id="quantidade" name="quantidade">
				</div>
				<div class="form-group">
					<label>Espécies:</label><br>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" name="especie[]" id="cachorro" value="cachorro">
						<label class="form-check-label" for="cachorro">CÃES</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" name="especie[]" id="gato" value="gato">
						<label class="form-check-label" for="gato">GATOS</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" name="especie[]" id="ave" value="ave">
						<label class="form-check-label" for="ave">AVES</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" name="especie[]" id="roedor" value="roedor">
						<label class="form-check-label" for="roedor">ROEDORES</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" name="especie[]" id="peixe" value="peixe">
						<label class="form-check-label" for="peixe">PEIXES</label>
					</div>
				</div>
				<div class="form-group">
					<label for="categoria">Categoria:</label>
					<select class="form-control" id="categoria" name="categoria">
						<option value=""></option>
						<option value="banho&tosa">BANHO & TOSA</option>
						<option value="alimentacao">ALIMENTAÇÃO</option>
						<option value="medicamentos">MEDICAMENTOS</option>
						<option value="acessorios">ACESSÓRIOS</option>
						<option value="brinquedos">BRINQUEDOS</option>
						<option value="cuidados">CUIDADOS</option>
					</select>
				</div>
				<label for="imagem">Imagem do Produto:</label>
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="imagem" name="imagem">
					<label class="custom-file-label" for="imagem">Escolher arquivo</label>
				</div>
				<button type="submit" class="btn btn-primary">Cadastrar</button>
			</form>
		</div>

		<div class="tab-pane" id="atualizar">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<div class="form-group">
					<label for="nome">Nome do Produto:</label>
					<input type="text" class="form-control" id="nome" name="nome">
				</div>
				<div class="form-group">
					<label for="preco">Preço do Produto:</label>
					<input type="text" class="form-control" id="preco" name="preco">
				</div>
				<div class="form-group">
					<label for="descricao">Descrição do Produto:</label>
					<textarea class="form-control" id="descricao" name="descricao"></textarea>
				</div>
				<div class="form-group">
					<label for="tamanho">Tamanho:</label>
					<input type="text" class="form-control" id="tamanho" name="tamanho">
				</div>
				<div class="form-group">
					<label for="quantidade">Quantidade do Produto:</label>
					<input type="number" class="form-control" id="quantidade" name="quantidade">
				</div>
				<div class="form-group">
					<label>Espécies:</label><br>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" name="especie[]" id="cachorro" value="cachorro">
						<label class="form-check-label" for="cachorro">CÃES</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" name="especie[]" id="gato" value="gato">
						<label class="form-check-label" for="gato">GATOS</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" name="especie[]" id="ave" value="ave">
						<label class="form-check-label" for="ave">AVES</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" name="especie[]" id="roedor" value="roedor">
						<label class="form-check-label" for="roedor">ROEDORES</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" name="especie[]" id="peixe" value="peixe">
						<label class="form-check-label" for="peixe">PEIXES</label>
					</div>
				</div>
				<div class="form-group">
					<label for="categoria">Categoria:</label>
					<select class="form-control" id="categoria" name="categoria">
						<option value=""></option>
						<option value="banho&tosa">BANHO & TOSA</option>
						<option value="alimentacao">ALIMENTAÇÃO</option>
						<option value="medicamentos">MEDICAMENTOS</option>
						<option value="acessorios">ACESSÓRIOS</option>
						<option value="brinquedos">BRINQUEDOS</option>
						<option value="cuidados">CUIDADOS</option>
					</select>
				</div>
				<label for="imagem">Imagem do Produto:</label>
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="imagem" name="imagem">
					<label class="custom-file-label" for="imagem">Escolher arquivo</label>
				</div>
				<button type="submit" name="atualizar" class="btn btn-primary">Cadastrar</button>
			</form>
		</div>
	</div>

	<!-- <h2>Excluir Produto</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<label>ID do Produto:</label><br>
	<input type="number" name="id"><br>
	<input type="submit" name="excluir" value="Excluir">
</form> -->
	<?php
	// Verifica se o formulário foi enviado
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST["busca"])) { // Verifica se a variável $_POST["busca"] está definida
			$palavraChave = limparEntrada($_POST["busca"]);
			$resultadoBusca = buscarProdutoPorNome($palavraChave);
			if (!empty($resultadoBusca)) {
				echo "Resultado da busca:<br>";
				foreach ($resultadoBusca as $produto) {
					echo "<table border='1'>";
					echo "<thead>";
					echo "<tr>";
					echo "<th>ID</th>";
					echo "<th>Nome</th>";
					echo "<th>Preço</th>";
					echo "<th>Descrição</th>";
					echo "<th>Tamanho</th>";
					echo "<th>Quantidade</th>";
					echo "<th>Espécie</th>";
					echo "<th>Categoria</th>";
					echo "<th>Opções</th>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					echo "<tr>";
					echo "<td>" . $produto['_id'] . "</td>";
					echo "<td>" . $produto['nome'] . "</td>";
					echo "<td>" . $produto['preco'] . "</td>";
					echo "<td>" . $produto['descricao'] . "</td>";
					echo "<td>" . $produto['tamanho'] . "</td>";
					echo "<td>" . $produto['quantidade'] . "</td>";
					echo "<td>" . $produto['especie'] . "</td>";
					echo "<td>" . $produto['categoria'] . "</td>";
					echo "<td>";
					echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
					echo "<input type='number' name='id' value='" . $produto['_id'] . "'>";
					echo "<input type='submit' name='excluir' value='Excluir'>";
					echo "</form>";
					echo "</td>";
					echo "</tr>";
					echo "</tbody>";
					echo "</table>";
					echo "<br>";
					echo "</div>";
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
			$especie = limparEntrada($_POST["especie"]);
			$categoria = limparEntrada($_POST["categoria"]);
			$nomeImagem = '';

			// Verifica se foi enviado um arquivo de imagem
			if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
				$nomeImagem = $_FILES['imagem']['name'];
				$extensao = pathinfo($nomeImagem, PATHINFO_EXTENSION);
				$destino = 'images/' . $nomeImagem;

				// Verifica se o arquivo é uma imagem válida
				$extensoesPermitidas = array('jpg', 'jpeg', 'png', 'gif');
				if (in_array(strtolower($extensao), $extensoesPermitidas)) {
					if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
						// arquivo movido com sucesso
					} else {
						$nomeImagem = '';
						// Tratar erro de movimentação do arquivo
					}
				} else {
					// Tratar erro de tipo de arquivo inválido
				}
			} else {
				// Tratar erro de arquivo não enviado
			}

			if (isset($_POST["cadastrar"])) {
				$idProduto = criarProduto($nome, $preco, $descricao, $tamanho, $quantidade, $especie, $categoria, $nomeImagem);
				if ($idProduto) {
					echo "Produto cadastrado com sucesso. ID do Produto: " . $idProduto;
				} else {
					echo "Erro ao cadastrar o produto.";
				}
			} elseif (isset($_POST["atualizar"])) {
				$produtoAtualizado = atualizarProduto($id, $nome, $preco, $descricao, $quantidade, $tamanho, $especie, $categoria);
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
	<?php include("blades/footer.php"); ?>