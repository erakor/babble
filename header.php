<? 
// 	HEADER.PHP
//	Contient tout le header commun aux pages.
//	Doit être 'require' au début de chaque page
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<link rel="stylesheet" type="text/css" media="screen" href="http://localhost/~amaury/babble/css/reset.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="http://localhost/~amaury/babble/css/babble.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="http://localhost/~amaury/babble/css/jqtransform.css" />
	<link type="text/css" media="screen" rel="stylesheet" href="http://localhost/~amaury/babble/css/colorbox.css" />
		<link rel="shortcut icon" href="http://localhost/~amaury/babble/img/favicon.ico" />

	<script src="http://localhost/~amaury/babble/js/jquery-1.3.2.min.js" type="text/javascript"></script>
	<script src="http://localhost/~amaury/babble/js/jquery.cookie.js" type="text/javascript"></script>
	<script src="http://localhost/~amaury/babble/js/jquery.livequery.js" type="text/javascript"></script>
	<script src="http://localhost/~amaury/babble/js/jquery.jqtransform.js" type="text/javascript"></script>
	<script src="http://localhost/~amaury/babble/js/autoresize.jquery.min.js" type="text/javascript"></script>
	<script src="http://localhost/~amaury/babble/js/jquery.colorbox-min.js" type="text/javascript"></script>
	<script src="http://localhost/~amaury/babble/js/behavior_all.js" type="text/javascript"></script>
	<script src="http://localhost/~amaury/babble/js/behavior_login.js" type="text/javascript"></script>
	
	<?
	if($YouAreHere == "live") echo "<script src=\"http://localhost/~amaury/babble/js/behavior_live.js\" type=\"text/javascript\"></script>";
	else if($YouAreHere == "forum" || $YouAreHere == "reply") echo "<script src=\"http://localhost/~amaury/babble/js/behavior_forum_reply.js\" type=\"text/javascript\"></script>";
	?>
	
	<script type="text/javascript">	
		$(document).ready(function(){
			
			// rend les onglets off entièrement clickable
			$("#forum #live_box").click(function(){
				window.location="http://localhost/~amaury/babble/<? echo $dbUnif ?>/live";
				return false;
			});
			$("#reply #live_box").click(function(){
				window.location="http://localhost/~amaury/babble/<? echo $dbUnif ?>/live";
				return false;
			});
			$("#live #forum_box").click(function(){
				window.location="http://localhost/~amaury/babble/<? echo $dbUnif ?>/forum";
				return false;
			});		

		});
	</script>
	
	<title>babble &raquo; <? echo $university; ?></title>

</head>

<body id="<? echo $YouAreHere; ?>">
	
<div id="wrapper">
	<div id="header" dbName="<? echo $dbUnif; ?>">
		<h1><a href="http://localhost/~amaury/babble/<? echo $dbUnif ?>" title="babble &raquo;<? echo $dbUnif ?>">babble &raquo;</a></h1> <strong class="tab"><span><? echo $university; ?></span></strong>
		
		<p class="name_picking" id="name_picking">
			Ton nom est : <span>
				<?
			if($_COOKIE['username']!=null)
				echo "". $_COOKIE['username'] . "</span> <a href=\"http://localhost/~amaury/babble/name_page.php?id=".$idUnif."\">(changer)</a>\n";
			else
				echo "</span> <a href=\"http://localhost/~amaury/babble/name_page.php?id=".$idUnif."\">(cliquez ici pour choisir un nom)</a>\n";
			?>
		</p> <!-- name_picking -->
	</div> <!-- /header -->

	<div id="name_panel">
		<? include ('name_panel.php');?>
	</div> <!-- name_panel -->
