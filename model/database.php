<?php
// Arquivo de conexão com o banco
require '../vendor/autoload.php'; // Dependência do MongoDB
// Importa as classes necessárias do MongoDB
use MongoDB\Client;
use MongoDB\Database;

// Configurações de conexão com o MongoDB
$mongoDBUri = "mongodb://localhost:27017"; // URI de conexão do MongoDB
$mongoDBNome = "bichochique_db"; // Nome do seu banco de dados MongoDB
$colecaoProdutos = "produtos"; // Nome da coleção onde os dados dos produtos são armazenados
$colecaoFavoritos = "favoritos";

// Cria uma instância do cliente do MongoDB
$cliente = new Client($mongoDBUri);

// Seleciona o banco de dados
$bancoDeDados = $cliente->selectDatabase($mongoDBNome);

// Seleciona a coleção
$colecao = $bancoDeDados->selectCollection($colecaoProdutos);
$colecaoFav = $bancoDeDados->selectCollection($colecaoFavoritos);

global $colecao;
global $colecaoFav;
?>
