/***************************************************/
/***************************************************/
/* Behavior javascript commun au forum et au reply */
/***************************************************/
/***************************************************/

$(document).ready(function(){
	
	
	/**************ONGLET LIVE OFF*******************/
	// affiche les nouveaux posts
	function update_onglet_live_off(){
		var lastPostId2 = $('div.sneakpeek_live:first').attr('id');
		var dbName = $('#header').attr('dbName');
		$.ajax({
			type: "GET",
			cache: false,
			url: "http://localhost/~amaury/babble/JSGetPostsOngletLiveOff.php",
			data: "lastPostId=" + lastPostId2 + "&dbName=" + dbName,
			success: function(list2){
				//only if there are new posts to display
				if(list2 != "no updates")
					//affiche une nouvelle liste de posts dans l'onglet.
					$('#sneakpeek_list_live').html(list2);
			} // success
		}); // $.ajax
	}// update_onglet_live_off()
	
	// update l'onglet live OFF toutes les 20 secondes
	var onglet_live_off_timer = window.setInterval(update_onglet_live_off, 20000);
	
	

		/**************SCORE IN REPLY**************/
		// thumbs up
		$("#reply div.post div.score span.thumbs_up").click(function(event){
			event.preventDefault();
			var monId = $(this).parent().parent().parent().attr("pureId");
			$.cookie(monId + 'thumbs_reply', 'thumbs', { expires: 5, path: '/'});
			var downNum = $('#reply #comment-' + monId + ' .score span.thumbs_down').html();
			var dbName = $('#header').attr('dbName');
			$.ajax({
				type: "POST",
				url: "http://localhost/~amaury/babble/score/score_reply.php",
				data: "idDuPost=" + monId + "&which=up&dbName=" + dbName,
				success: function(reply){
					$("<span class='thumbs_up_off' title='Vous avez déjà voté.'>"+reply+"</span>").insertAfter($('#reply #comment-' + monId + ' .score span.thumbs_up'));
					$('#reply #comment-' + monId + ' .score span.thumbs_up').hide();
					$("<span class='thumbs_down_off' title='Vous avez déjà voté.'>"+downNum+"</span>").insertAfter($('#reply #comment-' + monId + ' .score span.thumbs_down'));
					$('#reply #comment-' + monId + ' .score span.thumbs_down').hide();
				}
			}); // $.ajax
			return false;
		});

		// thumbs down
		$("#reply div.post div.score span.thumbs_down").click(function(event){
			event.preventDefault();
			var monId = $(this).parent().parent().parent().attr("pureId");
			$.cookie(monId + 'thumbs_reply', 'thumbs', { expires: 5, path: '/'});
			var upNum = $('#reply #comment-' + monId + ' .score span.thumbs_up').html();
			var dbName = $('#header').attr('dbName');
			$.ajax({
				type: "POST",
				url: "http://localhost/~amaury/babble/score/score_reply.php",
				data: "idDuPost=" + monId + "&which=down&dbName=" + dbName,
				success: function(reply){
					$("<span class='thumbs_down_off' title='Vous avez déjà voté.'>"+reply+"</span>").insertAfter($('#reply #comment-' + monId + ' .score span.thumbs_down'));
					$('#reply #comment-' + monId + ' .score span.thumbs_down').hide();
					$("<span class='thumbs_up_off' title='Vous avez déjà voté.'>"+upNum+"</span>").insertAfter($('#reply #comment-' + monId + ' .score span.thumbs_up'));
					$('#reply #comment-' + monId + ' .score span.thumbs_up').hide();
				}
			}); // $.ajax
			return false;
		});

		// trash
		$("#reply div.post div.score span.bell").click(function(event){
			event.preventDefault();
			var monId = $(this).parent().parent().parent().attr("pureId");
			$.cookie(monId + 'trash_reply', 'trash', { expires: 5, path: '/'});
			var dbName = $('#header').attr('dbName');
			$.ajax({
				type: "POST",
				url: "http://localhost/~amaury/babble/score/score_reply.php",
				data: "idDuPost=" + monId + "&which=trash&dbName=" + dbName,
				success: function(reply){
					$("<span class='bell_off' title='Ce message se trouve maintenant sur notre blacklist.'></span>").insertAfter($('#reply #comment-' + monId + ' .score span.bell'));
					$('#reply #comment-' + monId + ' .score span.bell').hide();
				}
			}); // $.ajax
			return false;
		});

}); // ready