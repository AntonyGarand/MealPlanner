<?php
/**
 * index.php
 * page d'accueil pour le site de repas…
 * programmé par Antony Garand
 * le 8 septembre 2015
 */
?>

<?php require_once("./includes/beforeHTML.inc.php"); /* Entête HTML */ ?> 
<?php require("./includes/header.inc.php"); /* Header du site web */?>
<!--Profile container-->
<div class="container profile">
    <div class="span11">
        <h1>Le Menu</h1>
        <h3>Yay!</h3>
        <?php 
            /* Format: Jour, Periode, Repas, Temps prep, temps cuisson, ingredients, preparation */
            $query = 'SELECT repas.jour, repas.typeRepas, repas.description, repas.tempsPrep, repas.tempsCuisson, recette.ingredients, recette.preparation from repas 
INNER JOIN recette ON repas.recette_id = recette.id;';
            @ $conn = new mysqli("127.0.0.1","rootjr","password","monmenu_garandantony");
            if(!$conn){
                die(echoDebug("Erreur de connection au serveur!",3));
            }

            $result = mysqli_query($conn, $query);
            if($result->num_rows > 0){
                echo("<table id='showRecettes'>
                        <tr>
                            <th>Jour</th>
                            <th>P&eacute;riode</th>
                            <th>Repas</th>
                            <th>Temps de pr&eacute;paration</th>
                            <th>Temps de cuisson</th>
                            <th>Ingr&eacute;dients</th>
                            <th>Pr&eacute;paration</th>
                        </tr>
                    ");
                while($row = $result->fetch_row()){
                    for ($i = 0; $i < sizeof($row); $i++){
                        $row[$i] = htmlspecialchars(html_entity_decode($row[$i]));
                    }
                    printf("<tr>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                            </tr>", $row[0], $row[1], $row[2], $row[3],$row[4],$row[5],$row[6]);
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
