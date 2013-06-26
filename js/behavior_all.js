/*************************************************/
/*************************************************/
/* Behavior javascript commun a toutes les pages */
/*************************************************/
/*************************************************/

$(document).ready(function(){

	//Empêche IE de storer les données dans la cache.
	$.ajaxSetup({
		cache: false
	});
	
	
	/**************HOVER**************/
	// ajoute un hover effect posts
	$('div.post').hover(function() {
		$(this).addClass('post-hover');
	},function() {
		$(this).removeClass('post-hover');
	});
	// hover au-dessus des bells
	$('.score span.bell').hover(function(){
		$(this).addClass('bell_off');
	},function() {
		$(this).removeClass('bell_off');
	});
	// ajoute un hover effect sur le lien "acceder onglets"
	$('#forum #live_box').hover(function() {
		$('#forum #live_box a').addClass('sl');
	},function() {
		$('a.moveOn').removeClass('sl');
	});
	// ajoute un hover effect sur acceder onglets
	$("#reply #live_box").hover(function() {
		$('a.moveOn').addClass('sl');
	},function() {
		$('a.moveOn').removeClass('sl');
	});
	// ajoute un hover effect sur acceder onglets
	$("#live #forum_box").hover(function() {
		$('a.moveOn').addClass('sl');
	},function() {
		$('a.moveOn').removeClass('sl');
	});


	/***************LE NOM*********************/
	//$("form.name").jqTransform();
	
	// toggle le name panel qd clique sur (changer)
	$("p#name_picking a").livequery('click', function(){
		$("#name_panel").slideToggle("slow");
		return false;
	});
	
	// process le nom. toggle le panel, cookie...
	$("#select_name").livequery('click', function(event){
		event.preventDefault();
		var radiobutton = $('[name=group1]:checked').val();
		if(radiobutton == 'personal')
			radiobutton = $('#choisir_nom').val();
		// sanitize result
		if(radiobutton.length == 0)
			$("<span>Vous devez choisir un nom.</span>").appendTo("p.warning").fadeOut(5000);
		else if(radiobutton.length > 35)
			$("<span>Votre nom est trop long.</span>").appendTo("p.warning").fadeOut(5000);
		else{
			// ajoute/change le cookie
			$.cookie('username', radiobutton, { expires: 5, path: '/'});
			$('p#name_picking span').html(radiobutton);
			$("#name_panel").slideToggle("slow");
		}
		return false;
	});
	
	// refresh la liste des noms proposés
	$('a.refresh-name').livequery('click', function(event){
		event.preventDefault();
		$.ajax({
			type: "GET",
			url: "http://localhost/~amaury/babble/JSNewNameList.php",
			success: function(reply){
				$('#name_panel').html(reply);
				//$("form.name").jqTransform();
			}
		}); // $.ajax
		return false;
	});
	
	//autoresizable textarea
	$('textarea#posting_area_forum').autoResize({

	    // Quite slow animation:
	    animateDuration : 300,
	    // More extra space:
	    extraSpace : 40
	})

	
	/***************NAVIGATION*********************/
	anchor.init()
	anchorTop.init()
	
	$("#hidden_link").colorbox({iframe:true, innerWidth:740, innerHeight:270}).trigger('click'); // Launch the Welcome page when the website is loaded

}); // ready



// effect 'répondre' dans les replies.
anchor = {
	init : function() {
		$("#reply div.post a.to").click(function () {
			elementClick = $(this).attr("href");
			destination = $(elementClick).offset().top;
			$("html:not(:animated),body:not(:animated)").animate({ scrollTop: destination}, 1100);
			$(""+elementClick+"").addClass('new');
			return false;
		})
	}
}

// 'Haut de la page'
anchorTop = {
	init : function() {
		$("a.goTop").click(function () {
			elementClick = $(this).attr("href");
			destination = $(elementClick).offset().top;
			$("html:not(:animated),body:not(:animated)").animate({ scrollTop: destination}, 300);
			return false;
		})
	}
}
