<?php
/********************* 

 * connexion aux deux bases de donées
 * Se charge de récuper en GET l'idUnif dans l'URL
 * Redéfinit et rend disponibles les variables présentes dans la DB

*********************/

$host = 'localhost';
$login = 'root';
$password = '';

$dbAdmin = 'admin';

// connexion ADMIN
$connectionAdmin = mysql_connect($host, $login, $password)
	or die ('Erreur : '.mysql_error() );

$databaseAdmin = mysql_select_db($dbAdmin, $connectionAdmin)
	or die ('Erreur : '.mysql_error() );

// Récupère l'idUnif dans l'URL
//$network = $_GET['id'];

// Récupère l'idUnif dans la db 'admin' et définit les variables
$reqA = "SELECT * FROM unif WHERE dbUnif = '$network'";
$resultA = mysql_query($reqA) or die ('Erreur : '.mysql_error() );
while ($rowA = mysql_fetch_assoc($resultA)){
	$idUnif = $rowA["idUnif"];
	$university = $rowA["shortUnif"];
	$longUnif = $rowA["fullUnif"];
	$dbUnif = $rowA["dbUnif"];
}

// connexion au réseau spécifique babble
$dbNetwork = $dbUnif;

// Connexion à la base de données
$connectionNetwork = mysql_connect($host, $login, $password)
	or die ('Erreur : '.mysql_error() );

$databaseNetwork = mysql_select_db($dbNetwork, $connectionNetwork)
	or die ('Erreur : '.mysql_error() );

?>