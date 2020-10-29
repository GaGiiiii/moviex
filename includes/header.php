<?php require_once "classes/User.php"; ?>
<?php include_once "includes/globals.php"; ?>
  <?php 
    $currentPage = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], '/')); //  /prijava /registracija /index.php
  ?>
  
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MOVIEX</title>
     <!-- OWL CAROUSEL -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css"> <!-- Ovde treba putanja kao da smo u index.php fajlu a ne u header.php -->
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="./public/styles/style.css"> <!-- Ovde treba putanja kao da smo u index.php fajlu a ne u header.php -->
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/5c5689b7a2.js"></script>
  </head>
  <body>
  
    <!-- NAVBAR -->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="<?php echo SITE_URL; ?>">MOVIEX</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php if($currentPage == '/index.php') echo 'active'; ?>">
            <a class="nav-link" href="<?php echo SITE_URL; ?>">Početna <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item <?php if($currentPage == '/repertoar.php') echo 'active'; ?>">
                <a class="nav-link" href="repertoar.php">Repertoar</a>
          </li>
          <li class="nav-item <?php if($currentPage == '/uskoro.php') echo 'active'; ?>">
                <a class="nav-link" href="uskoro.php">Uskoro</a>
          </li>
          <?php if(User::isLoggedIn() && $_SESSION['user']['is_admin']) { ?>
            <li class="nav-item <?php if($currentPage == '/karte.php') echo 'active'; ?>">
                  <a class="nav-link" href="karte.php">Karte</a>
            </li>
          <?php } ?> 
        </ul>
        <ul class="navbar-nav">
        <?php if(User::isLoggedIn()){ ?>
            <li class="nav-item <?php if($currentPage == '/admin.php') echo 'active'; ?>">
                <a class="nav-link" href="<?php if($_SESSION['user']['is_admin']) echo SITE_URL . 'admin'; else echo '#'; ?>">Ulogovani kao: <strong><?php echo $_SESSION['user']['username']; ?><?php if($_SESSION['user']['is_admin']) echo " (admin)"; ?></strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo SITE_URL; ?>logout">Logout</a>
            </li>
        <?php }else{ ?>
          <li class="nav-item <?php if($currentPage == '/register.php') echo 'active'; ?>">
            <a class="nav-link" href="<?php echo SITE_URL; ?>register">Register</a>
          </li>
          <li class="nav-item <?php if($currentPage == '/login.php') echo 'active'; ?>">
            <a class="nav-link" href="<?php echo SITE_URL; ?>login">Login</a>
          </li>
        <?php } ?>
        </ul>
      </div>
    </nav>
    <!-- NAVBAR -->