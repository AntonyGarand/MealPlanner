@ECHO OFF
REM Copie un dossier et ses sous-dossiers dans DropBox en ajoutant la date du jour au dossier principal
REM Cr�e �galement un script SQL de la base de donn�es MySQL et le copie dans le m�me dossier dans DropBox
REM Configuration :
REM Dans la zone "Copie du site", changez les mots Chemin, VotreDossier et VotreNom selon la configuration de votre poste de travail
REM Dans la zone "Cr�ation du script", modifiez DossierEasyPHP, usagermysql et nombd selon la configuration de votre poste de travail
REM Note : Pour que les accents pr�sents dans les echo s'affichent correctement, utiliser l'encodage OEM 720.
REM Note : Si des noms de dossiers contiennent des caract�res accentu�s, utilisez l'encodage ANSI et ajoutez l'instruction CHCP 1252.
REM Programm� par Christiane Lagac� : http://christianelagace.com
REM Le 26 mars 2013
REM Ajust� par Christiane Lagac�
REM Le 19 d�cembre 2014
REM Modifications : ajustement de la date pour qu'elle ne soit pas d�pendante des configurations syst�me
 
REM ***** Cr�ation des variables pour la date *****
REM La commande "WMIC OS GET localdatetime" retrouve la date au format ISO. 
REM Le caract�re ^ (caret) est un caract�re d'�chappement. Le caract�re | (pipe) permet de rediriger la sortie de WMIC vers la commande find. 
REM Puisqu'on veut conserver toute la cha�ne, on recherche n'importe quel caract�re : find "."
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
echo ***** Cr�ation du script pour la BD MySQL *****
echo ***********************************************
 
@echo on
mysqldump -u root -p monmenu_garandantony > "E:\Google Drive\Cours\Session 5\Web\siteBackup\%annee%-%mois%-%jour%-site\monmenu_garandantony-%annee%-%mois%-%jour%.sql
@echo off
 
echo *******************
echo ***** Termin� *****
echo *******************
PAUSE