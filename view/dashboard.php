<?php include("blades/header.php"); 

//session_start();

// VERIFICA SE O USUÁRIO ESTÁ AUTENTICADO AO TENTAR ACESSAR UMA PÁGINA PROTEGIDA
//if(!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM') {
   // header('Location:../view/login.php?login=erro2');   
//}
?>
    <h1>DASHBOARD</h1>
    <a href="cadastroProduto.php">Produtos</a>


<?php include("blades/footer.php"); ?>