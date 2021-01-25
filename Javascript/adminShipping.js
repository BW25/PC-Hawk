$(function(){	//When document is ready

	$('.error').hide();	//Hide error messages at start

	$("button#adminShippingSubmit").click(function(){	//When submit button is clicked
	
	    var error = true;
	    $('.error').hide();	//Hide old error messages upon re-submit
	    $("input").css("margin-bottom", "15px");
	    $("select").css("margin-bottom", "15px");
	    
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
	    
	    var phone = $("#phone").val();
	    if (phone == "") {
		    $("label#phone_empty").show(500);
		    $("input#phone").css("margin-bottom", "5px");
		    $("input#phone").focus();
		    error = false;
	    }
	    else if ( !new RegExp("^[0-9]{3}[-\\s]?[0-9]{3}[-\\s]?[0-9]{4}$").test(phone) ) {
		    $("label#phone_invalid").show(500);
		    $("input#phone").css("margin-bottom", "5px");
		    $("input#phone").focus();
		    error = false;
	    }
	    
	    var postal_code = $("#postal_code").val();
	    if (postal_code == "") {
		    $("label#postal_code_empty").show(500);
		    $("input#postal_code").css("margin-bottom", "5px");
		    $("input#postal_code").focus();
		    error = false;
	    }
	    else if ( !new RegExp("^[A-Za-z][0-9][A-Za-z][0-9][A-Za-z][0-9]$").test(postal_code) ) {
		    $("label#postal_code_invalid").show(500);
		    $("input#postal_code").css("margin-bottom", "5px");
		    $("input#postal_code").focus();
		    error = false;
	    }
	    
	    var prov = document.getElementById("province");
	    var provSelected = prov.options[prov.selectedIndex].value;
	    if (provSelected == "N/A") {
		    $("label#province_empty").show(500);
		    prov.style.marginBottom = "5px";
		    error = false;
	    }
	    else if ( !new RegExp("^ON|QC|BC|AB|MB|SK|NS|NB|NL|PE|NT|NU|YT$").test(provSelected) ) {
		    $("label#province_invalid").show(500);
		    prov.style.marginBottom = "5px";
		    error = false;
	    }
	    
	    var city = $("#city").val();
	    if (city == "") {
		    $("label#city_empty").show(500);
		    $("input#city").css("margin-bottom", "5px");
		    $("input#city").focus();
		    error = false;
	    }
	    else if ( !new RegExp("^[0-9a-zA-Z'., -]{1,20}$").test(city) ) {
		    $("label#city_invalid").show(500);
		    $("input#city").css("margin-bottom", "5px");
		    $("input#city").focus();
		    error = false;
	    }
	    
	    var addr1 = $("#addr1").val();
	    if (addr1 == "") {
		    $("label#addr1_empty").show(500);
		    $("input#addr1").css("margin-bottom", "5px");
		    $("input#addr1").focus();
		    error = false;
	    }
	    else if ( !new RegExp("^[0-9a-zA-Z'., -]{1,50}$").test(addr1) ) {
		    $("label#addr1_invalid").show(500);
		    $("input#addr1").css("margin-bottom", "5px");
		    $("input#addr1").focus();
		    error = false;
	    }

	    var addr2 = $("#addr2").val();
	    if (addr2 == "") {
		    $("label#addr2_empty").show(500);
		    $("input#addr2").css("margin-bottom", "5px");
		    $("input#addr2").focus();
		    error = false;
	    }
	    else if ( !new RegExp("^[0-9a-zA-Z'., -]{1,50}$").test(addr2) ) {
		    $("label#addr2_invalid").show(500);
		    $("input#addr2").css("margin-bottom", "5px");
		    $("input#addr2").focus();
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

	$("button#adminShippingDelete").click(function(){	//When signupSubmit button is clicked

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
