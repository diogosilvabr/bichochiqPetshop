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
                <!-- injeção de icone com javascript -->
                <!-- injeção de div com javascript -->
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
                <!-- codigo injetado por javascript -->
            </div>
        </div>
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

    <!-- css - 0.5 -->
    <header class="carrossel">
        <?php 
            include('blades/carrossel-slide.php');
        ?>
    </header>

    <!-- 06 -->
    <section class="containerMax bgAzulGelo">
        <div class="all-container">
            <?php 
                include('blades/frete.php');
            ?>

            <!-- css - 0.7 -->
            <?php 
                /*******************************
                    0.7 FAVORITE-PRODUCTS
                ********************************/
                include('blades/favorite-products__cards.php');
            ?>

            <section class="grid-animals__desktop">
                <div class="container-animals__desktop">
                    <?php 
                        include('blades/gridAnimals.php');
                    ?>
                </div>
            </section>

            <section class="grid-animals__mobile">
                <div class="container-animals__mobile">
                <div class="title-about">
                    <div class="dashed-title"></div>
                    <h1>Seleção de produtos <span>para cada espécie animal</span></h1>
                    <p>com a qualidade e a variedade que você procura!</p>
                </div>
                    <?php 
                        include('blades/gridAnimals__mobile.php');
                    ?>
                </div>
            </section>

            <?php 
                /*******************************
                    0.9 SPECIAL-OFERTS__CARDS
                ********************************/
                include('blades/special-oferts__cards.php');
            ?>
            
            <?php 
                /*******************************
                    1.0 FORYOU-ANIMALS
                ********************************/
                include('blades/forAnimals.php');
            ?>

            <?php
                /*******************************
                    1.1 PETS-SERVICES
                ********************************/
                include('blades/pets-services.php');
            ?>


            <?php 
                /*******************************
                    1.2 FOOD-ANIMALS
                ********************************/
                include('blades/food-animals.php');
            ?>

        </div>
    </section>
    
    <footer class="footer">
        <?php 
            include('blades/footer-links.php');
        ?>
    </footer>

    <script src="js/script.js"></script>
    <script src="js/gridAnimals.js"></script>
    <script src="js/pesquisa.js"></script>
    <script src="js/menumobile.js"></script>
    <script src="js/foryouAnimals.js"></script>
    <script src="js/petsServices.js"></script>
    <script src="js/teste.js"></script>
<?php
    include("blades/footer.php");
?>