<?php
require_once '../model/database.php';

class ProdutosController {

	private $collection;

    // Cria uma nova instância da coleção 'produtos' no banco de dados MongoDB
	public function __construct() {
		$db = new MongoDB\Client("mongodb://localhost:27017");
		$this->collection = $db->produtos->produtos;
	}

    // Recebe os dados do formulário via POST, insere um novo produto na coleção 
    // e retorna uma mensagem JSON informando o sucesso ou falha na operação
	public function cadastrar() {
		$produto = [
			'nome' => $_POST['nome'],
			'descricao' => $_POST['descricao'],
			'preco' => floatval($_POST['preco']),
			'quantidade' => intval($_POST['quantidade'])
		];

		$result = $this->collection->insertOne($produto);

		if ($result->getInsertedCount() == 1) {
			echo json_encode(['success' => true, 'message' => 'Produto cadastrado com sucesso.']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Erro ao cadastrar produto.']);
		}
	}

    /*
    // Busca todos os produtos da coleção e retorna um array JSON com os dados de cada produto
	public function listar() {
		$produtos = [];

		$cursor = $this->collection->find();

		foreach ($cursor as $document) {
			$produtos[] = [
				'id' => strval($document['_id']),
				'nome' => $document['nome'],
				'descricao' => $document['descricao'],
				'preco' => $document['preco'],
				'quantidade' => $document['quantidade']
			];
		}

		echo json_encode($produtos);
	}

    // Busca um produto pelo ID e retorna um objeto JSON com os dados do produto
	public function buscar($id) {
		$result = $this->collection->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);

		if ($result) {
			echo json_encode([
				'id' => strval($result['_id']),
				'nome' => $result['nome'],
				'descricao' => $result['descricao'],
				'preco' => $result['preco'],
				'quantidade' => $result['quantidade']
			]);
		} else {
			echo json_encode(['success' => false, 'message' => 'Produto não encontrado.']);
		}
	}

    // Recebe os dados do formulário via POST, atualiza os dados do produto com o ID fornecido 
    //e retorna uma mensagem JSON informando o sucesso ou falha na operação
	public function editar($id) {
		$produto = [
			'nome' => $_POST['nome'],
			'descricao' => $_POST['descricao'],
			'preco' => floatval($_POST['preco']),
			'quantidade' => intval($_POST['quantidade'])
		];

		$result = $this->collection->updateOne(
			['_id' => new MongoDB\BSON\ObjectID($id)],
			['$set' => $produto]
		);

		if ($result->getModifiedCount() == 1) {
			echo json_encode(['success' => true, 'message' => 'Produto atualizado com sucesso.']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Erro ao atualizar produto.']);
		}
	}

    public function excluir($id) {
        $result = $this->collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
    
        if ($result->getDeletedCount() == 1) {
            echo json_encode(['success' => true, 'message' => 'Produto excluído com sucesso.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao excluir produto.']);
        }
    }
    */
}