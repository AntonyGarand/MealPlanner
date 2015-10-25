<?php
/**
 * header.inc.php
 * Menu pour le site de repas
 * programmé par Antony Garand
 * le 23 septembre 2015
 */
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Gestion de repas</title>
<meta name="description" content="Repas">
<meta name="keywords" content="responsive, bootstrap, flat design, flat ui, portfolio">
<meta name="author" content="Antony">
<meta name="description" content="Site permettant d'organiser ses repas">
<!-- styles -->
<link href="includes/css/bootstrap.css" rel="stylesheet">
<link href="includes/css/bootstrap-responsive.css" rel="stylesheet">
<link href="includes/css/style.css" rel="stylesheet">
<link href="includes/font/css/fontello.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
    <div class="navbar noPrint">
        <div class="navbar-inner">
        <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="index.php"><img src="medias/commun/user.jpg" alt="logo"/></a>
          <ul class="nav nav-collapse pull-right">
            <li><a href="index.php" class="active"><i class="icon-user"></i>Index</a></li>
            <li><a href="menu.php"><i class="icon-trophy"></i>Afficher le menu</a></li>
            <li><a href="addMenu.php"><i class="icon-picture"></i>Ajouter un menu</a></li>
            </ul>
                <!-- Everything you want hidden at 940px or less, place within here -->
                <div class="nav-collapse collapse">
                    <!-- .nav, .navbar-search, .navbar-form, etc -->
                </div>
            </div>
        </div>
    </div>
