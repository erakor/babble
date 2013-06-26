<?php
	
	// connexion a la db du network
	$host = 'localhost';
	$login = 'root';
	$password = '';
	// connexion au réseau spécifique babble
	$dbAdmin = 'admin';
	// Connexion à la base de données
	$connectionAdmin = mysql_connect($host, $login, $password)
		or die ('Erreur : '.mysql_error() );
	
	include('name_panel.php');
?>