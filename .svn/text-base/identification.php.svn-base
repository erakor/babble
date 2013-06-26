<?php

//reprend le code dans l'adresse 'www.babble.be/identification.php?code=********'
$id = $_GET['code'];

if ($id != ""){
	
	// connexion a la db des codes d'accès.
	$host = 'localhost';
	$login = 'root';
	$password = '';
	// connexion au réseau spécifique babble
	$dbNetwork = 'admin';
	// Connexion à la base de données
	$connectionNetwork = mysql_connect($host, $login, $password)
		or die ('Erreur : '.mysql_error() );
	// Select the network's db
	$databaseNetwork = mysql_select_db($dbNetwork, $connectionNetwork)
		or die ('Erreur : '.mysql_error() );
	
	//vérifie que le code soit bien dans la base de données.
	$reqForum = "SELECT code FROM accessCode WHERE code = '$id' ORDER BY idCode DESC LIMIT 1";
	$resultForum = mysql_query($reqForum)
		or die ('Erreur : '.mysql_error() );

	$count = mysql_num_rows($resultForum);
	if ($count != 0){
		//balance un cookie.
		setcookie('loggedin', 'TRUE', false, "/", false); // !!!!! il faut rajouter une échéance d'expiration au cookie
		
		//redirige vers live
		header('Location:http://localhost/~amaury/babble/work_in_progress');
		
		//ce message apparaît si le server prend du temps à checker la db.
		echo "Un peu de patience. Babble n'est plus qu'à quelques secondes.";
		die();
	} //if
	else
		echo "Votre code d'accès n'est pas valide.";	
} //if

else
	echo "Nice try. You can't access this page.";


?>
