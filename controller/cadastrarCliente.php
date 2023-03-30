<?php
include("../model/dbConnection.php");

$nivelAcesso = $_POST['nivelAcesso'];
$nome = $_POST['nomeCliente'];
$sobrenome = $_POST['sobrenomeCliente'];
$cpf = $_POST['cpfCliente'];
$email = $_POST['emailCliente'];
$celular = $_POST['celularCliente'];
$senha  = $_POST['senhaCliente'];


header("location:../view/index.php");
?>