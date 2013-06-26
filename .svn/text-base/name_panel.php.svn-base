<?
// sélecte la db 'admin'
$databaseAdmin = mysql_select_db($dbAdmin, $connectionAdmin)
	or die ('Erreur : '.mysql_error() );
// récupère l'id de la dernière entrée dans la db.
$reqForum1 = "SELECT idAuthor FROM author ORDER BY idAuthor DESC LIMIT 1";
$resultForum1 = mysql_query($reqForum1) or die ('Erreur : '.mysql_error() );
while ($row1 = mysql_fetch_assoc($resultForum1)){
	$lastId = $row1["idAuthor"];
}

echo "<div class=\"info\">\n"
		."<strong>Pour se choisir un pseudo,</strong> soit tu le choisis parmi ceux qui sont proposés, soit tu crées le tien.<br/>Il sera ton pseudo pour cette session. C'est parti !"
		."</div>\n\n";

echo "<form class=\"name\" action=\"\">\n"
		."<ul class=\"name-list\">\n";
for($i=0; $i<20; $i++){
	
	// choisi un id au hasard.
	$random_id = rand(1, $lastId);
	//le select dans la db.
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
	if($i == 3 OR $i == 7 OR $i == 11 OR $i == 15 OR $i == 19)
		echo "	<li class=\"last-name\">";
	else
		echo "	<li>";
	echo "	<input type=\"radio\" name=\"group1\" id=\"".$random_id."\" value=\"" . stripslashes($row2["nomAuthor"]) . "\" /><label for=\"".$random_id."\" title=\"" . stripslashes($row2["infoAuthor"]) . "\">" . stripslashes($row2["nomAuthor"]) . "</label><a href=\"".$row2["lienAuthor"]."\" target=\"_blank\" class=\"who\" title=\"En savoir plus sur ". stripslashes($row2["nomAuthor"])."\">(?)</a></li>\n";
	
}
	echo "<li class=\"your-name\"><input type=\"radio\" name=\"group1\" id=\"personal\" value=\"personal\" />\n"
			."<label for=\"personal\" id=\"choose_your_own_label\">ou crée <strong>le tien !</strong></label>\n"
			."<input type=\"text\" id=\"choisir_nom\" /></li>\n";
	echo "</ul>\n";
	
	echo "<div id=\"action-name\">"
		."<a href=\"#\" class=\"refresh-name\" title=\"Rafraîchir la liste\">Rafraîchir cette liste</a>"
		."<input type=\"submit\" class=\"button\" id=\"select_name\" value=\"Sélectionner &raquo;\" />"
		."</div>";

echo "</form> <!-- .name -->";
?>