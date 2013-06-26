<? 
// 	LIVE_BOX.PHP
//	Définit et affiche tous les états du premier onglet
//	Grâce aux if qui dirigent selon $YouAreHere
//	PS : Ne fonctionne que si il n'y a que 2 états

?>

<?

include("calcul_duree2.php");

if ($YouAreHere == "live" ) {
	//onglet live when logged in
	if($_COOKIE['loggedin'] == 'TRUE'){
    echo "<div id=\"live_box\">\n"
			."	<h2>vide ta tête ici</h2><p class=\"countdown\" id=\"countdown\"></p>\n"
			."	<form action=\"http://localhost/~amaury/babble/".$dbUnif."/live\" method=\"post\" id=\"posting_form\">\n"
			."		<textarea name=\"posting_area\" id=\"posting_area\" rows=\"5\" cols=\"34\"></textarea>\n"
			."		<div class=\"loading_live\">loading...</div>"
			."		<input type=\"submit\" class=\"button\" name=\"posting_button\" value=\"Envoyer &raquo;\"/>\n"
			."	</form>\n"
			."	<p class=\"warning\"></p>\n"
			."</div> <!-- /live_box -->\n\n";
	}
	// l'utilisateur doit encore s'identifier
	else {require ('login_box.php');}
}
else {

	echo "<div id=\"live_box\">\n"
		."	<h2>en ce moment sur le live</h2>\n"
		."	<div id=\"sneakpeek_list_live\">\n";

	// Sélectionne la db du network
	$databaseNetwork = mysql_select_db($dbNetwork, $connectionNetwork)
		or die ('Erreur : '.mysql_error() );
	// Liste des derniers posts du live
	$reqForum = "SELECT idLive, messageLive, timestampLive FROM live WHERE trashLive < '3' ORDER BY idLive DESC LIMIT 6";
	$resultForum = mysql_query($reqForum) or die ('Erreur : '.mysql_error() );
	// On vérifie la présence de messages dans la DB
	$count = mysql_num_rows($resultForum);
	if ($count == 0) {
		echo "<p class='avertissement'>Aucun message ne correspond à votre requête</p>";
	}
	else {
		while ($row = mysql_fetch_assoc($resultForum)) {
			$id = $row["idLive"];
			$messageLive = stripslashes($row["messageLive"]);
			$messageLive = strip_tags($messageLive);
			$time = $row["timestampLive"];
			// limiter le nombre de caractères
			if(strlen($messageLive) > 34)
				$messageLive = substr($messageLive, 0, 34) . '...';
			echo "		<div class=\"sneakpeek_live\" id=\"".$id."\">\n"
				."			<p>$messageLive</p>\n"
				."			<div class=\"sneakpeek_time\">", CalculDuree2("$time"),"</div>\n"
				."		</div>\n";
		}
	}
	echo "	</div><!-- sneakpeek_list_live -->\n"
		."	<a class=\"moveOn\" href=\"http://localhost/~amaury/babble/".$dbUnif."/live\">Accéder au live &raquo;</a>\n"
		."</div> <!-- /live_box -->\n\n";
}

?>