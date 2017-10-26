function Reserver() {}

Reserver.DEFAUL_METHOD = "GET";
Reserver.URL_REQUEST = "../PHP/AJAX/Reserver.php";
Reserver.ASYNC_TYPE = true;
Reserver.SUCCESS_RESPONSE = "0";

Reserver.reserve = 
	function ( SelectedUmbrellas, Type, fromDate, toDate, CarParking, MotoParking, BeachLounger, Cabin, Cabinet ) {
	var JSONSelectedUmbrellas = JSON.stringify(SelectedUmbrellas);
	var queryString = "?Type=" + Type + "&fromDate=" + fromDate + "&toDate=" + toDate + "&CarParking=" + CarParking + "&MotoParking=" + MotoParking + "&BeachLounger=" + 	 BeachLounger + "&Cabin=" + Cabin + "&Cabinet=" + Cabinet + "&JSONSelectedUmbrellas=" + JSONSelectedUmbrellas;
	
	var url = Reserver.URL_REQUEST + queryString;
	var responseFunction = Reserver.onAjaxResponse;
	AjaxManager.performAjaxRequest(Reserver.DEFAUL_METHOD, url, Reserver.ASYNC_TYPE, null, responseFunction);
}


Reserver.onAjaxResponse = 
	function(response) {
		hidePopup("Confirm");
		if ( response.responseCode == Reserver.SUCCESS_RESPONSE ) {
			Beach.loadUmbrellas();
			showPopup("Message", "Prenotazione Completata con Successo", true);
		}
		else 
			showPopup("Message", "Prenotazione Fallita");
}