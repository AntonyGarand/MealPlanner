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
	/* Si on est en mode deboguage, permet d'acitver l'extension PHP console dans chrome */
    require_once('PhpConsole.phar');
    $connector = PhpConsole\Connector::getInstance();
	/* Permet d'executer du php par le navigateur avec le mot de passe "password" */
    $connector->setPassword('password');

    // Configure eval provider
    $evalProvider = $connector->getEvalDispatcher()->getEvalProvider();
    $evalProvider->addSharedVar('post', $_POST); // so "return $post" code will return $_POST
    $evalProvider->setOpenBaseDirs(array(__DIR__)); // see http://php.net/open-basedir

    $connector->startEvalRequestsListener(); // must be called in the end of all configurations
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
    echo("<div class=\"alert ".$class." alert-dismissible fade in\" role='alert'>
            <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">X</a> 
            <strong>".$msgAlert."</strong> ".$message."
        </div>");
}
