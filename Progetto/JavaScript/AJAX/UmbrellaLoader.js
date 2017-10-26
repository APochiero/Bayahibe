function UmbrellaLoader() {}

UmbrellaLoader.DEFAUL_METHOD = "GET";
UmbrellaLoader.URL_REQUEST = "../PHP/AJAX/UmbrellaLoader.php";
UmbrellaLoader.ASYNC_TYPE = true;
UmbrellaLoader.SUCCESS_RESPONSE = 0;
UmbrellaLoader.NO_DATA = -1;

UmbrellaLoader.loadUmbrella = 
	function ( searchType, fromDate, toDate ) {
	var queryString = "?searchType=" + searchType + "&fromDate=" + fromDate + "&toDate=" + toDate;
	var url = UmbrellaLoader.URL_REQUEST + queryString;
	var responseFunction = UmbrellaLoader.onAjaxResponse;
	
	AjaxManager.performAjaxRequest(UmbrellaLoader.DEFAUL_METHOD, url, UmbrellaLoader.ASYNC_TYPE, null, responseFunction);
}

UmbrellaLoader.onAjaxResponse =
	function ( response ) {
		if ( UmbrellaLoader.SUCCESS_RESPONSE || UmbrellaLoader.NO_DATA )
			Beach.refreshData(response.data);
		else 
			showPopup("Message", "Errore durante il carimento degli ombrelloni", false);
	}
	