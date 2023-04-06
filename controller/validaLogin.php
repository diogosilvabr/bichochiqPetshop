<?php
session_start();

// verifica se a autenticação foi realizada
$usuarioAutenticado = false;

// array para cadastrar usuários no sistema
$usuariosPetshop = array(
    array('email' => 'admin@bichochique.com', 'senha' => 'admin'),
    array('email' => 'cliente@test.com', 'senha' => 'cliente'),
);

// percorre a array usuariosPetshop e verifica se o usuário/senha cadastrado é igual ao escrito no form de login
foreach($usuariosPetshop as $user) {
    if($user['email'] == $_POST['emailCliente'] && $user['senha'] == $_POST['passwordCliente']) {
        $usuarioAutenticado = true;
        break;

    }
}

// verifica e retorna se o usuário está autenticado ou exibe erro se não estiver
if($usuarioAutenticado) {
    echo ' Usuário autenticado!';
    $_SESSION['autenticado'] = 'SIM';
} else {
    $_SESSION['autenticado'] = 'NÃO';
    header('Location:../view/login.php?login=erro');
}