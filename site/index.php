<?php
/**
 * index.php
 * page d'accueil pour le site de repas…
 * programme par Antony Garand
 * le 8 septembre 2015
 */
?>

<?php require_once("./includes/beforeHTML.inc.php"); /* Ent&ecirc;te HTML */ ?> 
<?php require_once("./includes/debug.php"); /* Fonctions et variables de deboguage */ ?>
<?php require("./includes/header.inc.php"); /* Header du site web */?>


<!--Profile container-->
<div class="container profile">
    <div class="span11">
        <p>Ce site permet de se cr&eacute;er un horaire de menus compos&eacute;s de repas.</p>
        <a href="addMenu.php" class="button">Ajouter un menu</a>
        <br/>
        <a href="menu.php" class="button">Afficher les donn&eacute;es du menu</a>
    </div>
</div>
<!--END: Profile container-->
<?php require("./includes/footer.inc.php"); /* Footer */ ?>
