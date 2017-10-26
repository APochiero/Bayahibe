<div id = "PopupLogin" class = "Popup">
	<h1 class = "PopupHeader" > Bayahibe Login </h1>
	<hr>
	<form enctype = "application/x-www-form-urlencoded" action = "./Utility/login.php" method = "post" >
		<div class = "popup_input">
			<input  name = "username" type = "text" placeholder = "Username" required autofocus>
			<img class = "icon_input" src = "../immagini/Icons/login-icon.png" alt = "icon input not found"> </img>
		</div>
		<div class = "popup_input">
			<input name = "password" type = "password" placeholder = "Password" required>
			<img class = "icon_input" src = "../immagini/Icons/password-icon.png" alt = "icon input not found" > </img>
		</div>	
		<?php if ( isset ( $_GET['errorMessage'] ) ) {
				echo '<p id = "login_error"> Username o Password non validi </p>';
				}
		?>
		<div>
			<input class = "popup_button" type = "submit" value = "Login" > 
			<img class = "icon_input" src = "../immagini/Icons/key-icon.png" alt = "icon input not found">
		</div>
		<input name = "ricordami" type = "checkbox" value = "1"> 
		<label> Ricordami </label>
	</form>
	<a href = "javascript: showPopup('SignIn')" onclick = "hidePopup('Login')"> Registrati Ora! </a>
</div>