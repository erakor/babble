<?php

/**********************/
/* Structure du FORUM */
/**********************/

include('config.php');

function displayContent(){
	global $idUnif, $university, $longUnif, $dbUnif, $dbAdmin, $connectionAdmin, $dbNetwork, $connectionNetwork;
	
	$YouAreHere = "forum";
	//Affiche le code du header
	include('header.php');
	
	echo "<div id=\"content\">\n";
		include('content_forum.php');
		echo "<a class=\"goTop\" href=\"#wrapper\">Haut de la page</a>";
	echo "</div> <!-- /content -->\n";
	
	echo "<div id=\"sidebar\">\n";
		include('sidebar.php');
	echo"</div> <!-- /sidebar -->\n";
	
	//Affiche le code du footer
	include('footer.php');
		
} //displayContent()


//If quelqu'un a posté un nouveau post, sanitize + insert dans la db.
//Puis affiche le nouveau contenu de la page.
if(isset($_POST['posting_button_forum'])){

	/**** POSTING ****/
	// Récupère les variables par la méthode POST
	$name = $_COOKIE['username'];
	$title = $_POST['title_forum'];
	$post = $_POST['posting_area_forum'];
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

	//Sanitize 'title'
	if(strlen($title) == 0 || $title == "Titre"){
		echo "Vous devez choisir un titre.";
		die();
	}
	if(strlen($title) > 245){
		echo "Votre titre est trop long!";
		die();
	}
	$title = strip_tags($title);
	$title = mysql_real_escape_string($title);

	//Sanitize 'post'
	if(strlen($post) == 0){
		echo "Vous n'avez rien écrit.";
		die();
	}
	$post = strip_tags($post, '<a><object><param><embed>'); //strip all html tags except '<a>', '<object>', '<param>' and '<embed>' (for youtube videos).
	// check si c'est un lien et le rend cliquable.
	$post = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)?)@', '<a href="$1" target="_blank">$1</a>', $post);
	$post = mysql_real_escape_string($post);

	// Insert the data in the database
	$insertion = "INSERT INTO forum (titleForum, messageForum, authorForum, timestampForum) VALUES ('$title', '$post', '$name', '$time')";
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