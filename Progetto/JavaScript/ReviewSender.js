function ReviewSender() {} 

ReviewSender.DEFAUL_METHOD = "GET";
ReviewSender.URL_REQUEST = "../PHP/AJAX/ReviewSender.php";
ReviewSender.ASYNC_TYPE = true;
ReviewSender.SUCCESS_RESPONSE = "0";


ReviewSender.Send = function() {
	
	var Title = document.getElementById("NewReviewTitle").value;
	var Vote = document.getElementById("VoteValue").value;
	var Text = document.getElementById("NewReviewText").value;
	if ( Vote == 0 ) {
		showPopup("Message", "Esprimi il tuo giudizio tramite il voto", true);
		return;
	} else if ( Text == "" ||  !/\S/.exec(Text) ) {// Se è vuoto o solo spazi bianchi
		showPopup("Message", "Inserisci il testo della recensione", true);
		return;
	}
	var queryString = "?Title=" + Title + "&Vote=" + Vote + "&Text=" + Text;  
	var url = ReviewSender.URL_REQUEST + queryString;
	var responseFunction = ReviewSender.onAjaxResponse;
	AjaxManager.performAjaxRequest(ReviewSender.DEFAUL_METHOD, url, ReviewSender.ASYNC_TYPE, null, responseFunction);
}


ReviewSender.onAjaxResponse = 
	function(response) {
		if ( response.responseCode == ReviewSender.SUCCESS_RESPONSE ) { 
			//Resetto i campi del modulo per la scrivere una recensione
			document.getElementById("NewReviewTitle").value = "";
			document.getElementById("VoteValue").value = "";
			document.getElementById("NewReviewText").value = "";
			
			showPopup("Message", "Recensione Inviata", true);
			setTimeout(function(){ location.reload(); }, 2000);
		}
		else 
			showPopup("Message", "Errore durante l'invio", false);
}

ReviewSender.setStarImage = function( e ) { 
	//Aggiorno l'immagine delle stelle in base alla posizione del cursore 
	var img = document.getElementById("NewReviewVote");
	var input = document.getElementById("VoteValue");
	var vote = Number( e.currentTarget.getAttribute("id"));
	
	input.value = vote;
	img.src = "../immagini/Stars/" + e.currentTarget.getAttribute("id") + ".png";
		
	
}

ReviewSender.setStarEvent = function() {
	var stars = document.getElementsByClassName("Star");
	//Associo alle stelle l'evento mouseover
	for ( var i = 0; i < 11; ++i ) 
		stars[i].addEventListener( "mouseover" , this.setStarImage.bind(this) );
}

ReviewSender.setStarEvent(); //Chiamata durante il caricamento dello script
	
	
	
