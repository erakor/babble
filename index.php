<?
/******************************/
/* Grâce au fichier .htaccess,*/
/* tous les url sont orientés */
/* vers index.php qui s'occupe*/
/* de traiter l'URI.          */
/******************************/
/*  /!\ index de params n'est */
/*	pas le même sur MAMP			*/
/******************************/

$navString = $_SERVER['REQUEST_URI'];
$params = explode('/', $navString); // Break into an array
// Lets look at the array of items we have:
//print_r($params);

// mesures de précaution UPDATE A L'AJOUT D'UN NETWORK
$safe_networks = array("work_in_progress"); // /!\lowercase

// pas d'argument après babble.be/
if($params[3] == null){
	include('homepage.php');
}

// il y a qqchose d'écrit après babble.be/...
else if(in_array(strtolower($params[3]), $safe_networks)){
	$network = strtolower($params[3]);
	
	// babble.be/network/live
	if($params[4] == 'live'){
		include('live.php');
	}
	// babble.be/network/forum(/...)
	else if($params[4] == 'forum'){
		if ($params[5] == null){
			include('forum.php');
		}
		else {
			$titleInUrl = $params[5];
			include('reply.php');
		}
	}
	
	// babble.be/network
	else if($params[4] == null){
		include('live.php');
	}
	
	else {
		include('homepage.php');
	}
}

// si le network est mauvais.
else {
	include('homepage.php');
}
?>
