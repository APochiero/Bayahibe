function Signer() {}

Signer.DEFAUL_METHOD = "POST";
Signer.URL_REQUEST = "./AJAX/SignIn.php";
Signer.ASYNC_TYPE = true;
Signer.SUCCESS_RESPONSE = "0";

Signer.signIn = 
	function () {
	
	var Username = document.forms[1].elements[0].value;
	var Password = document.forms[1].elements[1].value;
	var Email = document.forms[1].elements[3].value;
	var Newsletter = document.forms[1].elements[4].checked;
	var Name = document.forms[1].elements[5].value;
	var Surname = document.forms[1].elements[6].value;
	var BirthDate =  document.forms[1].elements[7].value;
	var Male = document.forms[1].elements[8].checked;
	var Female = document.forms[1].elements[9].checked;
	var Gender = Male ? "M" : Female ? "F" : null;
	var dataToSend = "Username=" + Username + "&Name=" + Name + "&Surname=" + Surname + "&Email=" + Email + "&Newsletter=" + Newsletter + "&Password=" + Password + "&Gender=" + Gender + "&BirthDate=" + BirthDate;
	var responseFunction = Signer.onAjaxResponse;
	AjaxManager.performAjaxRequest(Signer.DEFAUL_METHOD, Signer.URL_REQUEST, Signer.ASYNC_TYPE, dataToSend, responseFunction);
}


Signer.onAjaxResponse = 
	function(response) {
		hidePopup("SignIn");
		if ( response.responseCode == Signer.SUCCESS_RESPONSE ) {
			showPopup("Message", "Registrazione avvenuta con successo", true);
			setTimeout(function(){ location.reload(); }, 2000); //Dopo 2 secondi aggiorno la pagina in modo da effettuare il login automatico 
		}
		else {
			showPopup("Message", "Registrazione Fallita");
			setTimeout(function(){ location.reload(); }, 2000);
		}
}