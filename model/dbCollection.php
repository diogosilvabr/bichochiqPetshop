<?php
require_once 'vendor/autoload.php';
use MongoDB\Client as MongoClient;

$mongo = new MongoClient("mongodb://localhost:27017");

$db = $mongo->meu_banco;
$usuarios = $db->usuarios;

?>