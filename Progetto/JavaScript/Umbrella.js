
function Umbrella( Username, Number, State, element ) { 
	this.Number = Number;
	this.State = State; 
	this.Username = Username;
	this.htmlElement = element;
	
	this.htmlElement.addEventListener( "click", this.selectUmbrella.bind(this), false );
	this.htmlElement.addEventListener( "mouseover", this.overUmbrella.bind(this), false );
	this.htmlElement.addEventListener( "mouseout", this.outUmbrella.bind(this), false );
}

Umbrella.prototype.clear =
	function () { //Aggiorno lo stato in base allo stato precedente
		if ( this.State == "selected" || this.State == "reserved" || this.State == "userUmbrella" ) {
			this.State = "available";
			this.htmlElement.className = "umbrella_available";
			this.Username = "";
		} else if ( this.State == "toBeCanceled" ) { //Se era "toBeCanceled" e non è stato cancellato, allora ritorno ad essere "userUmbrella"
			this.State = "userUmbrella";
			this.htmlElement.className = "umbrella_user";
		}
}

Umbrella.prototype.refreshClassName = //Aggiorno la class in base allo Stato
	function () {
		switch(this.State) {
			case "available": 
				this.htmlElement.className = "umbrella_available"; break;
			case "reserved":
				this.htmlElement.className = "umbrella_reserved"; break;
			case "userUmbrella":
				this.htmlElement.className = "umbrella_user"; break;
			case "toBeCanceled":
				this.htmlElement.className = "umbrella_toBeCanceled"; break;
			default: break;
		}
	}
	
Umbrella.prototype.getPrice = 
	function( BeachType ) {
		var row = Math.floor((this.Number-1)/9); //Calcolo la fila dell'ombrellone
		var PriceHighSeason = 0;
		var PriceOffSeason = 0;
		
		if ( row == 0 || row == 1 ) { // Setto i prezzi di alta e bassa stagione per la prima e la seconda fila
			switch( BeachType ) {
				case "Daily": PriceHighSeason += 20; 
							  PriceOffSeason += 15; break;
				case "Morning": PriceHighSeason += 13; 
								PriceOffSeason += 8; break;
				case "Afternoon": PriceHighSeason += 15;
								  PriceOffSeason += 10;	break;
				default: break;
			}
		} else { 
			switch( Beach.Type ) { // Setto i prezzi di alta e bassa stagione per le altre file
				case "Daily": PriceHighSeason += 18; 
							  PriceOffSeason += 13; break;
				case "Morning": PriceHighSeason += 11; 
								PriceOffSeason += 6; break;
				case "Afternoon": PriceHighSeason += 13;
								  PriceOffSeason += 8;	break;
				default: break;
			}
		}
		var Price = [ PriceHighSeason, PriceOffSeason ];
		return Price;
	}

Umbrella.prototype.overUmbrella = // Animazione per il passaggio del cursore sopra l'ombrellone
	function() {
	if ( this.State == "available" || this.State == "selected" || this.State == "userUmbrella" || this.State == "toBeCanceled" )
		this.htmlElement.style.backgroundSize = "100% 100%";
	var currentUser = getCookie("CurrentUser"); 
	//Se "this" è il mio ombrellone oppure sono l'admin, mostra l'username
 	if ( (this.State == "userUmbrella" || this.State == "reserved" || this.State == "toBeCanceled") &&  ( currentUser == "admin" || currentUser == this.Username ) )
		this.showUsername();
}

Umbrella.prototype.outUmbrella = // Animazione per dell'uscita del cursore dall'ombrellone
	function() {
	if ( this.State == "available" || this.State == "selected" || this.State == "userUmbrella" || this.State == "toBeCanceled" ) 
		this.htmlElement.style.backgroundSize = "70% 70%";
	var currentUser = getCookie("CurrentUser");
	if ( (this.State == "userUmbrella" || this.State == "reserved" || this.State == "toBeCanceled") &&  ( currentUser == "admin" || currentUser == this.Username ) )	
		this.hideUsername();
}

Umbrella.prototype.selectUmbrella = //Animazione in seguito al click sull'ombrellone
	function() {
	if ( this.State == "available") {
		this.htmlElement.className = "umbrella_selected";
		this.State = "selected";
	} else if (this.State == "selected") {
		this.htmlElement.className = "umbrella_available";
		this.State = "available";
		this.outUmbrella;
	} else if ( this.State == "userUmbrella" ) {
		Beach.SelectReservationtoModify( this.Username, this.Number );
	} else if ( this.State == "toBeCanceled") {
		this.htmlElement.className = "umbrella_user";
		this.State = "userUmbrella";
	}
}

Umbrella.prototype.showUsername = function() { //Creo e posiziono un div contenente l'username del proprietario dell'ombrellone 
	
	var user = document.createElement("div"); 
	var row = Math.floor((this.Number-1)/9);
	var top = row*60 + 40;
	var left = (this.Number - 1)%9*60 + 20;
	
	user.setAttribute("id", "Username" + this.Number );
	user.setAttribute("class", "speechBubble" );
	user.style.top = top+"px";
	user.style.left = left+"px";
	user.textContent = this.Username;
	this.htmlElement.appendChild(user);	
}

Umbrella.prototype.hideUsername = function() { //rimuovo il div per l'username
	var user = document.getElementById("Username"+ this.Number);
	this.htmlElement.removeChild(user);	
}




