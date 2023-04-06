<?php include("blades/header.php"); 

session_start();

echo $_SESSION['autenticado'];
?>
    <h1>BEM VINDO!</h1>

    <a href='formLogin.php'>LOGIN</a>



<?php include("blades/footer.php"); ?>