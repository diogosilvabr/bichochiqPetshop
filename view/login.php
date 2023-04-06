<?php include("blades/header.php"); ?>

    <form action="../controller/validaLogin.php" method="POST">
        <label>E-mail</label>
        <input type="text" name="emailCliente"><br>

        <label>Senha</label>
        <input type="text" name="passwordCliente"><br>

            <?php if(isset($_GET['login']) && $_GET['login'] == 'erro') { ?>

            <!-- mensagem de erro no form referente autenticação do usuário -->    
            <span>Usuário ou senha inválidos!</span> <br />

            <?php } ?>

            <?php if(isset($_GET['login']) && $_GET['login'] == 'erro2') { ?>

            <!-- mensagem de erro no form referente autenticação do usuário -->    
            <span>Você precisa fazer login primeiro!</span> <br />

            <?php } ?>

        <input type="submit" value="Concluir">   
        <?php header('Location:../view/dashboard.php') ?>
    </form>


<?php include("blades/footer.php"); ?>