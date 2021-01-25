window.onload = banner();

function banner ()
{
	var bannerTop = document.createElement('div');
	bannerTop.className = 'banner';

	
	var logoLink = document.createElement('a');
	logoLink.className = "logoLink";
	logoLink.href = "home.html";
	bannerTop.appendChild(logoLink);
	
	var logo = document.createElement('img');
	logo.src = "Images/logo.png";
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
	
	var login = document.createElement("a");
	login.innerHTML = "Login / Signup";
	login.href = "Login.php";
	login.className = "bannerText"
	bannerTop.appendChild(login);
	
	
	
	var banner = document.createElement('div');
	banner.className = 'banner';
	
	var laptops = document.createElement("a");
	laptops.innerHTML = "Laptops";
	laptops.href = "Laptops.html";
	laptops.className = "bannerText"
	banner.appendChild(laptops);

	var accessories = document.createElement("a");
	accessories.innerHTML = "Accessories";
	accessories.href = "acs.html";
	accessories.className = "bannerText"
	banner.appendChild(accessories);
	
	var info = document.createElement("a");
	info.innerHTML = "Info Page";
	info.href = "information.html";
	info.className = "bannerText"
	banner.appendChild(info);
	
	var about = document.createElement("a");
	about.innerHTML = "About Us";
	about.href = "about us.html";
	about.className = "bannerText"
	banner.appendChild(about);

	var cart = document.createElement("a");
	cart.innerHTML = "Cart";
	cart.href = "cart.html";
	cart.className = "bannerText"
	banner.appendChild(cart);
	
	document.body.insertBefore(banner, document.body.firstChild);
	document.body.insertBefore(bannerTop, document.body.firstChild);
	
}
