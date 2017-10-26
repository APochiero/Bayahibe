function Canceler() {}

Canceler.DEFAUL_METHOD = "GET";
Canceler.URL_REQUEST = "../PHP/AJAX/Canceler.php";
Canceler.ASYNC_TYPE = true;
Canceler.SUCCESS_RESPONSE = "0";

Canceler.cancel = 
	function ( Username, SelectedUmbrellas, Type, fromDate ) {
	var JSONSelectedUmbrellas = JSON.stringify(SelectedUmbrellas);
	var queryString = "?Username=" + Username + "&Type=" + Type + "&fromDate=" + fromDate + "&SelectedUmbrellas=" + JSONSelectedUmbrellas;
	var url = Canceler.URL_REQUEST + queryString;
	var responseFunction = Canceler.onAjaxResponse;
	AjaxManager.performAjaxRequest(Canceler.DEFAUL_METHOD, url, Canceler.ASYNC_TYPE, null, responseFunction);
}

Canceler.onAjaxResponse = 
	function(response) {
		hidePopup("ConfirmCancel");
		if ( response.responseCode == Canceler.SUCCESS_RESPONSE ) {
			showPopup("Message", "Cancellazione Completata con Successo", true);
			location.replace("./Prenotazioni.php#Prenotazioni");
		}
		else 
			showPopup("Message", "Cancellazione Fallita");
}