<?php

	include ("calcul_duree.php");
	
	// connexion a la db du network
	$host = 'localhost';
	$login = 'root';
	$password = '';
	// connexion au réseau spécifique babble
	$dbNetwork = $_GET['dbName'];
	// Connexion à la base de données
	$connectionNetwork = mysql_connect($host, $login, $password)
		or die ('Erreur : '.mysql_error() );
	$databaseNetwork = mysql_select_db($dbNetwork, $connectionNetwork)
		or die ('Erreur : '.mysql_error() );

	//récupère l'id du dernier post affiché dans le live.
	$lastPostDisplayed = $_GET['lastPostId'];

	// récupère l'id du dernier post stored dans la db.
	$reqLastId = "SELECT idLive FROM live WHERE trashLive < '3' ORDER BY idLive DESC LIMIT 1";
	$resultLastId = mysql_query($reqLastId) or die ('Erreur : '.mysql_error() );
	while ($row = mysql_fetch_assoc($resultLastId)){
		$lastId = $row["idLive"];
	}
	
	// Compare les deux id's. renvoit une liste des posts les plus récents si id's sont differents.
	if ($lastPostDisplayed < $lastId){
		$reqMessage = "SELECT * FROM live WHERE trashLive < '3' AND idLive > '$lastPostDisplayed' ORDER BY idLive DESC";
		$resultMessage = mysql_query($reqMessage) or die ('Erreur : '.mysql_error() );
	}
	// Il n'y a pas de nouveaux posts à afficher
	else {
		echo "no updates";
		die();
	}

	include('live_affichage_post.php');

?>