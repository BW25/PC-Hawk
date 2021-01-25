$(function(){	//When document is ready

	$('.error').hide();	//Hide error messages at start
	$(".formSubmit").click(function(){	//When submit button is clicked
	
	var error = true;
	$('.error').hide();	//Hide old error messages upon re-submit
	$("input").css("margin-bottom", "15px");
	
		var code = $("#code").val();	//Check code for invalid input
		if (code == "" ) {
			$("label#code_empty").show(500);
			$("input#code").css("margin-bottom", "5px");
			$("input#code").focus();
			error = false;
		}
		else if ( !new RegExp("^[A-Za-z0-9]{6}$").test(code) ) {
			$("label#code_invalid").show(500);
			$("input#code").css("margin-bottom", "5px");
			$("input#code").focus();
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

		var first = $("#firstname").val();	//Check email for invalid input
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