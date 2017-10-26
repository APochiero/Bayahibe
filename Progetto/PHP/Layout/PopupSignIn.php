<div id = "PopupSignIn" class = "PopupSignIn">
	<h1 class="PopupHeader"> Registrazione </h1>
	<hr>
	<form action = "javascript: Signer.signIn()" >
		<div class = "left_side_signIn">
			<div class = "popup_input"> 
				<input type = "text" name = "Username" placeholder = "Username*" required >
				<img class = "icon_input" src = "../immagini/Icons/login-icon.png" alt = "icon input not found"> </img>
			</div>
			<div class = "popup_input"> 					
				<input type = "password" name = "Password" placeholder = "Password*" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$" required>
				<img class = "icon_input" src = "../immagini/Icons/password-icon.png" alt = "icon input not found"> </img>
			</div>
			<div class = "popup_input"> 					
				<input type = "password" name = "ConfirmPassword" placeholder = "Conferma Password*" required>
				<img class = "icon_input" src = "../immagini/Icons/password-icon.png" alt = "icon input not found"> </img>
			</div>
			<div class = "popup_input"> 					
				<input type = "email" name = "Email" placeholder = "email@email.com*" required>
				<img class = "icon_input" src = "../immagini/Icons/email-icon.png" alt = "icon input not found"> </img>
			</div>
			<label> <input type = "checkbox" name = "NewsletterSignIn"> Iscriviti alla NewsLetter! </label>
		</div>
		<div class = "right_side_signIn" > 
			<div class = "popup_input"> 					
				<input type = "text" name = "Name" placeholder = "Nome*" pattern="[a-zA-Z\s]+" required >
				<img class = "icon_input" src = "../immagini/Icons/name-icon.png" alt = "icon input not found"> </img>
			</div>
			<div class = "popup_input"> 					
				<input type = "text" name = "Surname" placeholder = "Cognome*" pattern="[a-zA-Z\s]+" required>
				<img class = "icon_input" src = "../immagini/Icons/name-icon.png" alt = "icon input not found"> </img>
			</div>
			
			<div class = "popup_input"> 
				<input type = "date" name = "BirthDate" required>
				<img class = "icon_input" src = "../immagini/Icons/Calendar-icon.png" alt = "icon input not found"> </img>
			</div>
			<div class = "popup_input_gender"> 
				<input type = "radio" name = "Gender" value = "Male">
				<img class = "icon_input" src = "../immagini/Icons/male-icon.png" alt = "icon input not found"> </img>
				<input type = "radio" name = "Gender" value = "Female">
				<img class = "icon_input" src = "../immagini/Icons/female-icon.png" alt = "icon input not found"> </img>
			</div>
			<div class = "PopupButtons">
				<input type = "button" value = "Annulla" onclick = "hidePopup('SignIn')">
				<input type = "submit" value = "Conferma">
			</div>
		</div>
	</form>
</div>