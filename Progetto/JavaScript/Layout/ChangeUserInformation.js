var nameInput = [ "Name", "Surname", "Email", "Gender" ];

function ChangeUserInformation() {
	
	var changeThese = document.getElementsByClassName("changeThis");
	var tbody = document.getElementById("removeChild");
	var table = document.getElementsByClassName("profile_table");
	var appendFormHere = document.getElementById("form_container");
	var ConfirmAvatarButton = document.getElementById("form_avatar_container");
	var avatarContainer = document.getElementById("avatar_container");
	var selectAvatar = document.getElementById("select_avatar");
	
	selectAvatar.setAttribute("onchange", "checkSize()");
	
	avatarContainer.setAttribute("onmouseover", "showReflexIcon()");
	avatarContainer.setAttribute("onmouseout", "hideReflexIcon()");
	avatarContainer.setAttribute("onclick", "OpenFileDialogBox()");
	avatarContainer.style.cursor = "pointer";
	ConfirmAvatarButton.style.display = "block";
	
	//Creazione degli input dei campi della tabella
	for ( var i = 0; i < 4; ++i) {
		var input = document.createElement("input");
		input.setAttribute("type", "text");
		input.setAttribute("placeholder", changeThese[i].textContent);
		input.setAttribute("name", nameInput[i]);
		changeThese[i].replaceChild(input, changeThese[i].firstChild);
	}	
	
	var BirthDate = document.createElement("input");
	BirthDate.setAttribute("type", "text");
	BirthDate.setAttribute("placeholder", changeThese[4].textContent);
	BirthDate.setAttribute("name", "BirthDate");
	BirthDate.addEventListener("change", function() { 
											this.setCustomValidity("");
											if ( checkValidityBirthDate(this.value) )
												return;
											this.setCustomValidity("Data non valida"); } );
	changeThese[4].replaceChild(BirthDate, changeThese[4].firstChild);
	
	for ( var i = 0; i < 7 ; ++i )	 //Rimozione delle righe a partire dalla settima
		tbody.removeChild(tbody.childNodes[7]);	
	
	//Creazione dei nuovi input
	var newPassword = document.createElement("input");
	newPassword.setAttribute("type", "password");	
	newPassword.setAttribute("name", "newPassword");	
	newPassword.setAttribute( "pattern","^(?=.*\\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$");
	console.log(newPassword);
	var tr = document.createElement("tr");
	var th = document.createElement("th");
	var td = document.createElement("td");
	td.appendChild(newPassword);
	th.textContent = "Nuova Password";
	tr.appendChild(th);
	tr.appendChild(td);
	tbody.appendChild(tr);
	
	var confirmNewPassword = document.createElement("input");
	confirmNewPassword.setAttribute("type", "password");
	confirmNewPassword.setAttribute("onkeyup", "checkPassword()");	
	var tr = document.createElement("tr");
	var th = document.createElement("th");
	var td = document.createElement("td");
	td.appendChild(confirmNewPassword);
	th.textContent = "Ripeti Password";
	tr.appendChild(th);
	tr.appendChild(td);
	tbody.appendChild(tr);
	
	var oldPassword = document.createElement("input");
	oldPassword.setAttribute("type", "password");	
	oldPassword.setAttribute("name", "oldPassword");	
	oldPassword.setAttribute("required", "required");
	var tr = document.createElement("tr");
	var th = document.createElement("th");
	var td = document.createElement("td");
	td.appendChild(oldPassword);
	th.textContent = "Vecchia Password";
	tr.appendChild(th);
	tr.appendChild(td);
	tbody.appendChild(tr);
	
	var Cancel = document.createElement("input");
	Cancel.setAttribute("type", "button");	
	Cancel.setAttribute("value", "Annulla");
	Cancel.setAttribute("class", "change_profile_button");
	Cancel.setAttribute("onclick", "location.replace('./Profile.php')" );
	
	var Confirm = document.createElement("input");
	Confirm.setAttribute("type", "submit");	
	Confirm.setAttribute("value", "Conferma");
	Confirm.setAttribute("class", "change_profile_button");
	
	
	var tr = document.createElement("tr");
	tr.setAttribute("class", "tr_button");
	var tdCancel = document.createElement("td");
	var tdConfirm = document.createElement("td");
	tdCancel.appendChild(Cancel);
	tdConfirm.appendChild(Confirm);
	tr.appendChild(tdCancel);
	tr.appendChild(tdConfirm);
	tbody.appendChild(tr);
	
	var form = document.createElement("form");
	form.setAttribute("method", "POST");
	form.setAttribute("action", "./Utility/ApplyUserChanges.php");
	form.setAttribute("enctype", "application/x-www-form-urlencoded");
	
	table[0].appendChild(tbody);
	form.appendChild(table[0]);
	appendFormHere.appendChild(form);

}

function checkPassword( type ) {
	var inputs = document.getElementsByTagName("input");
	var newPassword = inputs[8];
	var confirmNewPassword = inputs[9];		
	confirmNewPassword.setCustomValidity("");
	if ( confirmNewPassword.value != newPassword.value )
		confirmNewPassword.setCustomValidity("Password non corrisponde" );
}

function showReflexIcon() {
	var icon = document.getElementById("reflex-icon");
	icon.style.display = "block";
}

function hideReflexIcon() {
	var icon = document.getElementById("reflex-icon");
	icon.style.display = "none";
}

function OpenFileDialogBox() {
	document.getElementById("select_avatar").click();
}

function checkSize() {
	var selectAvatar =  document.getElementById("select_avatar");
	if ( selectAvatar.files[0].size > 65535 ) //64KB
		showPopup("Message", "Il file selezionato è troppo grande ");
}

//Reindirizzamento all'interfaccia grafica della spiaggia per la modifica della prenotazione selezionata con passaggio dei parametri tramite metodo GET
function ChangeUserReservation( Username, Type, fromDate, Umbrellas ) { 
	var Umbrella = Umbrellas.split('-');
	location.replace("./Prenotazioni.php?Username="+ Username + "&Type="+Type+"&fromDate="+fromDate+"&Umbrella="+Umbrella[0] + "#Prenotazioni");
}