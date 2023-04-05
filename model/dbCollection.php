<?php

//use MongoDB\Client as MongoClient;
try {
$mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// INDICAÇAO DA DATABASE QUE SERA UTILIZADA
$command = new MongoDB\Driver\Command([
    'create' => 'Teste_db'
]);

$result = $mongo->executeCommand('admin', $command);

// CRIANDO A COLEÇÃO 'CLIENTES'
$command = new MongoDB\Driver\Command([
    'create' => 'Clientes'
]);
$result = $mongo->executeCommand('Teste_db', $command);



var_dump($mongo);
} catch (Exception $e) {
    echo "Erro: {$e->getMessage()}";
}

?>