<?

// Calculer le temps écoulé entre la date/heure du post et l'heure/date actuelle
function calculDuree($datedupost) {
	
	//set time zone
	date_default_timezone_set('Europe/Brussels');
	
	// -- DATE DU POST -- 
	$seconde = substr($datedupost,17,2);	// On récupère les secondes	
	$minute = substr($datedupost,14,2);		// On récupère les minutes
	$heure = substr($datedupost,11,2);		// On récupère les heures
	$jour = substr($datedupost,8,2); 		// On récupère le jour
	$mois = substr($datedupost,5,2); 		// Puis le mois
	$annee = substr($datedupost,0,4); 		// Et l'année ...
	$timestamp = mktime($heure,$minute,$seconde,$mois,$jour,$annee);	// On transforme la date en TimeStamp

	// -- DATE ACTUELLE -- 
	$maintenant = time();	// Directement en TimeStamp.

	// -- CALCUL --
	$ecart_secondes = $maintenant - $timestamp; // On calcule le nombre de secondes d'écart entre les deux dates
	$ecart_minutes = floor($ecart_secondes / 60);	// Conversion en minutes
	$ecart_heures = floor($ecart_secondes / (60*60));	// Conversion en heures
	$ecart_jours = floor($ecart_secondes / (60*60*24));	// Conversion en jours
	$ecart_semaines = floor($ecart_secondes / (60*60*24*7)); // Conversion en semaines

	// -- AFFICHAGE --
	if ($ecart_secondes < 60) {
		echo "< 1 minute";
	}
	else if ($ecart_minutes < 60) {
		if ($ecart_minutes < 2) {
			echo "$ecart_minutes minute";
		}
		else {
			echo "$ecart_minutes minutes";
		}
	}
	else if ($ecart_heures < 24) {
		if ($ecart_heures < 2) {
			echo "$ecart_heures heure";
		}
		else {
			echo "$ecart_heures heures";
		}
	}
	else if ($ecart_jours < 7){
		if ($ecart_jours < 2) {
			echo "$ecart_jours jour";
		}
		else {
			echo "$ecart_jours jours";
		}
	}
	else {
		if ($ecart_semaines < 2) {
			echo "$ecart_semaines semaine";
		}
		else {
			echo "$ecart_semaines semaines";
		}
	}
	
} // calculDuree()

?>