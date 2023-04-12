<?php 
    include("blades/header.php");
?>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/fonts.css" />

    <h1 class="titulo-cards">CARDS</h1>
    <section class="container">
        <div class="flow">
            <?php 
                include('blades/favorite-products__cards.php');
            ?>
        </div>
    </section>

    

    <section class="grid-objetos">
        <div class="container__grid-objetos">
        <?php
            include('blades/gridAnimals.php');
        ?>        
        </div>
    </section>

    <script src="../js/script.js"></script>
    <script src="../js/gridAnimals.js"></script>

<?php
    include("blades/footer.php");
?>