<?php 
include("blades/header.php");
include("blades/session.php");

// IMPORTA O ARQUIVO DE CONEXÃO E O ARQUIVO RESPONSÁVEL PELAS FUNÇÕES DO CRUD
require '../model/database.php';
require '../controller/crudProdutos.php';

// Função para limpar entrada do usuário
function limparEntrada($entrada) {
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
	<input type="text" name="tamanho"><br>
	<label>Quantidade do Produto:</label><br>
	<input type="number" name="quantidade"><br>
	<input type="checkbox" name="especie[]" value="cachorro">CÃES
	<input type="checkbox" name="especie[]" value="gato">GATOS
	<input type="checkbox" name="especie[]" value="ave">AVES
	<input type="checkbox" name="especie[]" value="roedor">ROEDORES
	<input type="checkbox" name="especie[]" value="peixe">PEIXES
	<br><select name="categoria">
		<option value=""></option>
		<option value="banho&tosa">BANHO & TOSA</option>
		<option value="alimentacao">ALIMENTAÇÃO</option>
		<option value="medicamentos">MEDICAMENTOS</option>
		<option value="acessorios">ACESSÓRIOS</option>
		<option value="brinquedos">BRINQUEDOS</option>
		<option value="cuidados">CUIDADOS</option>
	</select>
	<br><br><input type="submit" name="cadastrar" value="Cadastrar">
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
				echo 	"<thead>";
				echo 		"<tr>";
				echo 			"<th>ID</th>";
				echo 			"<th>Nome</th>";
				echo 			"<th>Preço</th>";
				echo 			"<th>Descrição</th>";
				echo 			"<th>Tamanho</th>";
				echo 			"<th>Quantidade</th>";
				echo 			"<th>Espécie</th>";
				echo 			"<th>Categoria</th>";
				echo 			"<th>Opções</th>";
				echo		"</tr>";
				echo	"</thead>";
				echo	"<tbody>";
				echo		"<tr>";
				echo			"<td>" . $produto['_id'] . "</td>";									
				echo			"<td>" . $produto['nome'] . "</td>";									
				echo			"<td>" . $produto['preco'] . "</td>";									
				echo			"<td>" . $produto['descricao'] . "</td>";									
				echo			"<td>" . $produto['tamanho'] . "</td>";									
				echo			"<td>" . $produto['quantidade'] . "</td>";								
				echo			"<td>" . $produto['especie'] . "</td>";								
				echo			"<td>" . $produto['categoria'] . "</td>";								
				echo			"<td>";
				echo			"<form method='post' action='". htmlspecialchars($_SERVER["PHP_SELF"])."'>";
				echo			"<input type='number' name='id' value='".$produto['_id']."'>";
				echo 			"<input type='submit' name='excluir' value='Excluir'>";
				echo			"</form>";
				echo			"</td>";								
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
		$especie = limparEntrada($_POST["especie"]);
		$categoria = limparEntrada($_POST["categoria"]);

		if (isset($_POST["cadastrar"])) {
			$idProduto = criarProduto($nome, $preco, $descricao, $tamanho, $quantidade, $especie, $categoria);
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