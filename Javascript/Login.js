$(function(){	//When document is ready

	$('.error').hide();	//Hide error messages at start

    
	$("button#loginSubmit").click(function(){	//When loginSubmit button is clicked
	
	var error = true;
	$('.error').hide();	//Hide old error messages upon re-submit
	$("input").css("margin-bottom", "15px");
	
		
		var pass = $("#pass").val();	//Check email for invalid input
		if (pass == "") {
			$("label#pass_empty").show(500);
			$("input#pass").css("margin-bottom", "5px");
			$("input#pass").focus();
			error = false;
		}
		else if ( !new RegExp("^[A-Za-z].{7,15}$").test(pass) 
				|| !new RegExp("[0-9]").test(pass)
				|| !new RegExp("[!*]").test(pass) ){
			$("label#pass_invalid").show(500);
			$("input#pass").css("margin-bottom", "5px");
			$("input#pass").focus();
			error = false;
		}
	
		var mail = $("#email").val();	//Check email for invalid input
		if (mail == "") {
			$("label#email_empty").show(500);
			$("input#email").css("margin-bottom", "5px");
			$("input#email").focus();
			error = false;
		}
		else if ( !new RegExp("^.+@.+\.[a-z]{2,3}$").test(mail) ) {
			$("label#email_invalid").show(500);
			$("input#email").css("margin-bottom", "5px");
			$("input#email").focus();
			error = false;
		}

		return error;
		
	});

	
});
