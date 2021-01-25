window.onload = init();

function banner (receivedObject)
{
	var bannerTop = document.createElement('div');
	bannerTop.className = 'banner';

	
	var logoLink = document.createElement('a');
	logoLink.className = "logoLink";
	logoLink.href = "/PC_Hawk/home.html";
	bannerTop.appendChild(logoLink);
	
	var logo = document.createElement('img');
	logo.src = "/PC_Hawk/Images/logo.png";
	logo.className = "bannerLogo";
	logoLink.appendChild(logo);
	
	var searchContainer = document.createElement("div");
	searchContainer.className = "searchContainer";
	bannerTop.appendChild(searchContainer);
	
	var searchForm = document.createElement("form");
	searchForm.className = "bannerForm";
	searchContainer.appendChild(searchForm);
	
	var search = document.createElement("input");
	search.type = "text";
	search.placeholder = "Search...";
	search.className = "bannerSearch";
	searchForm.appendChild(search);
	
	var searchButton = document.createElement("button");
	searchButton.type = "submit";
	searchButton.innerHTML = "&#x1F50D";
	searchButton.className = "bannerButton";
	searchForm.appendChild(searchButton);
	

    if (receivedObject.uid == null)
    {
	    var login = document.createElement("a");
	    login.innerHTML = "Login / Signup";
	    login.href = "/PC_Hawk/Login.php";
	    login.className = "bannerText"
	    bannerTop.appendChild(login);
    }
	else
    {
        var logout = document.createElement("a");
	    logout.innerHTML = "Logout";
	    logout.href = "/PC_Hawk/Logout.php";
	    logout.className = "bannerText"
	    bannerTop.appendChild(logout);
    }
	
	
	var banner = document.createElement('div');
	banner.className = 'banner';
	
	var laptops = document.createElement("a");
	laptops.innerHTML = "Laptops";
	laptops.href = "/PC_Hawk/Laptops.html";
	laptops.className = "bannerText"
	banner.appendChild(laptops);

	var accessories = document.createElement("a");
	accessories.innerHTML = "Accessories";
	accessories.href = "/PC_Hawk/acs.html";
	accessories.className = "bannerText"
	banner.appendChild(accessories);
	
	var info = document.createElement("a");
	info.innerHTML = "Info Page";
	info.href = "/PC_Hawk/information.html";
	info.className = "bannerText"
	banner.appendChild(info);
	
	var about = document.createElement("a");
	about.innerHTML = "About Us";
	about.href = "/PC_Hawk/about us.html";
	about.className = "bannerText"
	banner.appendChild(about);

    //Only users have the option of going to the cart
    if (receivedObject.account_type == 1)
    {
        var cart = document.createElement("a");
	    cart.innerHTML = "Cart";
	    cart.href = "/PC_Hawk/cart.php";
	    cart.className = "bannerText"
	    banner.appendChild(cart);
    }



	document.body.insertBefore(banner, document.body.firstChild);
	document.body.insertBefore(bannerTop, document.body.firstChild);

    getSession();
	
}

function init()
{
    var ajax = new XMLHttpRequest();
    
    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {       
            var response = this.responseText;
            var receivedObject = JSON.parse(response);
            
            if (receivedObject.account_type == 0)
            {
                var bannerAdminTop = document.createElement('div');
	            bannerAdminTop.className = 'banner';
	            
	            var empty1 = document.createElement("a");
	            empty1.innerHTML = "";
	            empty1.className = "bannerText"
	            bannerAdminTop.appendChild(empty1);

	            var credit = document.createElement("a");
	            credit.innerHTML = "Credit";
	            credit.href = "/PC_Hawk/admin/adminCredit.php";
	            credit.className = "bannerText"
	            bannerAdminTop.appendChild(credit);

	            var shipping = document.createElement("a");
	            shipping.innerHTML = "Shipping";
	            shipping.href = "/PC_Hawk/admin/adminShipping.php";
	            shipping.className = "bannerText"
	            bannerAdminTop.appendChild(shipping);

	            var users = document.createElement("a");
	            users.innerHTML = "Users";
	            users.href = "/PC_Hawk/admin/adminUsers.php";
	            users.className = "bannerText"
	            bannerAdminTop.appendChild(users);


                var bannerAdminBottom = document.createElement('div');
	            bannerAdminBottom.className = 'banner';
	            
	            var empty1 = document.createElement("a");
	            empty1.innerHTML = "";
	            empty1.className = "bannerText"
	            bannerAdminBottom.appendChild(empty1);

	            var transaction = document.createElement("a");
	            transaction.innerHTML = "Transaction";
	            transaction.href = "/PC_Hawk/admin/adminTransaction.php";
	            transaction.className = "bannerText"
	            bannerAdminBottom.appendChild(transaction);

	            var products = document.createElement("a");
	            products.innerHTML = "Products";
	            products.href = "/PC_Hawk/admin/adminProducts.php";
	            products.className = "bannerText"
	            bannerAdminBottom.appendChild(products);

	            var purchase = document.createElement("a");
	            purchase.innerHTML = "Purchases";
	            purchase.href = "/PC_Hawk/admin/adminPurchase.php";
	            purchase.className = "bannerText"
	            bannerAdminBottom.appendChild(purchase);


	            document.body.insertBefore(bannerAdminBottom, document.body.firstChild);
	            document.body.insertBefore(bannerAdminTop, document.body.firstChild);

                banner(receivedObject);
	            
            }
            else if (receivedObject.account_type == 1)
            {
                var bannerUser = document.createElement('div');
	            bannerUser.className = 'banner';
	            
	            var account = document.createElement("a");
	            account.innerHTML = "My Account";
	            account.href = "/PC_Hawk/userAccount.php";
	            account.className = "bannerText"
	            bannerUser.appendChild(account);                

	            var credit = document.createElement("a");
	            credit.innerHTML = "Credit Card";
	            credit.href = "/PC_Hawk/userCredit.php";
	            credit.className = "bannerText"
	            bannerUser.appendChild(credit);

	            var shipping = document.createElement("a");
	            shipping.innerHTML = "Shipping";
	            shipping.href = "/PC_Hawk/updateshipping.php";
	            shipping.className = "bannerText"
	            bannerUser.appendChild(shipping);

	            var empty1 = document.createElement("a");
	            empty1.innerHTML = "";
	            empty1.className = "bannerText"
	            bannerUser.appendChild(empty1);

	            var buy = document.createElement("a");
	            buy.innerHTML = "Buy now!";
	            buy.href = "/PC_Hawk/view_products.php";
	            buy.className = "bannerText"
	            bannerUser.appendChild(buy);


	            document.body.insertBefore(bannerUser, document.body.firstChild);
                banner(receivedObject);
            }
            else
            {
                banner(receivedObject);
            }

        }

    };

    ajax.open("GET","/PC_Hawk/getSession.php",true);
    ajax.send();

}

