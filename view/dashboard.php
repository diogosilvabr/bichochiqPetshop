<?php 
include("blades/header.php"); 
include("blades/session.php");
?>
    <h1>DASHBOARD</h1>
    <a href="cadastroProduto.php">Cadastrar Produto</a><br>
    <a href="atualizaProduto.php">Editar Produtos</a>
    
    


    <form action="../controller/validaLogin.php" method="post">
    <input type="submit" name="logoff" value="Sair">
</form>

<?php include("blades/footer.php"); ?>