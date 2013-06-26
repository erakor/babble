<?
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
	
	
	$id = $_POST['id'];
	
	if($_POST['which']=='up')
		$reqMessage = "SELECT upLive FROM live WHERE idLive=$id";
	else if($_POST['which'] == 'down')
		$reqMessage = "SELECT downLive FROM live WHERE idLive=$id";
	else if($_POST['which'] == 'trash')
		$reqMessage = "SELECT trashLive FROM live WHERE idLive=$id";
		
	$resultMessage = mysql_query($reqMessage);
	$donnees = mysql_fetch_array($resultMessage);
	
	$val = $donnees[0];
	$val = $val + 1;
	
	if ($resultMessage) {
		if($_POST['which']=='up')
			$req = "UPDATE live SET upLive=$val WHERE idLive=$id";
		else if($_POST['which'] == 'down')
			$req = "UPDATE live SET downLive=$val WHERE idLive=$id";
		else if($_POST['which'] == 'trash')
			$req = "UPDATE live SET trashLive=$val WHERE idLive=$id";
			
		$result = mysql_query($req) or die ('Erreur : '.mysql_error() );
		echo "$val";
	}
	//kakakaka
?>