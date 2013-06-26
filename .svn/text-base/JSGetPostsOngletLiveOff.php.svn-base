<?

include ("calcul_duree2.php");

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
	$reqForum = "SELECT idLive, messageLive, timestampLive FROM live WHERE trashLive < '3' ORDER BY idLive DESC LIMIT 6";
	$resultForum = mysql_query($reqForum) or die ('Erreur : '.mysql_error() );
}
// Il n'y a pas de nouveaux posts à afficher
else {
	echo "no updates";
	die();
}

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

?>