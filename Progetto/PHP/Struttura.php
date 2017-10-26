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
		<script type="text/javascript" src="./../JavaScript/Effects.js"></script>
		<script type="text/javascript" src="../JavaScript/AJAX/Signer.js"></script>
		<script type="text/javascript" src="../JavaScript/AJAX/AjaxManager.js"></script>
		<script type="text/javascript" src="./../JavaScript/Utility/checkValidity.js"></script>
		<script type="text/javascript" src="./../JavaScript/Effects.js"></script>
		<script type="text/javascript" src="./../JavaScript/Layout/Popups.js"></script>
		<link rel="stylesheet" href="./../css/bayahibe.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/Struttura.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/Header.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/Footer.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/Popup.css" type="text/css" media="screen">
		<title>Bayahibe::Struttura</title>
	</head>
	<body>
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
			include DIR_LAYOUT ."PopupMessage.php";
			include DIR_LAYOUT . "Header.php";
		
		?>
		<main id = "MoveOnScroll">
		<script type="text/javascript" src="../JavaScript/Layout/HeaderEvents.js"></script>
			<div id = "focus_effect_Popup"> </div>
			<script type="text/javascript" src="../JavaScript/AJAX/Validator.js"></script>
			<script type="text/javascript" src="../JavaScript/Layout/Popups.js"></script>
			<div class = "description_container_left"> 
				<img class = "img_struttura" src = "../immagini/Struttura/Stabilimento-Struttura.jpg" alt = "Stabilimento non trovato"> 
				<div class = "article_container">
					<article> 
						<h2> Lo Stabilimento </h2>
						<p> Lo stabilimento balneare <em> Bayahibe </em> offre una vacanza indimenticabile ai propri clienti. 
							Situato proprio di fronte alla spiaggia a 3km da Tropea, il Bagno si affaccia sulla bellissima Baia di Riaci,
							dando l'occasione di ammirare lo spendido paesaggio. La struttura è composta da 20 cabine, 30 armadietti di sicurezza, 
							un ampio parcheggio, sia per le automobili che per i motocicli, e un fantastico Ristorante Bar</p>
					</article>
				</div>
			</div>
			<div class = "description_container_right"> 
				<a href = "./Prenotazioni.php">
					<img class = "img_struttura" src = "../immagini/Struttura/Spiaggia-Struttura.jpg" alt = "Spiaggia non trovata"> 
				</a>
				<div class = "article_container">
					<article> 
						<h2> La Spiaggia </h2>
						<p> La nostra magnifica spiaggia, setacciata e ripulita ogni giorno,
							è divisa in 5 file per un totale di 45 ombrelloni disposti a una distanza minima tra di loro,
							in modo da garantire la massima comodità ai nostri ospiti, il tutto sotto gli occhi vigili dei nostri Bagnini
							<a href = "./Prenotazioni.php"> Prenota ora la tua vacanza! </a></p>
					</article>
				</div>
			</div>
			<div class = "description_container_left"> 
				<a href = "./Menù.php">
					<img class = "img_struttura" src = "../immagini/Struttura/Ristorante-Struttura.jpg" alt = "Ristorante non trovato">
				</a>
				<div class = "article_container">
					<article> 
						<h2> Il Ristorante Bar </h2>
						<p> Qualità e freschezza sono le caratteristiche che contraddistinguono il nostro Ristorante da sempre. Situato all'aperto,
							potrete gustare il pesce delle nostre coste con una vista mozzafiato, il tutto condito con una piacevole musica di sottofondo.<br>
							<a href = "./Ristorante.php"> Scopri ora la nostra Cucina! </a></p>
					</article>
				</div>
			</div>
			<div class = "description_container_right"> 
					<img class = "img_struttura" src = "../immagini/Struttura/BeachVolley-Struttura.jpg" alt = "BeachVolley non trovato"> 
				<div class = "article_container">
					<article> 
						<h2> Lo Sport </h2>
						<p> Per coloro che non riescono a stare fermi nemmeno in vacanza, 
							il Bagno <em> Bayahibe </em> dispone di un campo di Beach volley, con la possibilità di iscriversi a numerosi tornei 
							per ogni fascia di età. 
							</p>
					</article>
				</div>
			</div>
			<section  class = "Price_section">
				<table class = "Price_table">
					<caption> <h2 id= "Tariffe">  Listino Prezzi </h2>  </caption>
					<thead>
						<tr> <th style ="border: 0px"> </th> <th colspan = "2"> Intero </th> <th colspan = "2" > Mattina </th> <th colspan = "2" > Pomeriggio </th> </tr>
					</thead>
					<tbody>
						<tr> <th> Fila Ombrelloni </th> <th> 1°-2° </th> <th> 3°-5° </th><th> 1°-2° </th><th> 3°-5° </th><th> 1°-2° </th><th> 3°-5° </th>
						<tr> <th> Bassa Stagione </th> <td> 15€ </td> <td> 13€ </td> <td> 8€ </td><td> 6€ </td><td> 10€ </td><td> 8€ </td>
						<tr> <th> Alta Stagione </th> <td> 20€ </td> <td> 18€ </td> <td> 13€ </td><td> 11€ </td><td> 15€ </td><td> 13€ </td>
						<tr> <th> Parcheggio auto </th> <td colspan ="2"> 5€ </td> <td colspan ="2"> 2€ </td><td colspan ="2"> 3€ </td>
						<tr> <th> Parcheggio moto </th> <td colspan ="2"> 4€ </td> <td colspan ="2"> 1€ </td><td colspan ="2"> 2€ </td>
						<tr> <th> Lettino </th> <td colspan ="2"> 10€ </td> <td colspan ="2"> 5€ </td><td colspan ="2"> 7€ </td>
						<tr> <th> Cabina </th> <td colspan ="2"> 10€ </td> <td colspan ="2"> 5€ </td><td colspan ="2"> 7€ </td>
						<tr> <th> Armadietto </th> <td colspan ="2"> 2€ </td> <td colspan ="2"> 2€ </td><td colspan ="2"> 2€ </td>
						<tr> <th colspan = "6"> Noleggio Imbarcazioni </th> <th> Durata </th>
						<tr> <th> Canoa Singola </th> <td colspan = "5"> 7€ </td> <td rowspan = "3"> 1 Ora </td> 
						<tr> <th> Canoa Doppia </th> <td colspan = "5"> 10€ </td> 
						<tr> <th> Pedalò </th> <td colspan = "5"> 15€ </td> 
						<tr> <th> Banana Boat </th> <td colspan = "5"> 10€ (a persona)</td> <td> 20 Minuti </td>
					</tbody>
				</table>
			</section>
			<?php include DIR_LAYOUT . "Footer.php"; ?>
		</main>
	</body>
</html>	