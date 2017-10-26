if( navigator.userAgent.match(/firefox/i) ) { 
	document.getElementById("header").style.position = "relative";
	document.getElementById("MoveOnScroll").style.top = 0 + "px";
} else {
	window.addEventListener("scroll", ScrollEventHandler);
	
}


window.addEventListener("resize", ResizeEventHandler);

function ScrollEventHandler() {
	var header = document.getElementById("header");
	var container = document.getElementById("container");
	var logo = document.getElementById("logo_bayahibe");
	var user = document.getElementById("user_profile_header");
	var navelements = document.getElementsByClassName("navelement");
	var subMenuBagno = document.getElementById("sub_menu_bagno");
	var subMenuMenu = document.getElementById("sub_menu_menu");
	var subMenuProfile = document.getElementById("sub_menu_profile");
	var main = document.getElementById("MoveOnScroll");
	var body = document.body;
	
	if ( document.body.scrollTop > 20 ) { //scrollando in giù di più di 20 px
		
		//Ridimensionamento dell'header
		for ( var i = 0; i < 5; i++ ) { 
			navelements[i].style.lineHeight = 89 + "px";
			navelements[i].style.bottom = 25 + "px";
		}
		
		header.style.height = 77 + "px";
		container.style.height = 57 + "px";
		logo.style.height = 52 + "px";
		logo.style.width = 100 + "px";
		logo.style.position = "relative";
		logo.style.top = -13 + "px";
		user.style.top = -13 + "px";
		subMenuBagno.style.top = 80 + "px";
		subMenuMenu.style.top = 80 + "px";
		if ( getCookie("CurrentUser") ) subMenuProfile.style.top = 90 + "px"; 
		
		main.style.top = 77 + "px"; 
	} else {
		header.style.height = 174 + "px";
		container.style.height = 174 + "px";
		logo.style.height = 104 + "px";
		logo.style.width = 200 + "px";
		logo.style.top = 0 + "px";
		user.style.top = 24 + "px";
		for ( var i = 0; i < 5; i++ ) {
			navelements[i].style.lineHeight = 109 + "px";
			navelements[i].style.bottom = 40 + "px";
		}
		subMenuBagno.style.top = 110 + "px";
		subMenuMenu.style.top = 110 + "px";
		if ( getCookie("CurrentUser") )  subMenuProfile.style.top = 110 + "px";
		main.style.top = 174 + "px";
	}
}

function ResizeEventHandler() {
	var container = document.getElementById("container");
	var navelements = document.getElementsByClassName("navelement");
	var Menu = document.getElementById("Menu");
	
	if ( window.innerWidth < 1210 ) 
		document.body.style.width = 1210 + "px"; //Profondità minima 
	if ( window.innerWidth < 1100  ) { //Trasformazione dell'header nel menu a tendina
		navelements[0].style.display = "none";
		navelements[1].style.display = "none";
		navelements[3].style.display = "none";
		navelements[4].style.display = "none";
		Menu.style.display = "inline-block";
		container.style.margin = 0 + "px";
		container.style.width = 50 + "%";
	} else {
		document.body.style.width = 100 + "%";
		navelements[0].style.display = "inline-block";
		navelements[1].style.display = "inline-block";
		navelements[3].style.display = "inline-block";
		navelements[4].style.display = "inline-block";
		Menu.style.display = "none";
		container.style.margin = "0 auto";
		container.style.width = 70 + "%";
	}
}