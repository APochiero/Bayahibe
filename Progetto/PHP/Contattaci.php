<?php
	session_start();
	require_once __DIR__ . "/config.php";
    require_once DIR_UTILITY . "Session.php";
	require_once DIR_UTILITY . "BayahibedbManager.php";
?>

<!DOCTYPE html>
<html lang = "it">
	<head>
		<meta charset="utf-8"> 
    	<meta name = "author" content = "Progettazione WEB">
    	<meta name = "keywords" content = "bayahibe, lido, baia di riaci">	
		<script type="text/javascript" src="../JavaScript/AJAX/ajaxManager.js"></script>
		<script type="text/javascript" src="../JavaScript/AJAX/Validator.js"></script>
		<script type="text/javascript" src="../JavaScript/AJAX/Signer.js"></script>
		<script type="text/javascript" src="./../JavaScript/Effects.js"></script>
		<script type="text/javascript" src="./../JavaScript/Utility/checkValidity.js"></script>
		<script type="text/javascript" src="./../JavaScript/Layout/Popups.js"></script>
		<script type="text/javascript" src="./../JavaScript/Contact.js"></script>
		<link rel="shortcut icon" type="image/x-icon" href="../Immagini/Icons/logo-title-Bayahibe.ico">
		<link rel="stylesheet" href="./../css/bayahibe.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/Header.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/Footer.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/Popup.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/Contattaci.css" type="text/css" media="screen">
		<title>Bayahibe::Contatti</title>
	</head>
	<body 
		<?php 
			if ( isset($_GET['ok']) )
				echo 'onLoad = "showPopup(\'Message\', \'Email inviata con successo!\', true)"'; ?> >
		<?php
			if ( !isLogged() ) {
				if ( isset($_COOKIE['userAuthentication']) ) {	
						$userInfo = explode(";", $_COOKIE['userAuthentication'] );
						setSession($userInfo[0],$userInfo[1]);
					} else 	{
						include DIR_LAYOUT . "PopupLogin.php";
						include DIR_LAYOUT . "PopupSignIn.php";
					}
			} 
			include DIR_LAYOUT . "Header.php";
			include DIR_LAYOUT . "PopupMessage.php"
		?>
		<main id = "MoveOnScroll" >
			<script type="text/javascript" src="../JavaScript/Layout/HeaderEvents.js"></script>
			<section class = "informations_container"> 
				<div class ="come_raggiungerci_container"> 
					<h2> Come Raggiungerci </h2>	
					<div class = "informazioni_auto">
						<ul>
							<li><img src = "../immagini/Icons/car-icon.png" alt ="car not found"> <strong> In auto:</strong> </li>
							<li>
								<ul class = "sublist">
									<li><strong> da Nord: </strong></li> 								
									<li><p> Autostrada A3 Salerno-Reggio Calabria uscita Pizzo Calabro quindi S.S. 
											522 per Tropea (dall'uscita dell'autostrada 35 Km) </p></li>
									<li><strong> da Sud: </strong></li>
									<li><p>Autostrada A3 uscita Rosarno e proseguimento per Rosarno
											- Nicotera - Joppolo - Ricadi - Tropea</p></li>
								</ul>
							</li>
						</ul>
					</div>	
					<div class = "informazioni_treno_aereo">
						<ul>
							<li><img src = "../immagini/Icons/train-icon.png" alt ="train not found"><strong> In treno:</strong> </li>
							<li>
								<ul class = "sublist"> 
									<li> Stazione di Lamezie Terme </li>						
									<li> Stazione di Vibo Pizzo </li>							
									<li> Stazione di Tropea </li>
								</ul>
							</li>
							<li><img src = "../immagini/Icons/plane-icon.png" alt ="plane not found"><strong> In Aereo:</strong> </li>
							<li>
								<ul> 
									<li> Aeroporto di Lamezia Terme 75 km </li>
									<li> Aeroporto di Reggio Calabria 100 km </li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				<aside>
					<h2> Meteo </h2>
					<iframe class = "meteo" src="https://www.3bmeteo.com/moduli_esterni/localita_7_giorni_mare/7493/ffffff/0e02ee/5e5e5e/5bb9ec/it"> </iframe></aside>
			</section>
			<div>
				<div id = "map_container" onclick = "enableMouseOnMap()" > </div>
				<iframe onmouseout = "disableMouseOnMap()" class = "google_maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2355.8579650934794!2d15.868339570417776!3d38.67093312706631!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb187c9aaa933136f!2sSpiaggia+Di+Riaci!5e1!3m2!1sit!2sit!4v1474620051495"></iframe>
			</div>
			<div class = "contact_wrapper">
				<header>
					<h2> Contatti </h2>
					<p> Per maggiori informazioni sulla struttura, i servizi, il ristorante o le prenotazioni non esitate a contattarci.
						Saremo davvero lieti di rispondere alle vostre domande. <br>
						Telefono: +39 0966930043 / +39 0966937766 <br>
						Mobile: 3202459861 <br>
						</p>
					<address> Email: <a href = "mailto:progettopweb@gmail.com" > info@Bayahibe.com </a> </address>
				</header>
				<form method = "POST" action = "./Utility/sendEmail.php">
					<label> Nome </label>
					<label> Cognome </label>
					<input name = "Name" class = "contact_input" type = "text" required> 
					<input name = "Surname" class = "contact_input" type = "text" required> 
					<label> Email </label>
					<label> Oggetto </label>
					<input name = "Email" class = "contact_input" type = "email" required> 
					<input name = "Object" class = "contact_input" type = "text"> 
					<label> Messaggio </label>
					<textarea name = "Message" id= "contact_message" required> </textarea>
					<div id="submit_contact_container">
						<input id = "contact_submit" type = "submit" value = "Invia"> 
					</div>
				</form>	
			</div>	
		<?php include DIR_LAYOUT . "Footer.php"; ?>
		</main>
	</body>
</html>	
		