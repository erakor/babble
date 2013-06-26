<?php

/*	JSSendLogin.php */
/*********************/	

/*	
	Connexion a la db.
	Crée un code d'accès randomly, l'enregistre dans la db.
	Envoit un email avec une link vers identification.php?code=********.
*/

// connexion a la db des codes d'accès.
$host = 'localhost';
$login = 'root';
$password = '';
// connexion au réseau spécifique babble
$dbNetwork = 'admin';
// Connexion à la base de données
$connectionNetwork = mysql_connect($host, $login, $password)
	or die ('Erreur : '.mysql_error() );

//crée un code d'accés de huit lettres ou chiffres.
$code = generatePassword();

// Select the network's db
$databaseNetwork = mysql_select_db($dbNetwork, $connectionNetwork)
	or die ('Erreur : '.mysql_error() );
// Insert the data in the database
$insertion = "INSERT INTO accessCode (code) VALUES ('$code')";
$result1 = mysql_query($insertion)
	or die ('Erreur : '.mysql_error() );

//Envoie un email avec le lien d'activation
/*$to = $_POST['email']."@ulb.ac.be";
$subject = "[babble.be] code d'accès";
$txt = "\nCliquez sur le lien ci-dessous pour accéder à babble ulb:\n\nhttp://www.babble.be/login-test/identification.php?code=".$code."\n\nThanks,\nTeam babble.";
$headers = "From: admin@babble.be";
mail($to,$subject,$txt,$headers);*/

echo "done. url : <a href=\"http://localhost/~amaury/babble/identification.php?code=".$code."\">".$code."</a>";



/* This function creates a random password (courtesy of: http://www.laughing-buddha.net/jon/php/password/) */
function generatePassword() {
	// start with a blank password
	$password = "";
	// define possible characters
	$possible = "0123456789bcdfghjkmnpqrstvwxyz"; 
	// set up a counter
	$i = 0; 
	// add random characters to $password until 8 is reached
	while ($i < 8) { 
		// pick a random character from the possible ones
		$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
		// we don't want this character if it's already in the password
		if (!strstr($password, $char)) { 
			$password .= $char;
			$i++;
		}
	}
	// done!
	return $password;
}

?>