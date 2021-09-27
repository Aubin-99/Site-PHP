<?php
require_once 'includes/db.php';
require_once 'includes/function.php';
require_once 'includes/session_function.php';

function lightHeader(){
    if($_SERVER['REQUEST_URI'] === '/'
    ||$_SERVER['REQUEST_URI'] === '/index.php'
    ||$_SERVER['REQUEST_URI'] === '/contact.php'
    ||$_SERVER['REQUEST_URI'] === '/single.php'){
             return '';
    }

    return 'light-header';
}

function setActive($path = null){
    if(substr($_SERVER['REQUEST_URI'],1) === $path){
        return 'active';
    }

    return '';
}



?>





<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Coding City">
	<title><?= isset($title) ? $title : WEBSITE_NAME ?></title>
	<link rel="icon" href="assets/imgs/Coding%20city.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/styles.css">

	<!-- Font awesome link (Lien pour les jolies icones) -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
</head>
<body>
	<!-- header section -->
	<header class="header" <?= lightHeader()?> id="header">
		<div class="container">
			<div class="header-container">
				<a href="#" class="logo"><img class="img" src="assets/imgs/MCC.png" alt="Logo"></a><!-- Logo -->
				<nav class="navigation"><!-- Navigation begin -->
					<ul class="nav-links" id="nav-links"><!-- Navlinks container (ul) -->
						<li class="nav-item"><a href="index.php" class="nav-link <?= setActive('index.php')?>">Accueil <i class="fas fa-home"></i></a></li>
                        <li class="nav-item submenu"><!-- submenu link -->
                            <a href="#" class="nav-link">Blog <i class="fas fa-comments"></i></a>
                            <ul class="dropdown-menu"><!-- Dropdown container (ul) -->
                                <li class="nav-item">
                                    <a href="blog.php" class="nav-link <?= setActive('blog.php')?>">Blog <i class="fas fa-comment"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a href="single.php" class="nav-link <?= setActive('single.php')?>">Single Blog <i class="far fa-newspaper"></i></a>
                                </li>
                            </ul><!-- End dropdown container -->
                        </li>
						<li class="nav-item"><a href="contact.php" class="nav-link <?= setActive('contact.php')?>">Contact <i class="fas fa-envelope"></i></a></li>
                        <?php if (!logged_in()): ?>
                            <li class="nav-item"><a href="register.php" class="nav-link">S'inscrire <i class="fas fa-door-open"></i></a></li>
                            <li class="nav-item"><a href="login.php" class="nav-link">Se connecter <i class="fas fa-sign-in-alt"></i></a></li>
                        <?php endif; ?>

                        <?php if(logged_in()):?>
                        <li class="nav-item submenu">
                            <a class="nav-link d-flex align-items-center">
                                <strong> Aubin Drawine </strong>
                                <img src="<?= ds_info('image')?>" alt="" class="rounded-circle rounded-0" width="30px" height="30px">
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="profile.php?id=<?= $_SESSION['id']?>">
                                        Profil <i class="fas fa-user-cog"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logout.php">
                                        Se déconnecter <i class="fas fa-sign-out-alt"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php endif; ?>
					</ul><!-- End Navlinks container -->
				</nav>
				<a href="#" class="hamburger" id="hamburger"><i class="fas fa-bars"></i></a><!-- hamburger menu icon -->
			</div>
		</div>
	</header>
	<!-- end header section -->