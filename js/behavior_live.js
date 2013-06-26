/*******************************/
/*******************************/
/* Behavior javascript du live */
/*******************************/
/*******************************/

$(document).ready(function(){


	/**************FUNCTIONS INDISPENSABLES AU LIVE**************/
	// Affiche les 15 posts suivants.
	$('a.plusDePosts').click(function(e){
		e.preventDefault();
		var lastPostOnPageId = $('#live div.post:last').attr('id');
		var dbName = $('#header').attr('dbName'); // le nom de la db du network
		$.ajax({
			type: "GET",
			cache: false,
			url: "http://localhost/~amaury/babble/JSGetOldPosts.php",
			data: "lastPostOnPageId=" + lastPostOnPageId + "&dbName=" + dbName,
			success: function(list){
				//only if there are posts to display
				if(list != "<p class='avertissement'>Personne n'a encore posté de message.</p>"){
					//affiche les vieux posts en bas de la liste.
					$(""+list+"").insertAfter($('#live div.post:last'));
				}//if
			} // success
		}); // $.ajax
	});
	
	// affiche les nouveaux posts
	function display_live_posts1(){
		var lastPostId = $('#live div.post:first').attr('id');
		var dbName = $('#header').attr('dbName'); // le nom de la db du network
		$.ajax({
			type: "GET",
			cache: false,
			url: "http://localhost/~amaury/babble/JSGetPosts.php",
			data: "lastPostId=" + lastPostId + "&dbName=" + dbName,
			success: function(list){
				//only if there are new posts to display
				if(list != "no updates"){
					//affiche le(s) nouveau(x) post(s) en haut de la liste.
					$(""+list+"").insertBefore($('#live div.post:first')).addClass('new');
					window.setTimeout(removeNewEffect, 4000);
				}//if
			} // success
		}); // $.ajax

	}// display_live_posts1()

	//enlève l'effet .new après 4 secondes dans le live
	function removeNewEffect(){
		$('.new').removeClass('new');
	}
	
	//update les 'il y a' dans le live
	function changeTime(){
		$('#live div.post div.post_info span.timechange').each(function(){
			var monId = $(this).parent().parent().attr('id');
			var dbName = $('#header').attr('dbName'); // le nom de la db du network
			$.ajax({
				type: "GET",
				cache: false,
				data: "idPost=" + monId + "&dbName=" + dbName,
				url: "http://localhost/~amaury/babble/JSUpdateTime.php",
				success: function(time){
						$('#'+monId+' span.timechange').html(time);
				} // success
			}); // $.ajax
		}); //each
	}
	
	// Timer -- Appelle display_live_posts1 toutes les dix secs.
	var live_timer = window.setInterval(display_live_posts1, 10000);
	// update les 'il y a...' toutes les 30 secondes.
	var change_time_timer = window.setInterval(changeTime, 30000);


	/**************POSTING IN LIVE**************/
	// Fonction qui s'occupe du countdown.
	function limitChars(textid, limit, infodiv){
		var text = $('#'+textid).val();
		var textlength = text.length;
		if(textlength > limit){
			$('#' + infodiv).html('Trop long!');
			$('#'+textid).val(text.substr(0,limit));
			return false;
		}
		else{
			$('#' + infodiv).html(''+ (limit - textlength) +'');
			return true;
		}
	}

	// textarea countdown
	$("#countdown").html('150');
	$('#posting_area').keyup(function(e){
		e.preventDefault();
		limitChars('posting_area', 150, 'countdown');
	});

	// posting
	$('form#posting_form').submit(function(e){
		e.preventDefault();
		var dbName = $('#header').attr('dbName'); // le nom de la db du network
		//Check si un author est sélectionné
		if($.cookie('username') == null){
			$("<span>Vous devez choisir un nom.</span>").appendTo("p.warning").fadeOut(2000);
		}
		else{
			//store le post dans la db
			$.ajax({
				type: "POST",
				url: "http://localhost/~amaury/babble/JSInsertPost.php",
				data: "name=" + $.cookie('username') + "&post=" + $("#posting_area").val() + "&dbName=" + dbName,
				beforeSend: function(){
					$("#posting_form input.button").hide();
					$("div.loading_live").show();
				},
				success: function(reply){
					if (reply == "Message posté"){
						$("#posting_form")[0].reset(); //Reset la form
						$("#countdown").html('150'); //Reset le countdown
						$("<span style=\"color:green;\">"+reply+"</span>").appendTo("p.warning").fadeOut(2000);
						display_live_posts1(); // Affiche le(s) nouveau post directement
					}
					else{
						$("<span>"+reply+"</span>").appendTo("p.warning").fadeOut(5000);
					}
					$("#posting_form input.button").show(); //ré-affiche le posting button
					$("div.loading_live").hide();
				} // success
			}); // $.ajax
		} // else
		return false;
	});   // submit
	
	
	/**************SCORE IN LIVE**************/
	// thumbs up
	$("#live div.post div.post_message div.score span.thumbs_up").livequery('click', function(event){
		event.preventDefault();
		//récupère l'id du post
		var monId = $(this).parent().parent().parent().attr("id");
		//envoit un cookie avec l'id du post
		$.cookie(monId + 'thumbs_live', 'thumbs', { expires: 5, path: '/'});
		//store le nombre du thumbs_down
		var downNum = $('#live #' + monId + ' .score span.thumbs_down').html();
		 // le nom de la db du network
		var dbName = $('#header').attr('dbName');
		$.ajax({
			type: "POST",
			url: "http://localhost/~amaury/babble/score/score.php",
			data: "id=" + monId + "&which=up&dbName=" + dbName,
			success: function(reply){
				$("<span class='thumbs_up_off' title='Vous avez déjà voté'>"+reply+"</span>").insertAfter($('#live #' + monId + ' .score span.thumbs_up'));
				$('#live #' + monId + ' .score span.thumbs_up').hide();
				$("<span class='thumbs_down_off' title='Vous avez déjà voté'>"+downNum+"</span>").insertAfter($('#live #' + monId + ' .score span.thumbs_down'));
				$('#live #' + monId + ' .score span.thumbs_down').hide();
			}
		}); // $.ajax
		return false; //stop la propagation d'events
	});
	
	// thumbs down
	$("#live div.post div.post_message div.score span.thumbs_down").livequery('click', function(event){
		event.preventDefault();
		var monId = $(this).parent().parent().parent().attr("id");
		$.cookie(monId + 'thumbs_live', 'thumbs', { expires: 5, path: '/'});
		var upNum = $('#live #' + monId + ' .score span.thumbs_up').html();
		var dbName = $('#header').attr('dbName');
		$.ajax({
			type: "POST",
			url: "http://localhost/~amaury/babble/score/score.php",
			data: "id=" + monId + "&which=down&dbName=" + dbName,
			success: function(reply){
				$("<span class='thumbs_down_off' title='Vous avez déjà voté.'>"+reply+"</span>").insertAfter($('#live #' + monId + ' .score span.thumbs_down'));
				$('#live #' + monId + ' .score span.thumbs_down').hide();
				$("<span class='thumbs_up_off' title='Vous avez déjà voté.'>"+upNum+"</span>").insertAfter($('#live #' + monId + ' .score span.thumbs_up'));
				$('#live #' + monId + ' .score span.thumbs_up').hide();
			}
		}); // $.ajax
		return false;
	});

	// trash
	$("#live div.post div.post_message div.score span.bell").livequery('click', function(event){
		event.preventDefault();
		var monId = $(this).parent().parent().parent().attr("id");
		$.cookie(monId + 'trash_live', 'trash', { expires: 5, path: '/'});
		var dbName = $('#header').attr('dbName');
		$.ajax({
			type: "POST",
			url: "http://localhost/~amaury/babble/score/score.php",
			data: "id=" + monId + "&which=trash&dbName=" + dbName,
			success: function(reply){
				$("<span class='bell_off' title='Ce message se trouve maintenant sur notre blacklist.'></span>").insertAfter($('#live #' + monId + ' .score span.bell'));
				$('#live #' + monId + ' .score span.bell').hide();
			}
		}); // $.ajax
		return false;
	});
	
}); // ready