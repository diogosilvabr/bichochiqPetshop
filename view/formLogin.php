<?php include("blades/header.php"); ?>


    <form action="../controller/validaLogin.php" method="POST">
        <label>E-mail</label>
        <input type="text" name="emailCliente"><br>

        <label>Senha</label>
        <input type="text" name="passwordCliente"><br>

    
            <? if(isset($_GET['login']) && $_GET['login'] == 'erro') { ?>

            <!-- mensagem de erro no form referente autenticação do usuário -->    
            <span>Usuário ou senha inválidos!</span> <br />

            <? } ?>

        <input type="hidden" name="nivelAcesso" value="1">
        <input type="submit" value="Concluir">   
    </form>



<?php include("blades/footer.php"); ?>