<?
/*
	Included in	content_live.php
							JSGetPosts.php
*/

// On vérifie la présence de messages dans la DB.
$count = mysql_num_rows($resultMessage);
if ($count == 0)
		echo "<p class='avertissement'>Personne n'a encore posté de message.</p>";

// renvoie une liste des posts.
else {
	while ($row = mysql_fetch_assoc($resultMessage)) {

		// On remet tout nickel
		$idLive = $row["idLive"];
		$authorLive = stripslashes($row["authorLive"]);
		$timestampLive = $row["timestampLive"];
		$messageLive = stripslashes($row["messageLive"]);
		$upLive = $row["upLive"];
		$downLive = $row["downLive"];
		$trashLive = $row["trashLive"];

		// Tadam tadam ! Le post !
		echo  "<div id=\"$idLive\" class=\"post\" name=\"$idLive\">\n";

		// INFO
		echo "  <div class=\"post_info\">\n"
			."    <h4>$authorLive</h4>\n"
			."    Il y a <span class=\"timechange\">", CalculDuree("$timestampLive"),"</span>\n"
			."  </div> <!-- post_info -->\n";

		// MESSAGE
		echo "  <div class=\"post_message\">\n";

		// SCORE
		echo "    <div class=\"score\">\n";
			if($_COOKIE[$idLive . 'trash_live'] == 'trash') //disable la bell de ce post
				echo "			<span class=\"bell_off\" title=\"Ce message se trouve maintenant sur notre blacklist.\"></span>\n";
			else
				echo "			<span class=\"bell\" title=\"Signaler un abus\"></span>\n";
			if($_COOKIE[$idLive . 'thumbs_live'] == 'thumbs'){ //disable les thumbs de ce post
				echo "	    <span class=\"thumbs_down_off\" title=\"Vous avez déjà voté.\">$downLive</span>\n"
					."	    <span class=\"thumbs_up_off\" title=\"Vous avez déjà voté.\">$upLive</span>\n";
			}
			else{
				echo "	    <span class=\"thumbs_down\" title=\"Shut up!\">$downLive</span>\n"
					."	    <span class=\"thumbs_up\" title=\"Word up!\">$upLive</span>\n";
			}
		echo "    </div> <!-- score -->\n";

		echo "    <p>$messageLive</p>\n"
			."  </div> <!-- post_message -->\n"
			."</div> <!-- post -->\n\n";
	} //while
} //else

?>