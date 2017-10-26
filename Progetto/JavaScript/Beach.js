function Beach() {}

Beach.BeachTable = document.getElementById("umbrella_grid");
Beach.umbrellas = new Array(45);
Beach.Type = "Daily";
Beach.fromDate = null ;
Beach.toDate = null ;
Beach.indexUmbrella = 1;
Beach.SelectedUmbrellas = new Array();
	
Beach.initialize = function() { // Inizializzo gli ombrelloni della spiaggia e setto la data 
	for ( var i = 0; i < 5; ++i ) {
		for ( var j = 0; j < 9; ++j ) {
			var position = i*9 + j + 1;
			var td = document.getElementById("umbrella" + position);
			var umbrella = new Umbrella( "", position,"available", td);
			Beach.umbrellas[position] = umbrella;
		}
	}
	Beach.setDate();
}

Beach.loadUmbrellas = 
	function() { // carico gli ombrelloni
		UmbrellaLoader.loadUmbrella( Beach.Type, Beach.fromDate, Beach.toDate );
}


Beach.refreshData =
	function( data ) {	// Aggiorno gli ombrelloni
	for ( var i in Beach.umbrellas )
		Beach.umbrellas[i].clear(); // Ripulisco gli stati precedenti 
	    
	for ( var i in data ) {
		var numberUmbrella = data[i].Number; 
	
		Beach.umbrellas[numberUmbrella].State = data[i].State;	
		Beach.umbrellas[numberUmbrella].Username = data[i].Username;	
		Beach.umbrellas[numberUmbrella].refreshClassName();
	}
	
	Beach.drawUmbrella(); // Aggiorno la grafica
}

Beach.drawUmbrella = 
	function() {
		if( navigator.userAgent.match(/firefox/i) ) { // Se firefox uso animazione diversa
			Beach.drawUmbrellaFirefox();
			return;
		}
		
		var wait = setInterval( function() { // Animazione di aggiornamento ombrelloni
		if ( Beach.indexUmbrella < 46 ) {
			fadeIn(Beach.umbrellas[Beach.indexUmbrella].htmlElement, 0.4);
			Beach.indexUmbrella++;
		} else {
			Beach.indexUmbrella = 1;
			clearInterval(wait);
		} },  5 );
 	}

Beach.drawUmbrellaFirefox = 
	function() {
		Umbrella_grid = document.getElementById("umbrella_grid");
		fadeIn(Umbrella_grid, 0.2);
	} 

	
	
Beach.setDate = 
	function() {
		var fromDate = document.getElementById("reservation_from_date");
		var toDate = document.getElementById("reservation_to_date");
		var today = new Date(new Date().getTime() + 24 * 60 * 60 * 1000); // Data di domani
		var dd = today.getDate();
		var mm = today.getMonth() + 1;
		var yyyy = today.getFullYear();
		
		if ( mm <= 4 ) { // prima di Maggio 
			dd = "01";
			mm = "05";
		} else if ( mm >= 10 ) { // dopo di Settembre
			dd = "01";
			mm = "05";
			yyyy += 1;
		} else if ( mm < 10 ) // tra maggio e settembre
			mm = "0" + mm;
	
		if ( !/(\d{2})/.exec(dd) )
			dd = "0"+dd;
		
		Beach.fromDate = yyyy+"-"+mm+"-"+dd;
		fromDate.setAttribute( "value", yyyy+"-"+mm+"-"+dd );
		fromDate.setAttribute( "min", yyyy+"-"+mm+"-"+dd );
		fromDate.setAttribute( "max", yyyy+"-09-30");
		fromDate.addEventListener( "change", Beach.updatefromDate.bind(Beach), false); // Ad ogni modifica ricerco gli ombrelloni 
		
		Beach.toDate =  yyyy+"-"+mm+"-"+dd;
		toDate.setAttribute( "value", yyyy+"-"+mm+"-"+dd );
		fromDate.setAttribute( "min", yyyy+"-"+mm+"-"+dd );
		toDate.setAttribute( "max", yyyy+"-09-30");
		toDate.addEventListener("change", Beach.updatetoDate.bind(Beach), false) // Ad ogni modifica ricerco gli ombrelloni 
	}

Beach.updatefromDate = 
	function () {
		var fromDate = document.getElementById("reservation_from_date").value;
		var toDate = document.getElementById("reservation_to_date");

		if ( !checkValidityDate( fromDate ) ) 
			showPopup("Message", "Data Inizio Periodo non valida", false); 
		else if ( Beach.fromDate !=  fromDate ) {
			Beach.fromDate = fromDate;
			if ( Beach.fromDate > Beach.toDate ) { // Se la data di inizio supera quella di fine, aggiorno quella di fine periodo 
				Beach.toDate = fromDate;
				toDate.value = fromDate;
			}
			Beach.loadUmbrellas(); // Aggiorno
		}
	}

