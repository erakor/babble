<?
$host = 'localhost';
$login = 'root';
$password = '';

$dbAdmin = 'admin';

// connexion ADMIN
$connectionAdmin = mysql_connect($host, $login, $password)
	or die ('Erreur : '.mysql_error() );

$databaseAdmin = mysql_select_db($dbAdmin, $connectionAdmin)
	or die ('Erreur : '.mysql_error() );

// Récupère l'idUnif dans l'URL
$network = $_GET['id'];

// Récupère l'idUnif dans la db 'admin' et définit les variables
$reqA = "SELECT * FROM unif WHERE idUnif = '$network'";
$resultA = mysql_query($reqA) or die ('Erreur : '.mysql_error() );
while ($rowA = mysql_fetch_assoc($resultA)){
	$idUnif = $rowA["idUnif"];
	$university = $rowA["shortUnif"];
	$longUnif = $rowA["fullUnif"];
	$dbUnif = $rowA["dbUnif"];
}

// connexion au réseau spécifique babble
$dbNetwork = $dbUnif;

// Connexion à la base de données
$connectionNetwork = mysql_connect($host, $login, $password)
	or die ('Erreur : '.mysql_error() );

$databaseNetwork = mysql_select_db($dbNetwork, $connectionNetwork)
	or die ('Erreur : '.mysql_error() );


if(isset($_POST['name_button'])){
	$selected_name = $_POST['group1'];
	
	// check si a créé un nom personnel
	if($selected_name == "personal")
		$selected_name = $_POST['choisir_nom']; // récupérer le text du text input
	
	//Sanitize 'name'
	if(strlen($selected_name) == 0){
		echo "Vous devez choisir un nom.";
		die();
	}
	if(strlen($selected_name) > 35){
		echo "Votre nom est trop long!";
		die();
	}
	$selected_name = strip_tags($selected_name);
	$selected_name = mysql_real_escape_string($selected_name);
	//setcookie 'username'
	if(setcookie("username", $selected_name, false, "/", false))
		header('Location: http://localhost/~amaury/babble/'.$dbUnif.'/live');
}

?>
<form method="POST" action="name_page.php?id=<?echo $idUnif;?>">
<input type="radio" name="group1" value="personal"><input type="text" name="choisir_nom" size="20"/></input><br>
<?
$databaseAdmin = mysql_select_db($dbAdmin, $connectionAdmin)
	or die ('Erreur : '.mysql_error() );
// récupère l'id de la dernière entrée dans la db.
$reqForum1 = "SELECT idAuthor FROM author ORDER BY idAuthor DESC LIMIT 1";
$resultForum1 = mysql_query($reqForum1) or die ('Erreur : '.mysql_error() );
while ($row1 = mysql_fetch_assoc($resultForum1)){
	$lastId = $row1["idAuthor"];
}

for($i = 1; $i < 16; $i++){
	// choisi un id au hasard.
	$random_id = rand(1, $lastId);
	
	$reqForum2 = "SELECT * FROM author WHERE idAuthor = '$random_id'";
	$resultForum2 = mysql_query($reqForum2);
	$count2 = mysql_num_rows($resultForum2);
	
	// si l'id choisi ne correspond plus a un author (au cas ou il a été effacé)
	// count sera égale a 0, donc choisi un autre id au hasard...
	while($count2 == 0){
		$random_id = rand(1, $lastId);
		$reqForum2 = "SELECT * FROM author WHERE idAuthor = '$random_id'";
		$resultForum2 = mysql_query($reqForum2);
		$count2 = mysql_num_rows($resultForum2);
	}
	
	$row2 = mysql_fetch_assoc($resultForum2);
	
	echo "<label><input type=\"radio\" name=\"group1\" value=\"" . stripslashes($row2["nomAuthor"]) . "\">" . stripslashes($row2["nomAuthor"]) . "</input></label><br>";
	
}
?>
<input type="submit" class="button" name="name_button" value="sélectionner &raquo;"/>
</form><!-- form -->