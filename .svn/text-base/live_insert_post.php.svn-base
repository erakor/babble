<?

/*
	Included in	live.php
							JSInsertPost.php
*/

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
if(strlen($post) > 152){
	echo "Votre post est trop long!";
	die();
}
$post = strip_tags($post, '<a>'); //strip all html tags except '<a>'.
// check si c'est un lien et le rend cliquable.
$post = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)?)@', '<a href="$1" target="_blank">$1</a>', $post);
$post = mysql_real_escape_string($post);

// Select the network's db
$databaseNetwork = mysql_select_db($dbNetwork, $connectionNetwork)
	or die ('Erreur : '.mysql_error() );
// Insert the data in the database
$insertion = "INSERT INTO live (authorLive, messageLive, timestampLive) VALUES ('$name', '$post', '$time')";
$result1 = mysql_query($insertion)
	or die ('Erreur : '.mysql_error() );

?>