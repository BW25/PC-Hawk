$(function(){	//When document is ready

	$('.error').hide();	//Hide error messages at start


	$("button#signupSubmit").click(function(){	//When signupSubmit button is clicked

	var error = true;
	$('.error').hide();	//Hide old error messages upon re-submit
	$("input").css("margin-bottom", "15px");
	
		
		var newPass = $("#newPass").val();	
		if (newPass == "") {
			$("label#newPass_empty").show(500);
			$("input#newPass").css("margin-bottom", "5px");
			$("input#newPass").focus();
			error = false;
		}
		else if ( !new RegExp("^[A-Za-z].{7,15}$").test(newPass) 
				|| !new RegExp("[0-9]").test(newPass)
				|| !new RegExp("[!*]").test(newPass) ){
			$("label#newPass_invalid").show(500);
			$("input#newPass").css("margin-bottom", "5px");
			$("input#newPass").focus();
			error = false;
		}
	
		var mail = $("#newEmail").val();	//Check email for invalid input
		if (mail == "") {
			$("label#newEmail_empty").show(500);
			$("input#newEmail").css("margin-bottom", "5px");
			$("input#newEmail").focus();
			error = false;
		}
		else if ( !new RegExp("^.+@.+\.[a-z]{2,3}$").test(mail) ) {
			$("label#newEmail_invalid").show(500);
			$("input#newEmail").css("margin-bottom", "5px");
			$("input#newEmail").focus();
			error = false;
		}
		
		var last = $("#lastname").val();	//Check lastname for invalid input
		if (last == "" ) {
			$("label#lastname_empty").show(500);
			$("input#lastname").css("margin-bottom", "5px");
			$("input#lastname").focus();
			error = false;
		}
		else if ( !new RegExp("^[A-Za-z'.]+$").test(last) ) {
			$("label#lastname_invalid").show(500);
			$("input#lastname").css("margin-bottom", "5px");
			$("input#lastname").focus();
			error = false;
		}

		var first = $("#firstname").val();	
		if (first == "") {
			$("label#firstname_empty").show(500);
			$("input#firstname").css("margin-bottom", "5px");
			$("input#firstname").focus();
			error = false;
		}
		else if ( !new RegExp("^[A-Za-z'.]+$").test(first) ) {
			$("label#firstname_invalid").show(500);
			$("input#firstname").css("margin-bottom", "5px");
			$("input#firstname").focus();
			error = false;
		}
		
		

		return error;
		
	});
	
});
