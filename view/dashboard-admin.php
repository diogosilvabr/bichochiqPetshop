<?php
include("blades/header.php");
?>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/fonts.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="menu-screen"></div>

<!-- css -- 0.0 -->
<nav class="nav-space">
    <div class="search-navbar__desktop">
        <div class="search-desktop">
            <?php
            include('blades/search.php');
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

<section class="containerMax bgAzulGelo">
    <div class="all-container">
    
    </div>
</section>


<footer class="footer">
    <?php
    include('blades/footer-links.php');
    ?>
</footer>

<script src="js/script.js"></script>
<script src="js/dropdowns.js"></script>

<?php
include("blades/footer.php");
?>