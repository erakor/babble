<?php

/*	JSInsertPost.php */
/*********************/	

/*	
	Connexion a la db.
	Store les posts dans la base de donnee (nom, post, date).
	Renvoit un feedback afficher dans premier onglet.
*/

// connexion a la db du network
$host = 'localhost';
$login = 'root';
$password = '';
// connexion au réseau spécifique babble
$dbNetwork = $_POST['dbName'];
// Connexion à la base de données
$connectionNetwork = mysql_connect($host, $login, $password)
	or die ('Erreur : '.mysql_error() );
$databaseNetwork = mysql_select_db($dbNetwork, $connectionNetwork)
	or die ('Erreur : '.mysql_error() );


// Récupère les variables par la méthode POST	(check jscript)
$name = $_POST['name'];
$post = $_POST['post'];
include ('live_insert_post.php');

if($result1){
	echo "Message posté";
} else {
	echo "Erreur. Essayez encore.";
}
?>