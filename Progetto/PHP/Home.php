<?php
	session_start();
	require_once __DIR__ . "/config.php";
    require_once DIR_UTILITY . "Session.php";
	require_once DIR_UTILITY . "BayahibedbManager.php";
	
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
    	<meta name = "author" content = "Progettazione WEB">
    	<meta name = "keywords" content = "bayahibe, lido, baia di riaci">	
		<script type="text/javascript" src="../JavaScript/AJAX/ajaxManager.js"></script>
		<script type="text/javascript" src="../JavaScript/AJAX/Validator.js"></script>
		<script type="text/javascript" src="../JavaScript/AJAX/Signer.js"></script>
		<script type="text/javascript" src="../JavaScript/Slider.js"></script>
		<script type="text/javascript" src="../JavaScript/Effects.js"></script>
		<script type="text/javascript" src="../JavaScript/Utility/checkValidity.js"></script>
		<script type="text/javascript" src="../JavaScript/Layout/Popups.js"></script>
		<link rel="shortcut icon" type="image/x-icon" href="../Immagini/Icons/logo-title-Bayahibe.ico">
		<link rel="stylesheet" href="../css/bayahibe.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../css/Popup.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../css/Header.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../css/Footer.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../css/home.css" type="text/css" media="screen"> 
		<link rel="stylesheet" href="../css/Struttura.css" type="text/css" media="screen"> 
		<title>Bayahibe::Home</title>
		</head>
	<body 
			<?php if ( isset ($_GET['errorMessage']) ) 
					echo 'onLoad = "showPopup(\'Login\'); Slider.initialize(\'Home\', 5) "';
				 else if ( isset ($_GET['SignUpNewsletterOk']) )
					echo 'onLoad = "showPopup(\'Message\', \' Iscrizione alla Newsletter effettuata \', true ); Slider.initialize(\'Home\', 5) "';
				 else if ( isset ($_GET['SignUpNewsletterFailed']) )
					echo 'onLoad = "showPopup(\'Message\', \' Iscrizione alla Newsletter già effettuata o fallita\', false ); Slider.initialize(\'Home\', 5) "';
				else if ( isset ($_GET['NewsletterSent']) )
					echo 'onLoad = "showPopup(\'Message\', \' Newsletter inviata con successo\', true ); Slider.initialize(\'Home\', 5) "';
				else 
					echo ' onLoad = "Slider.initialize(\'Home\', 5)" ';?> >
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
			include DIR_LAYOUT . "PopupMessage.php";
		?>
		<main id = "MoveOnScroll">
			<script type="text/javascript" src="../JavaScript/Layout/HeaderEvents.js"></script>
			<section class = "slider_section" >
				<div id = "Slider_quote"><h2> La Calabria sembra essere stata creata da un Dio capriccioso che, dopo aver creato diversi mondi, si è divertito a mescolarli insieme.<br><cite> Guido Piovene </cite> </h2></div> 
				<img id = "current_image" src = "../Immagini/Gallery/Home/Home-image-0.jpg" alt = "home image not found" >
				<img id = "next_image_left" src = "../Immagini/Gallery/Home/Home-image-0.jpg"  alt = "home image not found" > 
				<img id = "next_image_right" src = "../Immagini/Gallery/Home/Home-image-0.jpg"  alt = "home image not found" >
				<img id = "next_image_top" src = "../Immagini/Gallery/Home/Home-image-0.jpg" alt = "home image not found" > 
				<img id = "next_image_bottom" src = "../Immagini/Gallery/Home/Home-image-0.jpg"  alt = "home image not found" >
				<nav id = "console_wrapper"> 
				</nav>
			</section>
			<div class = "description_container_left"> 
				<a href = "./Prenotazioni.php">
					<img class = "img_struttura" src = "../immagini/Struttura/Stabilimento-Struttura.jpg" alt = "Stabilimento non trovato"> </a>
				<div class = "article_container">
					<article> 
						<h2> Orari </h2>
						<p> Lo stabilimento balneare <em> Bayahibe </em> sarà aperto dal 01/05/17 al 30/09/17, tutti i giorni dalle ore 8:00 alle ora 20:00. Che aspettate a prenotare un ombrellone e a vivere insieme a noi una vacanza indimenticabile.<br> <a href= "./Prenotazioni.php" > Prenota ora! </a>  </p>
					</article>
				</div>
			</div>
			<div class = "description_container_right"> 
					<a href = "./Contattaci.php">
						<img class = "img_struttura" src = "../immagini/Struttura/Partenza.jpg" alt = "Spiaggia non trovata"> 
					</a>
					<div class = "article_container">
						<article> 
							<h2> Dove siamo  </h2>
							<p> Tra Tropea e Capo Vaticano, nella località di Santa Domenica di Ricadi c’è la bellissima Baia di Riaci. Una incantevole spiaggia circondata da pareti stratificate di arenaria gialla, ricche di fossili.<br>
								<a href = "./Contattaci.php"> Scopri ora come raggiungerci! </a></p>
						</article>
					</div>
				</div>
			<?php include DIR_LAYOUT . "Footer.php"; ?>
		</main>
	</body>
</html>