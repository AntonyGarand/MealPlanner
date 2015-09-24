<?php
/**
 * index.php
 * page d'accueil pour le site de repas…
 * programm&eacute; par Antony Garand
 * le 8 septembre 2015
 */
?>

<?php require_once("./includes/beforeHTML.inc.php"); /* Entete HTML */ ?> 
<?php require("./includes/header.inc.php"); /* Header du site web */?>
<?php require("./includes/dbConfig.php"); /* Informations pour la base de donnee */?>

<!--Profile container-->
<div class="container profile">
    <div class="span11">
        <h1>Le Menu</h1>
        <h3>Yay!</h3>
        <?php 
            /* Format: Jour, type, nb personnes, description, recette nom, temps prep, temps cuisson, temps total, ingredients, preparation */
            $query = 'SELECT repas.jour, repas.typeRepas, repas.nbConvives, repas.description, recette.nom, recette.tempsPreparation, recette.tempsCuisson, recette.tempsTotal, recette.ingredients, recette.preparation FROM repas INNER JOIN recette on recette.id = repas.recette_id';
            @ $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
            if(!$conn){
                die(echoDebug("Erreur de connection au serveur!",3));
            }

            $result = mysqli_query($conn, $query);
            if($result->num_rows > 0){
                echo("<table id='showRecettes'>
                        <tr>
                            <th>Jour</th>
                            <th>Repas</th>
                            <th>Nombre de personnes</th>
                            <th>Description</th>
                            <th>Nom</th>
                            <th>Temps de pr&eacute;paration</th>
                            <th>Temps de cuisson</th>
                            <th>Temps total</th>
                            <th>Ingr&eacute;dients</th>
                            <th>Pr&eacute;paration</th>
                        </tr>
                    ");
                while($row = $result->fetch_row()){
                    for ($i = 0; $i < sizeof($row); $i++){
                        $row[$i] = htmlspecialchars(html_entity_decode($row[$i]));
                    }
                    $repas = ['D&eacute;jeuner','Diner','Souper'];
                    $jour = ['Lundi', 'Mardi', 'Mercred', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
                    printf("<tr>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                            </tr>", $jour[$row[0]-1], $repas[$row[1]-1], $row[2], $row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9]);
                }
                echo("</table>");
            }
            else{
                echoDebug("Aucune donn&eacute;e trouv&eacute;e!");
            }
            echo("<a href=\"index.php\"><button name=\"addRecette\" class=\"addRecette\"> Ajouter un nouveau repas! </button></a>")
        ?>
    </div>
</div>
<!--END: Profile container-->
<?php require("./includes/footer.inc.php"); /* Footer */ ?>