Beach.updatetoDate =
	function() {
		var toDate = document.getElementById("reservation_to_date").value;
		var fromDate = document.getElementById("reservation_from_date");
		if( !checkValidityDate(toDate) ) {
			showPopup("Message", "Data Fine Periodo non valida", false);
			return;
		} else if (  Beach.toDate  != toDate )	{
			Beach.toDate = toDate;
			if ( Beach.fromDate > Beach.toDate ) { // Se la data di fine è inferiore a quella di inizio, aggiorno quella di inizio periodo 
				Beach.fromDate = toDate;
				fromDate.value = toDate;
			}
			Beach.loadUmbrellas(); // Aggiorno
		}
	}
	
Beach.fillDetails = 
	function() {  	// Cerco Ombrelloni Selezionati
	
		Beach.SelectedUmbrellas = new Array();
		Beach.fillSelectedUmbrellas("toBeCanceled", "userUmbrella", "selected");// Cerco ombrelloni selezionati, sostituisco "daCancellare" con "Utente"
	
		if ( Beach.SelectedUmbrellas.length == 0 ) {	// Se nessun ombrellone è stato selezionato, errore
			showPopup("Message","Seleziona almeno un Ombrellone da prenotare", false);
			return;
		}
		var Details = document.getElementsByClassName("detail"); //Array degli elementi della tabella da riempire
		var DetailsPayment = document.getElementsByClassName("detail_payment"); //Array degli elementi della tabella di pagamento da riempire
		var PriceHighSeason = 0 ;
		var PriceOffSeason = 0;
		var PriceExtra = 0;
		var Price = 0;
		
		var extra = Beach.getExtra();		
		Details[3].firstChild.nodeValue = ""; // inizializzo la stringa di ombrelloni
		
		for ( i in Beach.SelectedUmbrellas ) { 
			var number = Beach.SelectedUmbrellas[i];
			if ( i == 0 ) 
				Details[3].firstChild.nodeValue += number;  // primo ombrellone della stringa 
			else 
				Details[3].firstChild.nodeValue += " " + number; // ombrelloni successivi
			var PriceUmbrella =  Beach.umbrellas[number].getPrice(Beach.Type); // Ottengo il prezzo dell'ombrellone sia in alta che in bassa stagione, in base alla tipologia di spiaggia
			PriceHighSeason += PriceUmbrella[0];
			PriceOffSeason += PriceUmbrella[1];
		}
		
		switch( Beach.Type ) { //setto il prezzo degli oggetti extra in base alla tipologia di prenotazione 
			case "Daily" : PriceExtra += extra[0]*5 + extra[1]*4 + extra[2]*10 + extra[3]*10 + extra[4]*2 ; break;
			case "Morning": PriceExtra += extra[0]*2 + extra[1]*1 + extra[2]*5 + extra[3]*5 + extra[4]*2 ; break;
			case "Afternoon": PriceExtra += extra[0]*3 + extra[1]*2 + extra[2]*7 + extra[3]*7 + extra[4]*2 ; break;
			default: break;
		}
					
		var count = Beach.getSeasonDays();	// ottengo i giorni di bassa e alta stagione
		Price = PriceHighSeason*count[0] + PriceOffSeason*count[1] + PriceExtra*( count[0] + count[1] ); //prezzo singolo giorno * numero di giorni di alta e bassa stagione + prezzo degli extra * i giorni totali
		
		var currentUser = getCookie("CurrentUser"); 
		Details[0].firstChild.nodeValue = Beach.fromDate; //riempio i campi della tabella del popup
		Details[1].firstChild.nodeValue = Beach.toDate;
		Details[2].firstChild.nodeValue = Beach.Type == "Daily"? "Intero": Beach.Type == "Morning"? "Mattina":"Pomeriggio" ;
		Details[4].firstChild.nodeValue = extra[0]? "Si": "No";
		Details[5].firstChild.nodeValue = extra[1]? "Si": "No";
		Details[6].firstChild.nodeValue = extra[2]? "Si": "No";
		Details[7].firstChild.nodeValue = extra[3]? "Si": "No";
		Details[8].firstChild.nodeValue = extra[4]? "Si": "No";
		Details[9].firstChild.nodeValue = Price + "€";
		
		DetailsPayment[0].firstChild.nodeValue = currentUser; //riempio i campi del pagamento
		DetailsPayment[1].firstChild.nodeValue = Price + "€";
	
		showPopup("Confirm"); //mostro il popup
}

Beach.getSeasonDays = 
	function() {
		var elements = Beach.fromDate.split("-");  
		var fromDate = new Date( elements[0], elements[1]-1, elements[2]); // data di inizio prenotazione
		var elements = Beach.toDate.split("-");
		var toDate = new Date( elements[0], elements[1]-1, elements[2]); // data di fine prenotazione 
			
		var startHighSeason = new Date(elements[0], 6, 1); // da 01/07
		var endHighSeason = new Date(elements[0],7,31); // a 31/08
		var countOffSeason = 0;
		var countHighSeason = 0;
		
		while ( fromDate <= toDate ) { // controllo giorno per giorno se la data attuale è di alta o bassa stagione e aumento i rispettivi contatori
			if ( fromDate <= endHighSeason && fromDate >= startHighSeason )
				countHighSeason++;
			else
				countOffSeason++;
			fromDate = new Date ( fromDate.getTime() + 24 * 60 * 60 * 1000 ); //avanzamento data
		}
		var count = [ countHighSeason, countOffSeason ];
		return count;
	}

