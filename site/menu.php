<?php
/**
 * index.php
 * page d'accueil pour le site de repas…
 * programme par Antony Garand
 * le 8 septembre 2015
 */
?>
<?php require_once("./includes/debug.php"); /* Fonctions et variables de deboguage */ ?>
<?php require_once("./includes/beforeHTML.inc.php"); /* Variables */ ?> 
<?php require("./includes/header.inc.php"); /* Header du site web */?>
<?php
@session_start();
if(!empty($_SESSION['message'])){
    $requestMessage = $_SESSION['message'];
    unset($_SESSION['message']);
}

?>
<!--Profile container-->
<div class="container profile">
    <div class="span11">
        <h1>Le Menu</h1>
        <?php 
            /* &Eacute;criture des message si venons d'ajouter un repas */
            if(!empty($requestMessage)){
                    echoDebug((sprintf("%s", "<br/>".implode('<br/>',$requestMessage))));    
            }

            /* Format: Jour, type, nb personnes, description, recette nom, temps prep, temps cuisson, temps total, ingredients, preparation */
            $query = 'SELECT repas.jour, repas.typeRepas, repas.nbConvives, repas.description, recette.nom, recette.tempsPreparation, recette.tempsCuisson, recette.tempsTotal, recette.ingredients, recette.preparation, repas.id FROM repas INNER JOIN recette on recette.id = repas.recette_id ORDER BY repas.jour, repas.typeRepas';
            @ $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
            if(!$conn){
                die(echoDebug("Erreur de connection au serveur!",3));
            }
            echo("<div class=\"message\"> </div>");
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
                            <th>Suppression</th>
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
                                <td>%s</td>
                            </tr>", $jour[$row[0]-1], $repas[$row[1]-1], $row[2], $row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9], "<a class=\"delete $row[10]\">Supprimer</a>");
                }
                echo("</table>");
            }
            else{
                echoDebug("Aucune donn&eacute;e trouv&eacute;e!");
            }
            echo("<a href=\"addMenu.php\" class=\"addRecette\">Ajouter un nouveau repas!</a>");
        ?>
        <br/>
        <br/>
        <br/>
    </div>
</div>
<!--END: Profile container-->
<?php require("./includes/footer.inc.php"); /* Footer */ ?>
