<? 
// 	FOOTER.PHP
//	Contient tout le footer commun aux pages.
//	Termine la page.
//	Doit être 'require' à la toute fin de chaque page
//	/!\ Attention aux scripts à ajouter juste avant la fermeture de body (cfr: reply.php)

?>

    <div id="footer">
			<!-- <p class="hp"><span>babble</span></p>-->
			<ul>
				<li class="hp"><span>babble</span> &copy; 2010</li>
				<li><a href="http://www.babble.be" title="Aller sur babble.be">Babble.be</a></li>
				<li><a href="/blog" title="Se rendre sur le blog">Blog</a></li>
				<li><a href="http://www.facebook.com/pages/Babble/463624625602" title="Devenez fan de Babble sur Facebook">Facebook</a></li>
				<li><a href="http://www.twitter.com/babble_be" title="Suivre Babble sur Twitter">Twitter</a></li>
				<li><a href="/about" title="En savoir plus sur babble">À propos</a></li>
				<li><a href="/contact" title="Se rendre sur la page de contact">Contact</a></li>
				<li><a href="/faq" title="Voir les questions les plus fréquemment posées">FAQ</a></li>
				<li><a href="/term" title="Lire les conditions d'Utilisation du site">Conditions d'utilisation</a></li>
				<li class="last"><a href="/privacy" title="Voir les règles sur la vie privée">Vie privée</a></li>
			</ul>
		</div> <!-- /footer -->

</div> <!-- /wrapper -->
<a id="hidden_link" href="welcome.php">welcome</a>
<?
if($YouAreHere == 'reply'){
	echo "<script type=\"text/javascript\">
		//<![CDATA[
	    function yus_replyTo(commentID,author) {
			var inReplyTo='@<a href=\"#comment-'+commentID+'\" class=\"to\">'+author+'</a> : ';
	    	var myField;
	        if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
	    		myField = document.getElementById('comment');
	    	} else {
	    		return false;
	    	}
	    	if (document.selection) {
	    		myField.focus();
	    		sel = document.selection.createRange();
	    		sel.text = inReplyTo;
	    		myField.focus();
	    	}
	    	else if (myField.selectionStart || myField.selectionStart == '0') {
	    		var startPos = myField.selectionStart;
	    		var endPos = myField.selectionEnd;
	    		var cursorPos = endPos;
	    		myField.value = myField.value.substring(0, startPos)
	    					  + inReplyTo
	    					  + myField.value.substring(endPos, myField.value.length);
	    		cursorPos += inReplyTo.length;
	    		myField.focus();
	    		myField.selectionStart = cursorPos;
	    		myField.selectionEnd = cursorPos;
	    	}
	    	else {
	    		myField.value += inReplyTo;
	    		myField.focus();
	    	}
	   	}
		//]]>
	    </script>";
}
?>
</body>
</html>