Beach.getExtra = 
	function() {
		var extra = document.getElementsByName("extra_item_checkbox");
		var CarParking = extra[0].checked?1:0;
		var MotoParking = extra[1].checked?1:0;
		var BeachLounger = extra[2].checked?1:0;
		var Cabin = extra[3].checked?1:0;
		var Cabinet = extra[4].checked?1:0;
		var result = [CarParking, MotoParking, BeachLounger, Cabin, Cabinet ];
		return result;
	}

Beach.reserve = 
	function() {
		var extra = Beach.getExtra(); 
		Reserver.reserve( Beach.SelectedUmbrellas, Beach.Type, Beach.fromDate, Beach.toDate, extra[0], extra[1], extra[2], extra[3], extra[4] ); 
		hidePopup("ConfirmPayment");
	}

Beach.SelectReservationtoModify = //Cerco tutti gli ombrelloni che fanno parte della stessa prenotazione dell'ombrellone selezionato
	function( Username,Number ) {
		console.log("cerco");
		var SelectedUmbrella = Number;
		Finder.findReservation( Username, SelectedUmbrella, Beach.Type, Beach.fromDate );
	}

Beach.fillDetailsToBeCanceled = 
	function() {
		var check = checkValidityCancelReservation(Beach.fromDate); // Cancellazione possibile solo con 3 giorni di anticipo
		if ( !check ) {
			showPopup("Message", "Spiacente, Cancellazione non possibile perchè superiore a 3 giorni dalla prenotazione", false);
			return;
		}
		Beach.SelectedUmbrellas = new Array();	
		Beach.fillSelectedUmbrellas( "selected", "available", "toBeCanceled"); //Cerco gli ombrelloni da cancellare, sostituisco i "selezionati" con "disponibile" 
			
		if ( Beach.SelectedUmbrellas.length == 0 ) {	
			showPopup("Message","Nessuna Prenotazione da annullare", false);
			return;
		}
		
		var Details = document.getElementsByClassName("detail"); //Riempio i campi del popup
		Details[10].firstChild.nodeValue = Beach.fromDate;  
		Details[12].firstChild.nodeValue = Beach.Type == "Daily"? "Intero": Beach.Type == "Morning"? "Mattina":"Pomeriggio" ;
		Details[13].firstChild.nodeValue = '';
		for ( i in Beach.SelectedUmbrellas ) { 
			if ( i == 0 ) 
				Details[13].firstChild.nodeValue += Beach.SelectedUmbrellas[i];  // primo ombrellone della stringa 
			else 
				Details[13].firstChild.nodeValue += " " + Beach.SelectedUmbrellas[i]; // ombrelloni successivi
		}
		showPopup("ConfirmCancel");
		console.log(Beach.SelectedUmbrellas);
}

Beach.cancel = 
	function() {	
		var j = 0;
		var Username = Beach.umbrellas[ Beach.SelectedUmbrellas[0] ].Username;
		Canceler.cancel( Username, Beach.SelectedUmbrellas, Beach.Type, Beach.fromDate );
	}

	
Beach.fillSelectedUmbrellas = function( ClearState, ReplaceState, fillWithState ) {
	var j = 0;
	for ( i in Beach.umbrellas ) {
		if ( Beach.umbrellas[i].State == ClearState) { // Sostituzione dello stato 
			 Beach.umbrellas[i].State == ReplaceState;
			 Beach.umbrellas[i].htmlElement.className = "umbrella_" ;
			 Beach.umbrellas[i].htmlElement.className += ReplaceState == "available"? ReplaceState: "user";
		} else if ( Beach.umbrellas[i].State == fillWithState ) { // Riempimento dell'array con gli ombrelloni che hanno lo stato fillWithState
			Beach.SelectedUmbrellas[j] = Beach.umbrellas[i].Number;
			j++;
		}
	}
}

Beach.OnLoadSelectReservationtoModify = 
	function( Username, Type, fromDate, Umbrella ) {
		var fromDateinput = document.getElementById("reservation_from_date");
		fromDateinput.value = fromDate;
		Beach.updatefromDate();
		var tab = Type == "Intero"? 1: ( Type == "Mattina"? 2:3 );
		exalt(tab);
		Beach.loadUmbrellas();
		//Ritardo aggiunto per evitare che questa funzioni venga effettuata prima della loadUmbrellas() 
		setTimeout(function(){ Beach.SelectReservationtoModify(Username, Umbrella); }, 50); 
	}






 