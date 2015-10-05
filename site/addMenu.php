<?php
/**
 * addMenu.php
 * Page permettant d'ajouter recettes et repas. 
 * programm&eacute; par Antony Garand
 * le 23 septembre 2015
 */
?>
<?php require_once("./includes/beforeHTML.inc.php"); /* Entete HTML */ ?> 
<?php require_once("./includes/debug.php"); /* Fonctions et variables de deboguage */ ?>
<?php require("./includes/header.inc.php"); /* Header du site web */?>
<?php require("./includes/dbConfig.php"); /* Informations pour la base de donnee */?>
<?php
    /* Code pour la v&eacute;rification de l'envoi d'un formulaire. */
	
    $requestMessage = array();
    $errors = array();
    $allGood = True;
    /* Verification si un formulaire a ete envoye */
    if(isset($_POST['submit'])){
        /* Verification si c'est une recette. */
        if(isset($_POST['recette'])){
            $allGood = True;
            /* Verification des variables */
            if(!empty($_POST['TempsPrep']) && !empty($_POST['TempsCuisson']) && !empty($_POST['TempsTotal'])&& !empty($_POST['ingredients'])&& !empty($_POST['preparation']) && !empty($_POST['recetteNom'])){
                
                if(!(is_string($_POST['recetteNom']) AND strlen($_POST['recetteNom']) <= 45)){
                    $errors[] ="Nom de la recette manquant ou invalide!"; 
                    $allGood = False;
                }
                if(!(is_string($_POST['TempsPrep']) AND strlen($_POST['TempsPrep']) <= 20)){
                    $errors[] ="Temps de pr&eacute;paration manquant ou invalide!"; 
                    $allGood = False;
                }
                
                if(!(is_string($_POST['TempsCuisson']) AND strlen($_POST['TempsCuisson']) <= 20)){
                    $errors[] ="Temps de cuisson manquant ou invalide!"; 
                    $allGood = False;
                }
                
                if(!(is_string($_POST['TempsTotal']) AND strlen($_POST['TempsTotal']) <= 20)){
                    $errors[] ="Temps de pr&eacute;paration manquant ou invalide!"; 
                    $allGood = False;
                }
                if(!(is_string($_POST['ingredients']) AND strlen($_POST['ingredients']) <= 500)){
                    $errors[] ="Ingredients manquant ou invalide!"; 
                    $allGood = False;
                }
                
                if(!(is_string($_POST['preparation']) AND strlen($_POST['preparation']) <= 500)){
                    $errors[] ="Pr&eacute;paration manquante ou invalide!"; 
                    $allGood = False;
                }
            }
            else{
                $allGood = False;
                $errors[] = "Tout les champs n'ont pas &eacute;t&eacute;s remplis!";
                
            }
            if($allGood){
                
                @ $mysqli = new mysqli($dbHost,$dbUser,$dbPass,$dbName);
                $recette = "INSERT INTO `monmenu_garandantony`.`recette` (`id`, `nom`,`preparation`, `ingredients`, `tempsPreparation`, `tempsCuisson`, `tempsTotal`) VALUES (NULL, ?, ?, ?, ?, ?, ?);";
                if($request = $mysqli->prepare($recette)){
                    $nom = htmlspecialchars($_POST['recetteNom']);
                    $prep = htmlspecialchars($_POST['preparation']);
                    $ingredients = htmlspecialchars($_POST['ingredients']);
                    $tempsPrep = htmlspecialchars($_POST['TempsPrep']);
                    $tempsCuisson = htmlspecialchars($_POST['TempsCuisson']);
                    $tempsTotal = htmlspecialchars($_POST['TempsTotal']);

                    $request->bind_param("ssssss",$nom, $prep, $ingredients, $tempsPrep, $tempsCuisson, $tempsTotal);
                    $request->execute();
                    $request->close();
                    $requestMessage[] = "La recette &agrave; &eacute;t&eacute; ajout&eacute;e avec succ&egrave;s!";
                }
                else{
                    $requestMessage[] = "Erreur avec la connection au serveur! <br/>Veuillez r&eacute;essayer plus tard.";
                }
                $id = $mysqli->insert_id;
            } /* Fin de la v&eacute;rif des conditions */
        } /* Fin de la partie recette */

        /* Verification si c'est un menu */
        if(isset($_POST['menu'])){
            $allGood = True;

            if(!empty($_POST['Description']) && !empty($_POST['Jours']) && !empty($_POST['Repas']) && !empty($_POST['RecetteID']) && !empty($_POST['NbConvives'])){
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
                if(!(is_numeric($_POST['RecetteID']) AND $_POST['RecetteID'] > 0)){
                    $errors[] ="La recette semble &ecirc;tre invalde! Veuillez r&eacute;essayer"; 
                    $allGood = False;
                }
			}
			else{
				$allGood = False;
				$errors[] = "Tout les champs n'ont pas &eacute;t&eacute;s remplis!";
			}
			if($allGood){
				/* Starting Mysqli connection */
				$mysqli = new mysqli($dbHost,$dbUser,$dbPass,$dbName);

				/* Checking if ID exists */
				$query = "SELECT * FROM `recette` WHERE recette.id = ".$_POST['RecetteID'].";";
				$result = $mysqli->query($query);
				if(!mysqli_num_rows($result)){
					$errors[] = "La recette n'existe pas. <br/>Veuillez r&eacute;essayer!";
					$allGood = False;
					@ $result->close();
					@ $mysqli->close();
				}
				else{
				
					$recette = "INSERT INTO `monmenu_garandantony`.`repas` (`id`, `jour`, `nbConvives`, `typeRepas`, `description`, `recette_id`) VALUES(NULL, ?, ?, ?, ?, ?);";
					if($request = $mysqli->prepare($recette)){
						$jour = $_POST['Jours'];
						$repas = $_POST['Repas'];
						$nbConvives = $_POST['NbConvives'];
						$description = htmlspecialchars($_POST['Description']);
						$recetteID = $_POST['RecetteID'];
						
						$request->bind_param("iiisi",$jour, $nbConvives, $repas, $description, $recetteID);
						$request->execute();
						$request->close();
						$requestMessage[] = "Le repas &agrave; &eacute;t&eacute; ajout&eacute; avec succ&egrave;s!";
					}
					else{
						$requestMessage[] = "Erreur avec la connection au serveur! <br/>Veuillez r&eacute;essayer plus tard.";
					}
					@ $mysqli->close();
				} /* Fin de l'ajout du repas */

            } /* Fin de la v&eacute;rification des champs valides*/
        
        } /* Fin de la v&eacute;rification du menu */
        

    } /* Fin de la v&eacute;rification de l'envoi */
    /* V&eacute;rification du succ&egrave;s de l'ajout */

    /* V&eacute;rification d'un ajout de recette */
    foreach ($requestMessage as $message){
        /* Si "succes" dans les messages:
         *  redirection vers la page menu.php 
         *  Ajout des message dans la variable $_SESSION['message']
         */
        if(strpos($message, "succ&egrave;s")){
            @session_start();
            $_SESSION['message'] = $requestMessage;
            die(header("Location: menu.php"));
        }
    }

