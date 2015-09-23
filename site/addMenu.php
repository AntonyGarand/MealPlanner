<?php
/**
 * addMenu.php
 * Page permettant d'ajouter recettes et repas. 
 * programmé par Antony Garand
 * le 23 septembre 2015
 */
?>

<?php require_once("./includes/beforeHTML.inc.php"); /* Entête HTML */ ?> 
<?php require_once("./includes/debug.php"); /* Fonctions et variables de deboguage */ ?>
<?php require("./includes/header.inc.php"); /* Header du site web */?>
<?php
    /* Code pour la vérification du formulaire. */
    $showMessage = False;
    $requestMessage = "";
    $errors = array();
    $allGood = True;
    /* Verification si un formulaire a ete envoye */
    if(empty($_POST['submit'])){
        /* Verification si c'est une recette. */
        if(!empty($_POST['recette'])){
            $allGood = True;
            if(!empty($_POST['TempsPrep']) && !empty($_POST['TempsCuisson']) && !empty($_POST['TempsTotal'])&& !empty($_POST['ingredients'])&& !empty($_POST['preparation'])){
                 
            }
            else{
                $allGood = False;
                $showMessage = True;
                $requestMessage[] = "";
                
            }
        }
        /* Verification si c'est un menu */
        if(isSet($_POST['menu'])){

        }

        if(isSet($_POST['Description']) && isSet($_POST['Jours']) && isSet($_POST['Repas']) && isSet($_POST['NbConvives']) && isSet($_POST['TempsPrep']) && isSet($_POST['TempsCuisson']) && isSet($_POST['ingredients']) && isSet($_POST['preparation']))
        {
            if(!(is_string($_POST['Description']) AND strlen($_POST['Description']) <= 150 )){
                $allGood = False;
                $errors[] ="Description manquante ou invalide!";
            }   
            if(!(is_numeric($_POST['Jours']) AND $_POST['Jours'] > 0 AND $_POST['Jours'] <= 7 )){
                $errors[] ="Jours manquant ou invalide!"; 
                $allGood = False;
            }
            
            if(!(is_numeric($_POST['Repas']) AND $_POST['Repas'] > 0 AND $_POST['Repas'] <= 3 )){
                $errors[] ="Repas manquant ou invalide!"; 
                $allGood = False;
            }
            
            if(!(is_numeric($_POST['NbConvives']) AND $_POST['NbConvives'] > 0)){
                $errors[] ="Nombre de convives manquant ou invalide!"; 
                $allGood = False;
            }
            
            if(!(is_string($_POST['TempsPrep']) AND strlen($_POST['TempsPrep']) <= 20) AND strlen($_POST['TempsPrep']) >= 2){
                $errors[] ="Temps de pr&eacute;paration manquant ou invalide!"; 
                $allGood = False;
            }
            
            if(!(is_string($_POST['TempsCuisson']) AND strlen($_POST['TempsCuisson']) <= 20) AND strlen($_POST['TempsCuisson']) >= 2){
                $errors[] ="Temps de cuisson manquant ou invalide!"; 
                $allGood = False;
            }
            
            if(!(is_string($_POST['ingredients']) AND strlen($_POST['ingredients']) <= 500) AND strlen($_POST['ingredients']) >= 2){
                $errors[] ="Ingredients manquant ou invalide!"; 
                $allGood = False;
            }
            
            if(!(is_string($_POST['preparation']) AND strlen($_POST['preparation']) <= 500) AND strlen($_POST['preparation']) >= 2){
                $errors[] ="Pr&eacute;paration manquante ou invalide!"; 
                $allGood = False;
            }
            
            if(FALSE){//$allGood){
                @ $mysqli = new mysqli("127.0.0.1","rootjr","password","monmenu_garandantony");
                $recette = "INSERT INTO `monmenu_garandantony`.`recette` (`id`, `preparation`, `ingredients`) VALUES (NULL, ?, ?);";
                if($request = $mysqli->prepare($recette)){
                    $request->bind_param("ss",htmlspecialchars($_POST['preparation']),htmlspecialchars($_POST['ingredients']));
                    $request->execute();
                    $request->close();
                }
                else{
                    $showMessage = True;
                    $requestMessage = "Erreur avec la connection au serveur! <br/>Veuillez r&eacute;essayer plus tard.";
                }
                $id = $mysqli->insert_id;
                if($id == 0){
                    $errors[] = "Erreur dans l'&eacute;criture des donn&eacute;es! Veuillez r&eacute;essayer plus tard";
                }
                else{
                    $repas = "INSERT INTO `monmenu_garandantony`.`repas` (`id`, `jour`, `typeRepas`, `description`, `tempsPrep`, `tempsCuisson`, `recette_id`) VALUES (NULL,?,?,?,?,?,".$id.");";
                    if($request = $mysqli->prepare($repas)){
                        $request->bind_param("iisss",$_POST['Jours'],$_POST['Repas'],htmlspecialchars($_POST['Description']),htmlspecialchars($_POST['TempsPrep']),htmlspecialchars($_POST['TempsCuisson']));
                        $request->execute();
                        $showMessage = True;
                        $requestMessage = "Les donn&eacute;es ont &eacute;t&eacute;s ajout&eacute;es avec succ&egrave;s!";
                        $request->close(); 
                    }
                }
                @ $mysqli->close();
            }
        }
        else{
            $requestMessage = "Tout les champs n'ont pas &eacute;t&eacute;s remplis!"; 
        }
    }

