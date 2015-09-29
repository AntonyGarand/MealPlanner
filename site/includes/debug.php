<?php
/**
 * debug.php
 * fonctions et variables de deboguage
 * programmé par Antony Garand
 * le 8 septembre 2015
 */
?>
<?php  

$debug = true;

if ($debug) {
    // g&egrave;re et affiche tous les niveaux d'erreurs en mode d&eacute;bogage
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}
else {
    // en mode production, ne g&egrave;re pas certains niveaux pour des raisons de performance (ceux pr&eacute;c&eacute;d&eacute;s de ~), tel que sugg&eacute;r&eacute; dans php.ini
    // m&ecirc;me pour les niveaux g&eacute;r&eacute;s, aucun message ne sera affich&eacute;
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    ini_set('display_errors', '0');
}   

function echoDebug($message, $type = 1){
    $class = "alert-info";
    $msgAlert = "Info!";
    if($type == 0){
        $class = "alert-success";
        $msgAlert = "Succ&egrave;s!";
    }
    else if($type == 2){
        $class = "alert-warning";
        $msgAlert = "Attention!";
    }
    else if($type == 3){
        $class = "alert-danger";
        $msgAlert = "Danger!";
    }
    echo("<div class=\"alert ".$class."\">
            <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">X</a> 
            <strong>".$msgAlert."</strong> ".$message."
        </div>");
}