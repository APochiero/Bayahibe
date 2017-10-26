Validator.DEFAUL_METHOD = "GET";
Validator.URL_REQUEST = "./AJAX/Validator.php";
Validator.ASYNC_TYPE = true;
Validator.SUCCESS_RESPONSE = "0";
Validator.element;

function Validator() {}

Validator.checkConstraint = 
	function ( e ) {
	
		Validator.element = e.target;
		var type = Validator.element.name;
		var Value = Validator.element.value;
		Validator.element.setCustomValidity("");
		switch (type ) {
			case "Name": case "Surname" :	
				if ( !Validator.element.checkValidity() ) 
					Validator.element.setCustomValidity("Inserire caratteri validi (a-z, A-Z)");
				break;
			case "Password":
				if ( !Validator.element.checkValidity() ) 
					Validator.element.setCustomValidity("La password deve essere lunga almeno 8 caratteri e deve contenere un numero, una lettera minuscola e una maiuscola" );
				break;
			case "ConfirmPassword":
				var Password = document.forms[1].elements[1];
				console.log(Password.value);
				if ( Value !== Password.value )
					Validator.element.setCustomValidity("Password non corrisponde" );
				break;
			case "BirthDate": 
				if ( !checkValidityBirthDate(Value) ) 
					Validator.element.setCustomValidity("Età minima 16 anni o data non valida");
				break;
		}
	}

Validator.checkAjaxConstraint = 
	function ( e ) {	
	Validator.element = e.target;
	if ( Validator.element.validity.valueMissing )
		return;
	Validator.element.setCustomValidity("");
	var url = Validator.URL_REQUEST + "?Element=" + Validator.element.value + "&Type=" + Validator.element.name ;
	var responseFunction = Validator.onAjaxResponse;
	AjaxManager.performAjaxRequest(Validator.DEFAUL_METHOD, url, Validator.ASYNC_TYPE, null, responseFunction);
}

Validator.onAjaxResponse = 
	function( response ) {
		Validator.element.setCustomValidity("");
		if ( response.responseCode != Validator.SUCCESS_RESPONSE ) {
			var type = Validator.element.name;
			switch (type) {
				case "Username":
					Validator.element.setCustomValidity("Username già in uso"); break;
				case "Email":
					Validator.element.setCustomValidity("Email già in uso"); break;
			}
		}
	}

function AddHandlersSignIn() {
	
	var Username = document.forms[1].elements[0];
	var Password = document.forms[1].elements[1];
	var ConfirmPassword = document.forms[1].elements[2];
	var Email = document.forms[1].elements[3];
	var Name = document.forms[1].elements[5];
	var Surname = document.forms[1].elements[6];
	var BirthDate =  document.forms[1].elements[7];
	
	
	Username.addEventListener( "keyup", Validator.checkAjaxConstraint.bind(this));
	Name.addEventListener("keyup", Validator.checkConstraint.bind(this) );
	Surname.addEventListener("keyup", Validator.checkConstraint.bind(this));
	Email.addEventListener( "keyup", Validator.checkAjaxConstraint.bind(this));
	Password.addEventListener( "keyup", Validator.checkConstraint.bind(this));
	ConfirmPassword.addEventListener("keyup", Validator.checkConstraint.bind(this));
	BirthDate.addEventListener( "change", Validator.checkConstraint.bind(this));
}
