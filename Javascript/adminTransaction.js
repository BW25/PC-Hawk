$(function(){	//When document is ready

	$('.error').hide();	//Hide error messages at start


	$("button#adminTransactionSubmit").click(function(){	//When signupSubmit button is clicked

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

        var time = $("#time").val();	
		if (time == "") {
			$("label#time_empty").show(500);
			$("input#time").css("margin-bottom", "5px");
			$("input#time").focus();
			error = false;
		}
		else if ( !new RegExp("^[2-9][0-9]{3}-([0][1-9]|[1][0-2])-([0][1-9]|[1-2][0-9]|[3][0-1])$").test(time) ) {
			$("label#time_invalid").show(500);
			$("input#time").css("margin-bottom", "5px");
			$("input#time").focus();
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


		return error;
		
	});

	$("button#adminTransactionDelete").click(function(){	//When signupSubmit button is clicked

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
		
		return error;
		
	});
	
});
