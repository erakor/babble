$(document).ready(function(){
	
	$('#login_form').submit(function(e){
		e.preventDefault();
		//alert($('#email').val());
		
		$.ajax({
			type: "POST",
			cache: false,
			data: "email=" + $('#email').val(),
			url: "http://localhost/~amaury/babble/JSSendLogin.php",
			success: function(feedback){
					$('.warning').html(feedback);
			} // success
		}); // $.ajax
	}); //submit

}); // ready