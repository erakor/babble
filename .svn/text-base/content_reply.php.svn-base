<?
// Fichier inclu dans la page "reply.php" du forum
// Il récupère les réponses des posts et les affiche suivant l'id donné

include ("calcul_duree.php");

$titleInUrlClean = preg_replace('/_+/', ' ', $titleInUrl);

//Sélectionne la db du network
$databaseNetwork = mysql_select_db($dbNetwork, $connectionNetwork)
	or die ('Erreur : '.mysql_error() );
$reqForum = "SELECT * FROM forum WHERE titleForum = '$titleInUrlClean'";
$resultForum = mysql_query($reqForum) or die ('Erreur : '.mysql_error() );

// On vérifie la présence de messages dans la DB
$count = mysql_num_rows($resultForum);
if ($count == 0) {
		echo "<p class='avertissement'>Aucun message ne correspond à votre requête</p>";
}

// renvoie une liste des posts.
else {
	while ($row = mysql_fetch_assoc($resultForum)) {

		// On remet tout nickel
		$idForum = $row["idForum"];
		$author = stripslashes($row["authorForum"]);
		$timestampForum = $row["timestampForum"];
		$messageForum = stripslashes($row["messageForum"]);
		$up = $row["up"];
		$down = $row["down"];
		$titleForum = stripslashes($row["titleForum"]);
		
		// On checke les réponses éventuelles. Il affiche le nombre dans la div FORUM_REPLY
		$reqNbReplies = "SELECT * FROM reply WHERE idForum = '$idForum'";
		$resultNbReplies = mysql_query($reqNbReplies) or die ('Erreur : '.mysql_error() );

		// Si il y a moins de 2 réponses, on inscrit réponse. Sinon réponseS
		$NbReplies = mysql_num_rows($resultNbReplies);
		if ($NbReplies < 2) {
			$reponse = "réponse";
		}
		else {
			$reponse = "réponses";
		}
		
		// Le post
		echo "<div id=\"forum_post-id$idForum\" class=\"forum_post\" pureId=\"$idForum\">\n"
			."	<h2>$titleForum</h2>\n"
			."	<div class=\"forum_message\">\n"
			."		<p>$messageForum</p>\n"
			// Affichage du nombre de réponses
			."		<div class=\"forum_replies\">\n"
			."			<a href=\"http://localhost/~amaury/babble/$dbUnif/forum/$titleInUrl\"><span>$NbReplies</span> <br />$reponse</a>\n"	
			."		</div> <!-- forum_replies -->\n"
			."	</div><!-- forum_message -->\n"
			."	<div class=\"forum_info\">\n"
			."		<div class=\"who\">envoyé par <span>$author</span>, il y a ", CalculDuree("$timestampForum"),"</div>\n"
			."	</div> <!-- forum_info -->\n"
			."</div> <!-- forum_post -->\n";
	}
}

?>

<div id="form_reply">
	<form action="http://localhost/~amaury/babble/<?echo $dbUnif;?>/forum/<?echo $titleInUrl;?>" method="post" id="posting_form_reply">
		<h5>Répondre à cet article</h5>
		<textarea class="reply_posting" rows="5" cols="76" id="comment" name="comment"></textarea><br />
		<input type="hidden" name="idForum" value="<?echo $idForum;?>">
		<input type="submit" class="button" name="posting_button_reply" value="Envoyer &raquo;">
	</form>
</div> <!-- reply_box -->


<!-- Les réponses -->
<div class="replies">
<?
$reqReplies = "SELECT * FROM reply WHERE idForum = '$idForum' ORDER BY idReply DESC";
$resultReplies = mysql_query($reqReplies) or die ('Erreur : '.mysql_error() );

// On vérifie la présence de réponses dans la DB
$countReplies = mysql_num_rows($resultReplies);
if ($countReplies == 0) {
		echo "<p style=\"margin-top: 10px;\">Soyez le premier à répondre à cet article !</p>";
}

// renvoie une liste des réponses.
else {
	while ($row = mysql_fetch_assoc($resultReplies)) {

		// On remet tout nickel
		$idReply = $row["idReply"];
		$idForum = $row["idForum"];
		$authorReply = stripslashes($row["authorReply"]);
		$messageReply = stripslashes($row["messageReply"]);
		$upReply = $row["upReply"];
		$downReply = $row["downReply"];
		$timestampReply = $row["timestampReply"];
		
		// Et une petite réponse, une !
		echo "<div id=\"comment-$idReply\" class=\"post\" name=\"comment-$idReply\" pureId=\"$idReply\">\n\n";
		
		// info 
		echo "	<div class=\"post_info\">\n"
				."		<h4>$authorReply</h4>\n"
				."		Il y a <span class=\"timechange\">", CalculDuree("$timestampReply"),"</span>\n"
				."	</div> <!-- /post_info -->\n\n";			
			
		// message
		echo "	<div class=\"post_message\">\n";
		
		// score
		echo "		<div class=\"score\">\n";
			if($_COOKIE[$idReply . 'trash_reply'] == 'trash') //disable la bell de ce post
				echo "			<span class=\"bell_off\" title=\"Ce message se trouve maintenant sur notre blacklist.\"></span>\n";
			else
				echo "			<span class=\"bell\" title=\"Signaler un abus\"></span>\n";
			if($_COOKIE[$idReply . 'thumbs_reply'] == 'thumbs'){ //disable les thumbs de ce post
				echo "			<span class=\"thumbs_down_off\" title=\"Vous avez déjà voté.\">$downReply</span>\n"
						."			<span class=\"thumbs_up_off\" title=\"Vous avez déjà voté.\">$upReply</span>\n";
			}
			else{
				echo "			<span class=\"thumbs_down\" title=\"Shut up!\">$downReply</span>\n"
						."			<span class=\"thumbs_up\" title=\"Word up!\">$upReply</span>\n";
			}
		echo "    </div> <!-- /score -->\n";
			
		// le petit "répondre"
		echo "		$messageReply\n"
				."  <a onclick='yus_replyTo(\"$idReply\", \"$authorReply\")' class=\"reply_link\">répondre</a>\n";
			
		echo "  </div> <!-- /post_message -->\n"
				."</div> <!-- /post -->\n\n";
	}
}
?>
</div> <!-- /replies -->
