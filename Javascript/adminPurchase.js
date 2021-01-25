$(function(){	//When document is ready

	$('.error').hide();	//Hide error messages at start


	$("button#adminPurchaseSubmit").click(function(){	//When signupSubmit button is clicked

	var error = true;
	$('.error').hide();	//Hide old error messages upon re-submit
	$("input").css("margin-bottom", "15px");
	

        var numItems = $("#numItems").val();	
		if (numItems == "") {
			$("label#numItems_empty").show(500);
			$("input#numItems").css("margin-bottom", "5px");
			$("input#numItems").focus();
			error = false;
		}
		else if ( !new RegExp("^[0-9]{1,3}$").test(numItems) ) {
			$("label#numItems_invalid").show(500);
			$("input#numItems").css("margin-bottom", "5px");
			$("input#numItems").focus();
			error = false;
		}

        var TransactionID = $("#TransactionID").val();	
		if (TransactionID == "") {
			$("label#TransactionID_empty").show(500);
			$("input#TransactionID").css("margin-bottom", "5px");
			$("input#TransactionID").focus();
			error = false;
		}
		else if ( !new RegExp("^[0-9]{1,10}$").test(TransactionID) ) {
			$("label#TransactionID_invalid").show(500);
			$("input#TransactionID").css("margin-bottom", "5px");
			$("input#TransactionID").focus();
			error = false;
		}

		var ProductID = $("#ProductID").val();	
		if (ProductID == "") {
			$("label#ProductID_empty").show(500);
			$("input#uid").css("margin-bottom", "5px");
			$("input#uid").focus();
			error = false;
		}
		else if ( !new RegExp("^[a-zA-Z0-9]{1,10}$").test(ProductID) ) {
			$("label#ProductID_invalid").show(500);
			$("input#ProductID").css("margin-bottom", "5px");
			$("input#ProductID").focus();
			error = false;
		}


		return error;
		
	});

	$("button#adminPurchaseDelete").click(function(){	//When signupSubmit button is clicked

	var error = true;
	$('.error').hide();	//Hide old error messages upon re-submit
	$("input").css("margin-bottom", "15px");
	

        var TransactionID = $("#TransactionID").val();	
		if (TransactionID == "") {
			$("label#TransactionID_empty").show(500);
			$("input#TransactionID").css("margin-bottom", "5px");
			$("input#TransactionID").focus();
			error = false;
		}
		else if ( !new RegExp("^[0-9]{1,10}$").test(TransactionID) ) {
			$("label#TransactionID_invalid").show(500);
			$("input#TransactionID").css("margin-bottom", "5px");
			$("input#TransactionID").focus();
			error = false;
		}

		var ProductID = $("#ProductID").val();	
		if (ProductID == "") {
			$("label#ProductID_empty").show(500);
			$("input#uid").css("margin-bottom", "5px");
			$("input#uid").focus();
			error = false;
		}
		else if ( !new RegExp("^[a-zA-Z0-9]{1,10}$").test(ProductID) ) {
			$("label#ProductID_invalid").show(500);
			$("input#ProductID").css("margin-bottom", "5px");
			$("input#ProductID").focus();
			error = false;
		}
		
		return error;
		
	});
	
});
