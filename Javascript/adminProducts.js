$(function(){	//When document is ready

	$('.error').hide();	//Hide error messages at start


	$("button#adminProductsSubmit").click(function(){	//When signupSubmit button is clicked

	var error = true;
	$('.error').hide();	//Hide old error messages upon re-submit
	$("input").css("margin-bottom", "15px");
	
        var ProductName = $("#ProductName").val();	
		if (ProductName == "") {
			$("label#ProductName_empty").show(500);
			$("input#ProductName").css("margin-bottom", "5px");
			$("input#ProductName").focus();
			error = false;
		}
		else if ( !new RegExp("^[0-9a-zA-Z()' '.-]{1,200}$").test(ProductName) ) {
			$("label#ProductName_invalid").show(500);
			$("input#ProductName").css("margin-bottom", "5px");
			$("input#ProductName").focus();
			error = false;
		}

        var Stock = $("#Stock").val();	
		if (Stock == "") {
			$("label#Stock_empty").show(500);
			$("input#Stock").css("margin-bottom", "5px");
			$("input#Stock").focus();
			error = false;
		}
		else if ( !new RegExp("^[0-9]{1,11}$").test(Stock) ) {
			$("label#Stock_invalid").show(500);
			$("input#Stock").css("margin-bottom", "5px");
			$("input#Stock").focus();
			error = false;
		}

        var Cost = $("#Cost").val();	
		if (Cost == "") {
			$("label#Cost_empty").show(500);
			$("input#Cost").css("margin-bottom", "5px");
			$("input#Cost").focus();
			error = false;
		}
		else if ( !new RegExp("^[0-9]{1,6}[.][0-9]{1,2}$").test(Cost) ) {
			$("label#Cost_invalid").show(500);
			$("input#Cost").css("margin-bottom", "5px");
			$("input#Cost").focus();
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

	$("button#adminProductsDelete").click(function(){	//When signupSubmit button is clicked

	var error = true;
	$('.error').hide();	//Hide old error messages upon re-submit
	$("input").css("margin-bottom", "15px");
	

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
