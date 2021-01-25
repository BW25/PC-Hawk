$(function(){	//When document is ready

	$('.error').hide();	//Hide error messages at start


	$("button#adminUserSubmit").click(function(){	//When signupSubmit button is clicked

	var error = true;
	$('.error').hide();	//Hide old error messages upon re-submit
	$("input").css("margin-bottom", "15px");
	

        var account_type = $("#account_type").val();	
		if (account_type == "") {
			$("label#account_type_empty").show(500);
			$("input#account_type").css("margin-bottom", "5px");
			$("input#account_type").focus();
			error = false;
		}
		else if ( !new RegExp("^[0-9]$").test(account_type) ) {
			$("label#account_type_invalid").show(500);
			$("input#account_type").css("margin-bottom", "5px");
			$("input#account_type").focus();
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

        var uid = $("#uid").val();	
		if (uid == "") {
			$("label#uid_empty").show(500);
			$("input#uid").css("margin-bottom", "5px");
			$("input#uid").focus();
			error = false;
		}
		else if ( !new RegExp("^[0-9]{1,11}$").test(uid) ) {
			$("label#uid_invalid").show(500);
			$("input#uid").css("margin-bottom", "5px");
			$("input#uid").focus();
			error = false;
		}

		return error;
		
	});

	$("button#adminUserDelete").click(function(){	//When signupSubmit button is clicked

	var error = true;
	$('.error').hide();	//Hide old error messages upon re-submit
	$("input").css("margin-bottom", "15px");

        var uid = $("#uid").val();	
		if (uid == "") {
			$("label#uid_empty").show(500);
			$("input#uid").css("margin-bottom", "5px");
			$("input#uid").focus();
			error = false;
		}
		else if ( !new RegExp("^[0-9]{1,11}$").test(uid) ) {
			$("label#uid_invalid").show(500);
			$("input#uid").css("margin-bottom", "5px");
			$("input#uid").focus();
			error = false;
		}
		
		return error;
		
	});
	
});
