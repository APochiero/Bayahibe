function Finder() {}

Finder.DEFAUL_METHOD = "GET";
Finder.URL_REQUEST = "../PHP/AJAX/Finder.php";
Finder.ASYNC_TYPE = true;
Finder.SUCCESS_RESPONSE = "0";
Finder.WRONG_BEACH_TYPE = "-1";

Finder.findReservation = 
	function ( Username, SelectedUmbrella, Type, fromDate ) {
	
	var queryString = "?Username=" + Username + "&SelectedUmbrella=" + SelectedUmbrella + "&Type=" + Type + "&fromDate=" + fromDate;
	var url = Finder.URL_REQUEST + queryString;
	var responseFunction = Finder.onAjaxResponse;
	AjaxManager.performAjaxRequest(Finder.DEFAUL_METHOD, url, Finder.ASYNC_TYPE, null, responseFunction);
}

Finder.onAjaxResponse = 
	function(response) {
		if ( response.responseCode == Finder.SUCCESS_RESPONSE ) {
			NewUmbrellas = new Array();
			var Details = document.getElementsByClassName("detail"); 
			var j = 0;
			for ( var i in Beach.umbrellas ) { //Creo un array con i dati degli ombrelloni, con stato "toBeCanceled" se appartengono alla prenotazione trovata, invariati altrimenti
				if ( j < response.data.length - 1 && Beach.umbrellas[i].Number == response.data[j] ) { 
					NewUmbrellas[i] = { Username: Beach.umbrellas[response.data[j]].Username, Number: response.data[j], State: "toBeCanceled" };
					j++;
				} else {
					NewUmbrellas[i] = { Username: Beach.umbrellas[i].Username, Number: i, State: Beach.umbrellas[i].State };
				}
			}
			Beach.refreshData( NewUmbrellas ); // aggiorno gli ombrelloni
			Details[11].firstChild.nodeValue = response.data[j]; // L'ultimo campo dei dati ricevuti contiene la data di fine periodo che viene inserita nella tabella per il riepilogo della cancellazione
		}  else if ( response.responseCode == Finder.WRONG_BEACH_TYPE )
				showPopup( "Message", "Controlla di aver selezionato il tipo di prenotazione e la data di inizio periodo giusti. Se non ricordi i dettagli, puoi trovarli nella pagina profilo", false);
}