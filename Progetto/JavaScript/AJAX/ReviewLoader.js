function ReviewLoader() {
}

ReviewLoader.DEFAUL_METHOD = "GET";
ReviewLoader.URL_REQUEST = "../PHP/AJAX/ReviewLoader.php";
ReviewLoader.ASYNC_TYPE = true;
ReviewLoader.SUCCESS_RESPONSE = "0";
ReviewLoader.NO_REVIEWS = "-1";

ReviewLoader.load = 
	function ( Type, Amount ) {
	
	var queryString = "?Type=" + Type + "&Amount=" + Amount;
	var url = ReviewLoader.URL_REQUEST + queryString;
	var responseFunction = ReviewLoader.onAjaxResponse;
	
	AjaxManager.performAjaxRequest(ReviewLoader.DEFAUL_METHOD, url, ReviewLoader.ASYNC_TYPE, null, responseFunction);
}

ReviewLoader.onAjaxResponse =
	function ( response ) {
		if ( response.responseCode == ReviewLoader.SUCCESS_RESPONSE ) 
			ReviewList.refreshData(response.data);
		else if ( response.responseCode == ReviewLoader.NO_REVIEWS ) {
			//Se non ci sono recensioni creo un avviso da appendere alla lista
			var li = document.createElement("li");
			var h2 = document.createElement("h2");
			var Review_List = document.getElementsByClassName("Review_List");
			h2.textContent = "Nessuna Recensione disponibile";
			document.getElementById("showMoreReview").style.display = "none";
			li.appendChild(h2);
			Review_List[0].appendChild(li);
		}
}