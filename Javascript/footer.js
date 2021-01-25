$(document).ready (footer());

function footer ()
{
	//Non-breaking space to ensure footer is spaced after the rest of the body
	space = document.createElement('p');
	space.appendChild(document.createTextNode('\xa0'));
	document.body.appendChild(space);


	var footer = document.createElement('div');
	footer.className = 'footer';
	document.body.appendChild(footer);
	
	
	var leftCol = document.createElement('div');
	leftCol.className = 'footerCol';
	footer.appendChild(leftCol);
	
	copyright = document.createElement('p');
	copyright.className = "footerText";
	copyright.appendChild(document.createTextNode('\u00A9 2019, PC Hawk Inc.'));
	copyright.style.paddingBottom = "10px";
	copyright.style.textDecoration = "underline";
	leftCol.appendChild(copyright);
	
	Asmaa = document.createElement('p');
	Asmaa.className = "footerText";
	Asmaa.innerHTML = 'Asmaa Alzoubi, n01273657';
	leftCol.appendChild(Asmaa);
	
	Chakshu = document.createElement('p');
	Chakshu.className = "footerText";
	Chakshu.innerHTML = 'Chakshu Chakshu, n01204599';
	leftCol.appendChild(Chakshu);
	
	Viet = document.createElement('p');
	Viet.className = "footerText";
	Viet.innerHTML = 'Viet Hung Mai, n01219181';
	leftCol.appendChild(Viet);
	
	Brendan = document.createElement('a');
	Brendan.className = "footerText";
	//Brendan.href = "https://www.youtube.com/watch?v=oHg5SJYRHA0";
	Brendan.innerHTML = 'Brendan Woo, n01283870';
	Brendan.style.cursor = 'default';
	leftCol.appendChild(Brendan);
	
	
	var midCol = document.createElement('div');
	midCol.className = 'footerCol';
	footer.appendChild(midCol);
	
	var feedback = document.createElement('a');
	feedback.innerHTML = "Give us your feedback";
	feedback.href = "Feedback Form.html";
	feedback.className = "footerLink"
	midCol.appendChild(feedback);
	
	var toInfo = document.createElement('a');
	toInfo.innerHTML = "Learn more about us";
	toInfo.href = "about us.html";
	toInfo.className = "footerLink"
	midCol.appendChild(toInfo);
	
	var toAbout = document.createElement('a');
	toAbout.innerHTML = "Learn more about our team";
	toAbout.href = "information.html";
	toAbout.className = "footerLink"
	midCol.appendChild(toAbout);

	
	var rightCol = document.createElement('div');
	rightCol.className = 'footerCol';
	footer.appendChild(rightCol);
	
	var logo = document.createElement('img');
	logo.src = "/PC_Hawk/Images/logo.png";
	logo.className = "footerLogo";
	rightCol.appendChild(logo);
	
	var flag = document.createElement('img');
	flag.src = "/PC_Hawk/Images/canadaFlag.png";
	flag.className = "flag";
	rightCol.appendChild(flag);
	

	


}
