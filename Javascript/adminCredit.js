$(function(){	//When document is ready

	$('.error').hide();	//Hide error messages at start

	$("button#adminCreditSubmit").click(function(){	//When signupSubmit button is clicked

	var error = true;
	$('.error').hide();	//Hide old error messages upon re-submit
	$("input").css("margin-bottom", "15px");
	

        var status = $("#status").val();	
		if (status == "") {
			$("label#status_empty").show(500);
			$("input#status").css("margin-bottom", "5px");
			$("input#status").focus();
			error = false;
		}
		else if ( !new RegExp("^[0-9]$").test(status) ) {
			$("label#status_invalid").show(500);
			$("input#status").css("margin-bottom", "5px");
			$("input#status").focus();
			error = false;
		}
	
		var expMonth = $("#expMonth").val();	//Check expMonth for invalid input
		if (expMonth == "") {
			$("label#expMonth_empty").show(500);
			$("input#expMonth").css("margin-bottom", "5px");
			$("input#expMonth").focus();
			error = false;
		}
		else if ( !new RegExp("^[01]?[0-9]$").test(expMonth) ) {
			$("label#expMonth_invalid").show(500);
			$("input#expMonth").css("margin-bottom", "5px");
			$("input#expMonth").focus();
			error = false;
		}

        var date = new Date();
        date = date.getFullYear();
		var expYear = $("#expYear").val();	//Check expYear for invalid input
		if (expYear == "" ) {
			$("label#expYear_empty").show(500);
			$("input#expYear").css("margin-bottom", "5px");
			$("input#expYear").focus();
			error = false;
		}
		else if ( expYear < date || expYear > date+5 ) {
			$("label#expYear_invalid").show(500);
			$("input#expYear").css("margin-bottom", "5px");
			$("input#expYear").focus();
			error = false;
		}

		var cardName = $("#cardName").val();	
		if (cardName == "") {
			$("label#cardName_empty").show(500);
			$("input#cardName").css("margin-bottom", "5px");
			$("input#cardName").focus();
			error = false;
		}
		else if ( !new RegExp("^[A-Za-z' '.]{1,49}$").test(cardName) ) {
			$("label#cardName_invalid").show(500);
			$("input#cardName").css("margin-bottom", "5px");
			$("input#cardName").focus();
			error = false;
		}

        var cardNum = $("#cardNum").val();	
		if (cardNum == "") {
			$("label#cardNum_empty").show(500);
			$("input#cardNum").css("margin-bottom", "5px");
			$("input#cardNum").focus();
			error = false;
		}
		else if ( !new RegExp("^[0-9]{16}$").test(cardNum) ) {
			$("label#cardNum_invalid").show(500);
			$("input#cardNum").css("margin-bottom", "5px");
			$("input#cardNum").focus();
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

	$("button#adminCreditDelete").click(function(){	//When signupSubmit button is clicked

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
