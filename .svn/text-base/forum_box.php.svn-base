<? 
// 	FORUM_BOX.PHP
//	Définit et affiche tous les états du second onglet
//	Grâce aux if qui dirigent selon $YouAreHere
//	PS : Ne fonctionne que si il n'y a que 2 états


if ($YouAreHere == "forum") { // Quand l'onglet est ON
	//onglet forum when logged in
	if($_COOKIE['loggedin'] == 'TRUE'){
    echo "<div id=\"forum_box\">\n"
		."	<h2>crée un nouveau sujet ici</h2>\n"
		."	<form action=\"http://localhost/~amaury/babble/".$dbUnif."/forum\" method=\"post\" id=\"posting_form_forum\" dbName=\"".$dbUnif."\">\n"
		."  	<input type=\"text\" name=\"title_forum\" id=\"title_forum\" class=\"text_field\" size=\"36\" />\n"
		."		<textarea name=\"posting_area_forum\" id=\"posting_area_forum\" rows=\"4\" cols=\"34\" class=\"forum\"></textarea>\n"
		."		<input type=\"submit\" name=\"posting_button_forum\" class=\"button\" value=\"Envoyer &raquo;\"/>\n"
		."	</form>\n"
		."	<p class=\"feedback\"></p>\n"
		."</div> <!-- /forum_box -->\n\n";
	}
	// l'utilisateur doit encore s'identifier
	else{
		require ('login_box.php');
	}
}

else if ($YouAreHere == "reply") {
	echo "<div id=\"forum_box\">\n"
		."    <h2><a href=\"http://localhost/~amaury/babble/".$dbUnif."/forum\">retour au forum</a></h2>\n"
		."</div>\n\n";
}

else{
	echo "<div id=\"forum_box\">\n"
		."	<h2>on en discute dans le forum</h2>\n";

	// Sélectionne la db du network
	$databaseNetwork = mysql_select_db($dbNetwork, $connectionNetwork)
		or die ('Erreur : '.mysql_error() );
	// Print a list of the latest topics in the forum.
	$reqForum = "SELECT idForum, titleForum FROM forum ORDER BY idForum DESC LIMIT 6";
	$resultForum = mysql_query($reqForum) or die ('Erreur : '.mysql_error() );

	// On vérifie la présence de messages dans la DB
	$count = mysql_num_rows($resultForum);
	if ($count == 0) {
		echo "<p class='avertissement'>Aucun message ne correspond à votre requête</p>";
	}
	else {
		while ($row = mysql_fetch_assoc($resultForum)) {
			$titleForum = stripslashes($row["titleForum"]);
			$idForum = $row["idForum"];
			// On checke les réponses éventuelles. Il affiche le nombre dans la div FORUM_REPLY
			$reqNbReplies = "SELECT * FROM reply WHERE idForum = '$idForum'";
			$resultNbReplies = mysql_query($reqNbReplies) or die ('Erreur : '.mysql_error() );
			$NbReplies = mysql_num_rows($resultNbReplies);
			// limiter le nombre de caractères
			if(strlen($titleForum) > 34)
				$titleForum = substr($titleForum, 0, 34) . '...';
			
			echo "	<div class=\"sneakpeek_forum\">\n"
				."		<p>$titleForum</p>\n"
				."		<div class=\"sneakpeek_replies\">$NbReplies</div>\n"
				."	</div>\n";
		}
	}
	echo "	<a class=\"moveOn\" href=\"http://localhost/~amaury/babble/".$dbUnif."/forum\">Accéder au forum &raquo;</a>\n";
	echo "</div> <!-- /forum_box -->\n\n";
}

?>