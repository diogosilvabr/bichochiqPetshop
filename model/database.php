<?php
require_once '../vendor/autoload.php';

$client = new MongoDB\Client('mongodb://localhost:27017');

// Seleciona a base de dados 'meu_projeto'
$db = $client->TestePetshop;
