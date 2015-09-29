<?php 
    if(!empty($_POST['repasID'])){
        require_once("./includes/dbConfig.php"); /* Informations pour la base de donnee */
        require_once("./includes/debug.php"); /* Fonctions et variables de deboguage */
        
        /* Checking if the ID is valid */
        if(!is_int(intval($_POST['repasID']))){
           die(echoDebug("Erreur!<br/>La recette n'existe pas!", 3)); 
        }

        /* Starting Mysqli connection */
        $mysqli = new mysqli($dbHost,$dbUser,$dbPass,$dbName);
        if(!$mysqli){
            die(echoDebug("Erreur de connection au serveur!",3));
        }
        /* Checking if ID exists in database */
        $query = "SELECT * FROM `repas` WHERE repas.id = ".$_POST['repasID'].";";
        $result = $mysqli->query($query);
        if(!mysqli_num_rows($result)){
                @ $result->close();
                @ $mysqli->close();
                die(echoDebug("La recette n'existe pas. <br/>Veuillez r&eacute;essayer!",2));
        }

        $request = "DELETE FROM `monmenu_garandantony`.`repas` WHERE `repas`.`id` =" . $_POST['repasID'] . ";";
        $result = $mysqli->query($request);
        if($result){
                @ $mysqli->close();
                die(echoDebug("<br/>La recette &agrave; &eacute;t&eacute; supprim&eacute;e avec succ&egrave;s!",0));
        }
        else{
            die(echoDebug("La recette n'existe pas. <br/>Veuillez r&eacute;essayer!",2));
        }
        @ $mysqli->close();

    }
