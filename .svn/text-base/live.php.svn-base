<?php

/*********************/
/* Structure du LIVE */
/*********************/

include('config.php');

function displayContent(){
	global $idUnif, $university, $longUnif, $dbUnif, $dbAdmin, $connectionAdmin, $dbNetwork, $connectionNetwork;
	
	$YouAreHere = "live";
	//Affiche le code du header
	include('header.php');
	
	echo "<div id=\"content\">\n";
		include('content_live.php');
		echo "	<a class=\"plusDePosts\" href=\"#\">Afficher plus de posts</a>\n";
		echo "	<a class=\"goTop\" href=\"#wrapper\">Haut de la page</a>\n";
	echo "</div> <!-- /content -->\n\n";
	
	echo "<div id=\"sidebar\">\n";
		include('sidebar.php');
	echo"</div> <!-- /sidebar -->\n\n";
	
	//Affiche le code du footer
	include('footer.php');
		
} //displayContent()


//If quelqu'un a posté un nouveau post, sanitize + insert dans la db.
//Puis affiche le nouveau contenu de la page.
if(isset($_POST['posting_button'])){

	/**** POSTING ****/
	$name = $_COOKIE['username'];
	$post = $_POST['posting_area'];
	include ('live_insert_post.php');
	// reload la page avec le nouveau contenu
	displayContent();

} //if(isset())

//Quand la page est loadée, affiche le contenu
else{
	displayContent();
}
?>