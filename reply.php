<?

include('config.php');

function displayContent(){
	global $idUnif, $university, $longUnif, $dbUnif, $dbAdmin, $connectionAdmin, $dbNetwork, $connectionNetwork, $titleInUrl;
	
	$YouAreHere = "reply";
	
	require('header.php');
	echo "<div id=\"content\">\n";
		include('content_reply.php');
		echo "	<a class=\"goTop\" href=\"#wrapper\">Haut de la page</a>\n";
	echo "</div> <!-- /content -->\n";
	
	echo "<div id=\"sidebar\">\n";
		include('sidebar.php');
	echo"</div> <!-- /sidebar -->\n";
	
	//Affiche le code du footer
	include('footer.php');
		
} //displayContent()


if(isset($_POST['posting_button_reply'])){

	/**** POSTING ****/
	// Récupère les variables par la méthode POST
	$name = $_COOKIE['username'];
	$post = $_POST['comment'];
	$idForum = $_POST['idForum']; //hidden input
	// Timestamp
		//set time zone
		date_default_timezone_set('Europe/Brussels');
	$time = date("Y-m-d H:i:s");

	//Sanitize 'name'
	if(strlen($name) == 0){
		echo "Vous devez choisir un nom.";
		die();
	}
	if(strlen($name) > 35){
		echo "Votre nom est trop long!";
		die();
	}
	$name = strip_tags($name);
	$name = mysql_real_escape_string($name);

	//Sanitize 'post'
	if(strlen($post) == 0){
		echo "Vous n'avez rien écrit.";
		die();
	}
	$post = strip_tags($post, '<a>'); //strip all html tags except '<a>'.
	// check si c'est un lien et le rend cliquable.
	$post = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)?)@', '<a href="$1" target="_blank">$1</a>', $post);
	$post = mysql_real_escape_string($post);

	// Insert the data in the database
	$insertion = "INSERT INTO reply (idForum, authorReply, messageReply, timestampReply) VALUES ('$idForum', '$name', '$post', '$time')";
	$result1 = mysql_query($insertion)
		or die ('Erreur : '.mysql_error() );

	// reload la page avec le nouveau contenu
	displayContent();

} //if(isset())

//Quand la page est loadée, affiche le contenu
else{
	displayContent();
}
?>