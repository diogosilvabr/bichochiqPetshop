<?php 
// INCLUIR APENAS NAS PÁGINAS ONDE SERÁ NECESSÁRIA A VALIDAÇÃO DO USUÁRIO

session_start();
// VERIFICA SE O USUÁRIO ESTÁ AUTENTICADO AO TENTAR ACESSAR UMA PÁGINA PROTEGIDA
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM') {
	header('Location:../view/login.php?login=erro2'); }

?>