?>
<!--Profile container-->
<div class="container profile">
    <div class="span5">
        <?php 
            if(!$allGood){
                echo("<br/>");
                echoDebug(sprintf("%s", "<br/>".implode('<br/>',$errors)),2);
            }
            else{
                if($showMessage){
                    echoDebug($requestMessage);    
                }
            }
        ?>
        <h1>Ajouter un menu</h1>

        <form id="AddMenu" action="<?php echo($_SERVER['SCRIPT_NAME']); ?>" name="AddMenu" method="post" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }">
            <label for="Description">Description:</label>
            <input id="Description" name="Description" type="text" maxlength=150 autofocus required>
            <br/>
            Jour:
            <select id="Jours" name="Jours" >
                <option value=1>Lundi</option>
                <option value=2>Mardi</option>
                <option value=3>Mercredi</option>
                <option value=4>Jeudi</option>
                <option value=5>Vendredi</option>
                <option value=6>Samedi</option>
                <option value=7>Dimanche</option>
            </select>
            <br/>
            Repas:
            <select id="Repas" name="Repas" >
                <option value="1">D&eacute;jeuner</option>
                <option value="2">Diner</option>
                <option value="3">Souper</option>
            </select>
            <br/>
            Nombre de convives:
            <input id="NbConvives" name="NbConvives" type="number" min="1" value="1" required>
            <br/>
            <?php /* TODO: Select avec recette */ ?>
            Recette: 
            <select id="RecetteID" name="RecetteID">
                <option value=""></option>
            </select>
            
            <button name="submit" class="submit" type="submit" >Soumettre le menu</button>
            <input type="hidden" name="menu" id="menu">
        </form>
    </div>
    <div class="span5">
        <h1>Ajouter une recette</h1>
        <form id="AddRecette" action="<?php echo($_SERVER['SCRIPT_NAME']); ?>" name="AddRecette" method="post" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }">
            Temps de Pr&eacute;paration:
            <br/>
            <input id="TempsPrep" name="TempsPrep" type="text" maxlength=20 required >
            <br/>
            Temps de cuisson:
            <input id="TempsCuisson" name="TempsCuisson" type="text" maxlength=20 required >
            <br/>
            Temps Total:
            <br/>
            <input id="TempsTotal" name="TempsTotal" type="text" maxlength=20 required >
            <br/>
            Ingr&eacute;dients:
            <textarea maxlength="500" id="ingredients" name="ingredients" rows="4" cols="50" required></textarea>
            <br/>
            Pr&eacute;paration:
            <textarea maxlength="500" id="preparation" name="preparation" rows="4" cols="50" required></textarea>
            <button name="submit" class="submit" type="submit" >Soumettre la recette</button>
            <input type="hidden" name="recette" id="recette">
        </form>
    </div>
</div>
<!--END: Profile container-->
<?php require("./includes/footer.inc.php"); /* Footer */ ?>
