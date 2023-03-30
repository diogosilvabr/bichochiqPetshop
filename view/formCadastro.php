<?php
include("blades/header.php");
?>
    <form action="../controller/cadastrarCliente.php" method="POST">
        <label>Nome:</label>
        <input type="text" name="nomeCliente"><br>

        <label>Sobrenome</label>
        <input type="text" name="sobrenomeCliente"><br>

        <label>CPF</label>
        <input type="text" name="cpfCliente"><br>

        <label>E-mail</label>
        <input type="text" name="emailCliente"><br>

        <label>Celular com DDD</label>
        <input type="text" name="celularCliente"><br>

        <label>Crie uma senha</label>
        <input type="text" name="passwordCliente"><br>

        <label>Confirme a senha</label>
        <input type="text" name="passwordCliente"><br>

        <input type="hidden" name="nivelAcesso" value="1">
        <input type="submit" value="Concluir">

        
    </form>








<?php 
include("blades/footer.php");
?>