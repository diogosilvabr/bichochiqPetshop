<?php

// INDICANDO AO COMPOSER PARA SER EXECUTADO NO ARQUIVO
require = 'vendor/autoload.php';

// REFERENCIANDO O LINK DA CONEXAO COM O MONGODB
$client = new MongoDB\Client("mongodb://localhost:27017");

// INDICAÇAO DA DATABASE QUE SERA UTILIZADA
$petshopdb = $client ->petshopdb;

// CRIANDO A COLEÇÃO 'CLIENTES'
$clientes = $petshopdb -> createCollection('clientes');

var_dump($clientes);


?>