?>
<!--Profile container-->
<div class="container profile">
	<?php 
		if(!empty($errors)){
			echo("<br/>");
			echoDebug(sprintf("%s", "<br/>".implode('<br/>',$errors)),2);
		}
		if(!empty($requestMessage)){
			echoDebug((sprintf("%s", "<br/>".implode('<br/>',$requestMessage))));    
		}
	?>
    <div class="span5">
        
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
            <select id="RecetteID" name="RecetteID" required>
                <option value=""></option>
            <?php 
                /* Format:  */
                $query = 'SELECT recette.id, recette.nom FROM recette;';
                @ $conn = new mysqli($dbHost,$dbUser,$dbPass,$dbName);
                if(!$conn){
                    die(echoDebug("Erreur de connection au serveur!",3));
                }

                $result = mysqli_query($conn, $query);
                if($result->num_rows > 0){
                    while($row = $result->fetch_row()){
                        for ($i = 0; $i < sizeof($row); $i++){
                            $row[$i] = htmlspecialchars(html_entity_decode($row[$i]));
                        }
                        printf("<option value=%s>%s</option>", $row[0], $row[1]);
                    }
                    echo("</select>");
                }
                else{
                    echo("</select>");
                    echoDebug("Aucune donn&eacute;e trouv&eacute;e!");
                }
            ?>
            <button name="submit" class="submit" type="submit" >Soumettre le menu</button>
            <input type="hidden" name="menu" id="menu">
        </form>
    </div>
    <div class="span5">
        <h1>Ajouter une recette</h1>
        <form id="AddRecette" action="<?php echo($_SERVER['SCRIPT_NAME']); ?>" name="AddRecette" method="post" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }">
            Nom:
            <br/>
            <input id="recetteNom" name="recetteNom" type="text" maxLength=35 required>
            <br/>
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
