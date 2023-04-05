<?php
include("blades/header.php");
?>
    <form action="../controller/validaLogin.php" method="POST">
        <label>E-mail</label>
        <input type="text" name="emailCliente"><br>

        <label>Confirme a senha</label>
        <input type="text" name="passwordCliente"><br>

        <input type="hidden" name="nivelAcesso" value="1">
        <input type="submit" value="Concluir">   
    </form>








<?php 
include("blades/footer.php");
?>