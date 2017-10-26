function showPopup( Name, Message, Type ) { 	
	var focusEffect = document.getElementById("focus_effect_Popup"); 
	if( focusEffect === null ) { // Prima volta che viene mostrato un popup
		focusEffect = document.createElement("div");
		focusEffect.setAttribute("id", "focus_effect_Popup");	
	}
	
	var main = document.getElementById("MoveOnScroll");
	var height;
	var Popup = document.getElementById("Popup" + Name);

	main.appendChild(focusEffect);
	height =  document.body.scrollHeight; 

	switch ( Name ) { 
		case "SignIn": 
			AddHandlersSignIn(); //Associazione degli eventi per la validazione del form di registrazione
			var FormsElements = document.getElementsByName(Name); 
			//Inizializzazione campi 
			if ( navigator.userAgent.match(/firefox/i) ) 
				document.forms[1].elements[7].setAttribute("placeholder", "yyyy-mm-dd");
			else {
				SixteenYearsAgo = new Date(new Date().getTime() - 1000*60*60*24*365*16 - 4*24*60*60*1000); // 16 anni e 4 giorni fa ( 4 anni bisestili )
				var mm = SixteenYearsAgo.getMonth();
				var yyyy = SixteenYearsAgo.getFullYear();
				var dd = SixteenYearsAgo.getDate();
				var date = yyyy + "-" + mm + "-" + dd;
				document.forms[1].elements[7].setAttribute( "value", date);
			}
		
			document.forms[1].elements[0].focus(); break;
		case "Message": 
			document.getElementById("Message").firstChild.nodeValue = Message;
			document.getElementById("PopupMessage").childNodes[3].firstChild.nodeValue = Type? "Avviso!": "Errore!" ;
			break;
	}
	
	focusEffect.style.opacity = 0.1;
	focusEffect.style.display = "block";
	focusEffect.setAttribute("onclick", "hidePopup( '" + Name + "')" ); 
	Popup.style.opacity = 0.1;
	Popup.style.display = "block";
	window.addEventListener( "scroll", PopupOnScrollHandler.bind(Popup)  );
	
	var heightPopup = parseInt( window.getComputedStyle(Popup, null).getPropertyValue("height"));
	var top = window.pageYOffset + (window.innerHeight/2) - heightPopup/2; //Centratura del popup nella finestra "visibile" 
	
	Popup.style.top = top + "px";
	fadeIn( Popup, 0.05);
	fadeIn( focusEffect, 0.05);
}

function hidePopup( Name ) {
	var focusEffect = document.getElementById("focus_effect_Popup");
	focusEffect.style.display = 'none';
	var Popup = document.getElementById("Popup" + Name);
	Popup.style.display = 'none';
	window.removeEventListener( "scroll", PopupOnScrollHandler );
}

function showSubMenu( name ) {
	var subMenu = document.getElementById( "sub_menu_" + name );
	subMenu.style.display = 'block';
}

function hideSubMenu( name ) {
	var subMenu = document.getElementById( "sub_menu_" + name );
	subMenu.style.display = 'none';
}

function showCardsDetails() {
	document.getElementById("showIfCards").style.display = "block";
}

function hideCardsDetails() {
	document.getElementById("showIfCards").style.display = "none";
}

function PopupOnScrollHandler() { 
	if ( this.style.display == "none" ) 
		return;
	
	var top = parseInt(this.style.top);
	var height = parseInt( window.getComputedStyle(this, null).getPropertyValue("height"));
	
	//Scorrendo in giù, il popup con i bordo superiore 50px dall'alto della finestra "visibile"   
	if ( window.pageYOffset + 50 > top  /*&& window.pageYOffset  + top - window.innerHeight < document.body.scrollHeight */) {
		top = window.pageYOffset + 50;
		this.style.top = top + "px";
	} //Altrimenti se, scorrendo in su, il bordo inferiore del popup supera 50 px dal bordo inferiore della finestra "visibile" 
	else if ( top > window.pageYOffset  + window.innerHeight  - height  - 50  ) { 
		top = window.pageYOffset + window.innerHeight - height - 50;
		this.style.top = top + "px";
	}
}
