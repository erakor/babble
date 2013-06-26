<?php

/**** Affiche la liste des 30 derniers posts ****/

include('calcul_duree.php');

// Sélecte la db du network
$databaseNetwork = mysql_select_db($dbNetwork, $connectionNetwork)
	or die ('Erreur : '.mysql_error() );
//Sélecte les 30 messages les plus récents.
$reqMessage = "SELECT * FROM live WHERE trashLive < '3' ORDER BY idLive DESC LIMIT 10";
$resultMessage = mysql_query($reqMessage) or die ('Erreur : '.mysql_error() );

include('live_affichage_post.php');

?>