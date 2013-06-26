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
	$lastPostOnPage = $_GET['lastPostOnPageId'];

	$reqMessage = "SELECT * FROM live WHERE trashLive < '3' AND idLive < '$lastPostOnPage' ORDER BY idLive DESC LIMIT 10";
	$resultMessage = mysql_query($reqMessage) or die ('Erreur : '.mysql_error() );


	include('live_affichage_post.php');

?>