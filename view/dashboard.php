<?php 
include("blades/header.php"); 
include("blades/session.php");
?>
    <h1>DASHBOARD</h1>
    <a href="cadastroProduto.php">Produtos</a>
    


    <form action="../controller/validaLogin.php" method="post">
    <input type="submit" name="logoff" value="Sair">
</form>

<?php include("blades/footer.php"); ?>