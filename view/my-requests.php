<?php
include("blades/header.php");
?>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/fonts.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div class="menu-screen"></div>
    <div class="selected-products">
        <div class="selected-products__button">
            <div class="icon">
                <!-- CODIGO INJETADO POR JAVASCRIPT -->
            </div>
        </div>

        <div class="selected-products__list">
            <div class="selected-products__title">
                <h1>Meu Carrinho</h1>
            </div>
            <div class="selected-products__infos">
                <!-- CODIGO INJETADO POR JAVASCRIPT -->
            </div>
            <div class="selected-products__subtotal">
                <!-- CODIGO INJETADO POR JAVASCRIPT -->
            </div>
        </div>
    </div>

    <div class="login-modal">
        <h1 class="login-modal__title">Login</h1>
        <form class="form">
            <p class="login-account__text">Não tem uma conta? <a href="#" class="login-account__link">Crie sua conta</a>, leva menos de um minuto.</p>
        
            <div class="login-account">
                <div class="login-input">
                    <label class="login-input__label">E-mail</label>    
                    <input type="email" class="login-input__input" />
                </div>
                <div class="login-input">
                    <label class="login-input__label">Senha</label>    
                    <input type="password" class="login-input__input" />
                </div>
            </div>

            <div class="remember">  
                <div class="form-check">
                    <input type="checkbox" id="remember-me">
                    <label for="remember-me">Lembrar de mim</label>
                </div>

                <a href="#">Esqueceu sua senha?</a>
            </div>

            <div class="doLogin-social-media">
                <button type="submit" class="submit-button">Entrar</button>
                <p class="divisory"></p>
                <div class="social-medias">
                    <a href="#">
                        <svg width="22" height="14" viewBox="0 0 22 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 6H20V4H18V6H16V8H18V10H20V8H22M7 6V8.4H11C10.8 9.4 9.8 11.4 7 11.4C4.6 11.4 2.7 9.4 2.7 7C2.7 4.6 4.6 2.6 7 2.6C8.4 2.6 9.3 3.2 9.8 3.7L11.7 1.9C10.5 0.7 8.9 0 7 0C3.1 0 0 3.1 0 7C0 10.9 3.1 14 7 14C11 14 13.7 11.2 13.7 7.2C13.7 6.7 13.7 6.4 13.6 6H7Z" fill="black"/>
                        </svg>
                    </a>

                    <a href="#">
                        <svg width="22" height="17" viewBox="0 0 22 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.46 2C20.69 2.35 19.86 2.58 19 2.69C19.88 2.16 20.56 1.32 20.88 0.31C20.05 0.81 19.13 1.16 18.16 1.36C17.37 0.5 16.26 0 15 0C12.65 0 10.73 1.92 10.73 4.29C10.73 4.63 10.77 4.96 10.84 5.27C7.27998 5.09 4.10998 3.38 1.99998 0.79C1.62998 1.42 1.41998 2.16 1.41998 2.94C1.41998 4.43 2.16998 5.75 3.32998 6.5C2.61998 6.5 1.95998 6.3 1.37998 6V6.03C1.37998 8.11 2.85998 9.85 4.81998 10.24C4.19071 10.4122 3.53007 10.4362 2.88998 10.31C3.16158 11.1625 3.69351 11.9084 4.41099 12.4429C5.12847 12.9775 5.99543 13.2737 6.88998 13.29C5.37361 14.4904 3.49397 15.1393 1.55998 15.13C1.21998 15.13 0.879978 15.11 0.539978 15.07C2.43998 16.29 4.69998 17 7.11998 17C15 17 19.33 10.46 19.33 4.79C19.33 4.6 19.33 4.42 19.32 4.23C20.16 3.63 20.88 2.87 21.46 2Z" fill="black"/>
                        </svg>
                    </a>

                    <a href="#">
                        <svg width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.11999 3.32003H11V0.14003C10.0897 0.045377 9.17514 -0.00135428 8.25999 2.98641e-05C5.53999 2.98641e-05 3.67999 1.66003 3.67999 4.70003V7.32003H0.609985V10.88H3.67999V20H7.35998V10.88H10.42L10.88 7.32003H7.35998V5.05003C7.35998 4.00003 7.63999 3.32003 9.11999 3.32003Z" fill="black"/>
                        </svg>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="create-account">
        <h1 class="login-modal__title">Cadastrar</h1>
        <form class="form">
            <div class="form-container__create">
                <div class="login-account">
                    <div class="login-input">
                        <label class="login-input__label">Nome</label>    
                        <input type="text" class="login-input__input" />
                    </div>
                    <div class="login-input">
                        <label class="login-input__label">E-mail</label>    
                        <input type="email" class="login-input__input" />
                    </div>
                    <div class="login-input">
                        <label class="login-input__label">Senha</label>    
                        <input type="password" class="login-input__input" />
                    </div>
                    <div class="login-input">
                        <label class="login-input__label">Repitir a senha</label>    
                        <input type="password" class="login-input__input" />
                    </div>
                </div>

                <div class="important-create">
                    <div class="important">
                        <svg width="26" height="28" viewBox="0 0 26 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 17.1747V10.8253C1 8.68932 2.136 6.71465 3.98133 5.63998L9.98133 2.14798C11.8467 1.06265 14.152 1.06265 16.0173 2.14798L22.0173 5.63998C23.864 6.71465 25 8.68932 25 10.8253V17.1747C25 19.3107 23.864 21.2853 22.0187 22.36L16.0187 25.852C14.1533 26.9373 11.848 26.9373 9.98267 25.852L3.98267 22.36C2.136 21.2853 1 19.3107 1 17.1747V17.1747Z" stroke="#1D9BF0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <p>Importante! <br> Preencha todos os dados</p>
                    </div>
                    <button type="submit" class="submit-button" id="cadastrarUsuario">Cadastar</button>
                </div>
            </div>

            <div class="form-container__congratulations">
                <div class="congratulations-dog">
                    <img src="imgs/Petshop_files/congratulations-dog.png" alt="">
                </div>
                <div class="btt-dog amareloOuro"></div>
                <div class="btt-dog-h azul">
                    <p>Cadastrado com sucesso!</p>
                    <p>Bem-vindo ao <span>BichoChic</span></p>
                </div>
                <div class="comeback">
                    <a href="principal.php">Voltar para a home</a>
                </div>
            </div>
        </form>
    </div>

    <!-- css -- 0.0 -->
    <nav class="nav-space">
        <div class="search-navbar__desktop">
            <div class="search-desktop">
                <?php
                    include('blades/search.php');
                ?> 
            </div>

            <div class="navbar-desktop">
                <?php 
                    include('blades/navbar.php');
                ?>
            </div>
        </div>
        
        
        <div class="search-navbar__mobile">
            <div class="search-mobile">
                <?php
                    include('blades/search-mobile.php');
                ?> 
            </div>

            <div class="navbar-mobile">
                <?php 
                    include('blades/navbar-mobile.php');
                ?>
            </div>
        </div>
    </nav>

    <div class="welcome-user">
        <h6>Seja bem vindo, <span>Pablo</span></h6>
        <p class="manage-page">
            <svg width="21" height="18" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 16C1.45 16 0.979002 15.804 0.587002 15.412C0.195002 15.02 -0.000664969 14.5493 1.69779e-06 14V2C1.69779e-06 1.45 0.196002 0.979002 0.588002 0.587002C0.980002 0.195002 1.45067 -0.000664969 2 1.69779e-06H8L10 2H18C18.55 2 19.021 2.196 19.413 2.588C19.805 2.98 20.0007 3.45067 20 4V7.25C19.7 7.03334 19.3833 6.85 19.05 6.7C18.7167 6.55 18.3667 6.41667 18 6.3V4H2V14H9.075C9.125 14.35 9.2 14.6917 9.3 15.025C9.4 15.3583 9.525 15.6833 9.675 16H2ZM15 18L14.7 16.5C14.5 16.4167 14.3123 16.329 14.137 16.237C13.9617 16.145 13.7827 16.0327 13.6 15.9L12.15 16.35L11.15 14.65L12.3 13.65C12.2667 13.45 12.25 13.2333 12.25 13C12.25 12.7667 12.2667 12.55 12.3 12.35L11.15 11.35L12.15 9.65L13.6 10.1C13.7833 9.96667 13.9627 9.85433 14.138 9.763C14.3133 9.67167 14.5007 9.584 14.7 9.5L15 8H17L17.3 9.5C17.5 9.58333 17.6877 9.671 17.863 9.763C18.0383 9.855 18.2173 9.96734 18.4 10.1L19.85 9.65L20.85 11.35L19.7 12.35C19.7333 12.55 19.75 12.7667 19.75 13C19.75 13.2333 19.7333 13.45 19.7 13.65L20.85 14.65L19.85 16.35L18.4 15.9C18.2167 16.0333 18.0377 16.146 17.863 16.238C17.6883 16.33 17.5007 16.4173 17.3 16.5L17 18H15ZM16 15C16.55 15 17.021 14.804 17.413 14.412C17.805 14.02 18.0007 13.5493 18 13C18 12.45 17.804 11.979 17.412 11.587C17.02 11.195 16.5493 10.9993 16 11C15.45 11 14.979 11.196 14.587 11.588C14.195 11.98 13.9993 12.4507 14 13C14 13.55 14.196 14.021 14.588 14.413C14.98 14.805 15.4507 15.0007 16 15Z" fill="white"/>
            </svg>
            Gerenciar Página
        </p>
    </div>

    <section class="containerMax bgAzulGelo">
        <div class="all-container">
            <?php 
                include('blades/requests-products.php');
            ?>  
        </div>
    </section>
    
    <footer class="footer">
        <?php 
            include('blades/footer-links.php');
        ?>
    </footer>


    <script src='js/teste.js'></script>
    <script src="js/script.js"></script>
    <script src="js/dropdowns.js"></script>
    <script src="js/menumobile.js"></script>
<?php
    include("blades/footer.php");
?>