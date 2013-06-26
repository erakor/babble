<?

include("calcul_duree.php");

// Fonction limitation de mots - A déplacer dans un fichier fonction plus tard !
function LimitationNbMotsForum($chaine, $nbmots, $titleForum) { // 1er argument : chaîne - 2e argument : nombre de mots
	global $dbUnif;
	$chaine = preg_replace('!<br.*>!iU', "", $chaine); // remplacement des BR par des espaces
	$chaine = strip_tags($chaine);
	$chaine = preg_replace('/\s\s+/', ' ', $chaine); // retrait des espaces inutiles
	$tab = explode(" ",$chaine);
	if (count($tab) <= $nbmots) {
		$affiche = $chaine;
	} else {
		$affiche = "$tab[0]";
		for ($i=1; $i<$nbmots; $i++) {
			$affiche .= " $tab[$i]";
		}
		$link1 = preg_replace('/\s+/', '_', $titleForum);
		$affiche .= " (<a href=\"http://localhost/~amaury/babble/$dbUnif/forum/$link1\" class=\"more\">Lire la suite...</a>)";
	}
	return $affiche;
}

// Select the network's db
$databaseNetwork = mysql_select_db($dbNetwork, $connectionNetwork)
	or die ('Erreur : '.mysql_error() );
$reqForum = "SELECT * FROM forum ORDER BY idForum DESC";
$resultForum = mysql_query($reqForum) or die ('Erreur : '.mysql_error() );

// On vérifie la présence de messages dans la DB
$count = mysql_num_rows($resultForum);
if ($count == 0) {
		echo "<p class='avertissement'>Personne n'a encore posté de message dans le forum.</p>";
}

// renvoie une liste des posts.
else {
	while ($row = mysql_fetch_assoc($resultForum)) {

		// On remet tout nickel
		$idForum = $row["idForum"];
		$authorForum = stripslashes($row["authorForum"]);
		$timestampForum = $row["timestampForum"];
		$messageForum = stripslashes($row["messageForum"]);
		$titleForum = stripslashes($row["titleForum"]);
		
		// On checke les réponses éventuelles. Il affiche le nombre dans la div FORUM_REPLY
		$reqNbReplies = "SELECT * FROM reply WHERE idForum = '$idForum'";
		$resultNbReplies = mysql_query($reqNbReplies) or die ('Erreur : '.mysql_error() );

		// Si il y a moins de 2 réponses, on inscrit réponse. Sinon réponseS
		$NbReplies = mysql_num_rows($resultNbReplies);
		if ($NbReplies < 2) {
			$reponse = "réponse";
		}
		else {
			$reponse = "réponses";
		}
		
		$link = preg_replace('/\s+/', '_', $titleForum);
		$texte = LimitationNbMotsForum($messageForum, 100, $titleForum);
		// Le post (check pas loggedin --> no <a>)
		echo "<div id=\"forum_post-id$idForum\" class=\"forum_post\" pureId=\"$idForum\">\n";
		if($_COOKIE['loggedin'] == 'TRUE')
			echo "	<h2><a href=\"http://localhost/~amaury/babble/$dbUnif/forum/$link\">$titleForum</a></h2>\n";
		else
			echo "	<h2><a href=\"#\">$titleForum</a></h2>\n";
		echo "  <div class=\"forum_message\">\n"
			."    <p>$texte</p>\n"
			."  	<div class=\"forum_replies\">\n";
		if($_COOKIE['loggedin'] == 'TRUE')
			echo "    	<a href=\"http://localhost/~amaury/babble/$dbUnif/forum/$link\"><span>$NbReplies</span> <br />$reponse</a>\n";
		else
			echo "    	<a href=\"#\"><span>$NbReplies</span> <br />$reponse</a>\n";
		echo "  	</div> <!-- forum_replies -->\n"
			."  </div> <!-- forum_message -->\n"
			."	<div class=\"forum_info\">\n"
			."		<div class=\"who\">envoyé par <span>$authorForum</span>, il y a ", CalculDuree("$timestampForum"),"</div>\n";
		if($_COOKIE['loggedin'] == 'TRUE')
			echo "		<a href=\"http://localhost/~amaury/babble/$dbUnif/forum/$link\" class=\"forum_repondre\">réagir &raquo;</a>\n";
		else
			echo "		<a href=\"#\" class=\"forum_repondre\">réagir &raquo;</a>\n";
		echo "	</div> <!-- forum_info -->\n"
			."</div> <!-- forum_post -->\n\n";
	}
}

?>