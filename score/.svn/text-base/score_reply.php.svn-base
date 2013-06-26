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
	

	$id = $_POST['idDuPost'];
	
	if($_POST['which']=='up')
		$reqMessage = "SELECT upReply FROM reply WHERE idReply=$id";
	else if($_POST['which'] == 'down')
		$reqMessage = "SELECT downReply FROM reply WHERE idReply=$id";
	else if($_POST['which'] == 'trash')
		$reqMessage = "SELECT trashReply FROM reply WHERE idReply=$id";
		
	$resultMessage = mysql_query($reqMessage);
	$donnees = mysql_fetch_array($resultMessage);
	
	$val = $donnees[0];
	$val = $val + 1;
	
	if ($resultMessage) {
		if($_POST['which']=='up')
			$req = "UPDATE reply SET upReply=$val WHERE idReply=$id";
		else if($_POST['which'] == 'down')
			$req = "UPDATE reply SET downReply=$val WHERE idReply=$id";
		else if($_POST['which'] == 'trash')
			$req = "UPDATE reply SET trashReply=$val WHERE idReply=$id";
			
		$result = mysql_query($req) or die ('Erreur : '.mysql_error() );
		echo "$val";
	}
	
?>