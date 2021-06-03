<?php
/*
try
{
	$bdd = new PDO('mysql:host=localhost;port=3307;dbname=gbaf;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}*/

//* Définir les constantes
define ("DBHOST","localhost");
define ("DBUSER","root");
define ("DBPASS","root");
define ("DBNAME","gbaf");
define ("DBPORT","3307");

//*Chemin de connexion
$dsn = "mysql:dbname=".DBNAME.";host=".DBHOST.";port=".DBPORT;

//* Se connecter à la base de données en try catch pour afficher un message d'erreur si impossible
try
{
	$db = new PDO($dsn, DBUSER,DBPASS);
    //*définir le format d'envoi des données
    $db->exec("SET NAMES utf8");
    
}
catch(PDOException $e)
{
        die($e->getMessage());
}
//* Exemple d'insertion dans base de données
/*$sql = "INSERT INTO users (`name`,`password`) VALUES ('essai1','bidule')";
$requete = $db->query($sql);*/
?>