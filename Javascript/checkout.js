$(function(){	//When document is ready

	$('.error').hide();	//Hide error messages at start
	$(".formSubmit").click(function(){	//When submit button is clicked
	
	var error = true;
	$('.error').hide();	//Hide old error messages upon re-submit
	$("input").css("margin-bottom", "15px");
	$("select").css("margin-bottom", "15px");
	
	var cardNum = $("#cardNum").val();
	if (cardNum == "") {
		$("label#cardNum_empty").show(500);
		$("input#cardNum").css("margin-bottom", "5px");
		$("input#cardNum").focus();
		error = false;
	}
	else if ( !new RegExp("^[0-9-\\s]{16}$").test(cardNum) ) {
		$("label#cardNum_invalid").show(500);
		$("input#cardNum").css("margin-bottom", "5px");
		$("input#cardNum").focus();
		error = false;
	}
	
	var cardName = $("#cardName").val();
	if (cardName == "") {
		$("label#cardName_empty").show(500);
		$("input#cardName").css("margin-bottom", "5px");
		$("input#cardName").focus();
		error = false;
	}
	else if ( !new RegExp("^[A-Za-z'.\\s]+$").test(cardName) ) {
		$("label#cardName_invalid").show(500);
		$("input#cardName").css("margin-bottom", "5px");
		$("input#cardName").focus();
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
	
	var postal = $("#postal").val();
	if (postal == "") {
		$("label#postal_empty").show(500);
		$("input#postal").css("margin-bottom", "5px");
		$("input#postal").focus();
		error = false;
	}
	else if ( !new RegExp("^[A-Za-z][0-9][A-Za-z][0-9][A-Za-z][0-9]$").test(postal) ) {
		$("label#postal_invalid").show(500);
		$("input#postal").css("margin-bottom", "5px");
		$("input#postal").focus();
		error = false;
	}
	
	var prov = document.getElementById("province");
	var provSelected = prov.options[prov.selectedIndex].value;
	if (provSelected == "N/A") {
		$("label#province_empty").show(500);
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
	
	var addr1 = $("#address1").val();
	if (addr1 == "") {
		$("label#address1_empty").show(500);
		$("input#address1").css("margin-bottom", "5px");
		$("input#address1").focus();
		error = false;
	}

	var name = $("#fullname").val();
	if (name == "") {
		$("label#fullname_empty").show(500);
		$("input#fullname").css("margin-bottom", "5px");
		$("input#fullname").focus();
		error = false;
	}
	else if ( !new RegExp("^[A-Za-z'.\\s]+$").test(name) ) {
		$("label#fullname_invalid").show(500);
		$("input#fullname").css("margin-bottom", "5px");
		$("input#fullname").focus();
		error = false;
	}

		return error;
		
	});
	
});
