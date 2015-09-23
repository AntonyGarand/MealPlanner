@ECHO OFF
REM Copie un dossier et ses sous-dossiers dans DropBox en ajoutant la date du jour au dossier principal
REM Crée également un script SQL de la base de données MySQL et le copie dans le même dossier dans DropBox
REM Configuration :
REM Dans la zone "Copie du site", changez les mots Chemin, VotreDossier et VotreNom selon la configuration de votre poste de travail
REM Dans la zone "Création du script", modifiez DossierEasyPHP, usagermysql et nombd selon la configuration de votre poste de travail
REM Note : Pour que les accents présents dans les echo s'affichent correctement, utiliser l'encodage OEM 720.
REM Note : Si des noms de dossiers contiennent des caractères accentués, utilisez l'encodage ANSI et ajoutez l'instruction CHCP 1252.
REM Programmé par Christiane Lagacé : http://christianelagace.com
REM Le 26 mars 2013
REM Ajusté par Christiane Lagacé
REM Le 19 décembre 2014
REM Modifications : ajustement de la date pour qu'elle ne soit pas dépendante des configurations système
 
REM ***** Création des variables pour la date *****
REM La commande "WMIC OS GET localdatetime" retrouve la date au format ISO. 
REM Le caractère ^ (caret) est un caractère d'échappement. Le caractère | (pipe) permet de rediriger la sortie de WMIC vers la commande find. 
REM Puisqu'on veut conserver toute la chaîne, on recherche n'importe quel caractère : find "."
REM Autrement dit, cette ligne place toute la date dans la variable dateISO.
 
for /f %%a in ('WMIC OS Get localdatetime  ^| find "."') do set "dateISO=%%a"
set "annee=%dateISO:~0,4%"
set "mois=%dateISO:~4,2%"
set "jour=%dateISO:~6,2%"
 
echo *************************
echo ***** Copie du site *****
echo *************************
 
@echo on
XCOPY "E:\Google Drive\Cours\Session 5\Web\site\*" "E:\Google Drive\Cours\Session 5\Web\siteBackup\%annee%-%mois%-%jour%-site\"/S /I
@echo off
 
echo ***********************************************
echo ***** Création du script pour la BD MySQL *****
echo ***********************************************
 
@echo on
mysqldump -u root -p monmenu_garandantony > "E:\Google Drive\Cours\Session 5\Web\siteBackup\%annee%-%mois%-%jour%-site\monmenu_garandantony-%annee%-%mois%-%jour%.sql
@echo off
 
echo *******************
echo ***** Terminé *****
echo *******************
PAUSE