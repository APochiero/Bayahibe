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
    	<meta name = "keywords" content = "bayahibe, Bagno, baia di riaci">	
		<script type="text/javascript" src="./../JavaScript/AJAX/Signer.js"></script>
		<script type="text/javascript" src="./../JavaScript/Utility/checkValidity.js"></script>
		<script type="text/javascript" src="./../JavaScript/Effects.js"></script>
		<script type="text/javascript" src="./../JavaScript/Layout/Popups.js"></script>
		<link rel="shortcut icon" type="image/x-icon" href="../Immagini/Icons/logo-title-Bayahibe.ico">
		<link rel="stylesheet" href="./../css/bayahibe.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/Header.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/Footer.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/Popup.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/Regolamento.css" type="text/css" media="screen">
		<title>Bayahibe::Regolamento</title>
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
			include DIR_LAYOUT . "PopupMessage.php";
			include DIR_LAYOUT . "Header.php";
			
		?>
		<main id = "MoveOnScroll">
		<script type="text/javascript" src="../JavaScript/Layout/HeaderEvents.js"></script>
			<h1> Regolamento </h1>
			<article>
				<h2> Il Bagno è aperto al pubblico, per la balneazione, dalle ore 8:00 alle ore 20:00, dal 01/05 al 30/09. <br>
					La direzione del Bagno invita i suoi gentili clienti al rispetto delle regole sottostanti: </h2>
				<ul> 	
					<li> Dalle 13.00 alle 16.00 è vietato tenere acceso qualsiasi apparecchio di diffusione sonora sotto gli ombrelloni, 
					e dovrà essere rispettata rigorosamente la quiete;  </li>
					<li> E’ vietato condurre o far permanere all’interno del Bagno qualsiasi tipo di animale anche se munito di museruola 
					o guinzaglio; sono esclusi dal divieto i cani guida per i non vedenti e per il salvataggio; </li>
					<li> E’ vietato usare sapone o shampoo sotto la zona doccia; </li>
					<li> Le visite agli Ospiti devono essere autorizzate dalla Direzione del Bagno.  </li>
					<li> I bambini devono essere accompagnati ai servizi igienici, ai giochi ed in spiaggia da persona adulta.  </li>
					<li> Gli adulti sono responsabili del comportamento dei minori loro affidati; </li>
					<li> La Direzione si riserva il diritto di allontanare coloro che recano disturbo o danno all’interno del Bagno. </li>
					<li> Dietro le direttive delle capitanerie di porto, è vietato, salvo eccezioni consentite, giocare a pallone, a 
						racchettoni o altri giochi che possano in modo evidente disturbare i bagnanti. </li>
					<li> La direzione del Bagno non risponde di eventuali furti, sotto il posto ombrellone ed in tutto il perimetro del Bagno; </li>
					<li> Il servizio di salvataggio in mare è assicurato dalle ore 08:00 alle ore 12:30 e dalle ore 13:30 alle ore 20:00. </li>
					<li> E’ vietato sostare sull’arenile antistante gli ombrelloni con asciugamano ed altro; </li>
					<li> L’ombrellone può essere occupato fino ad un max di 4 persone; </li>
					<li> E’ vietato consumare cibi preparati sotto il proprio ombrellone; </li>
					<li> Le prenotazioni degli ombrelloni sono nominative, pertanto non è consentito l’uso a terzi; </li>
					<li> Le prenotazioni possono essere annullate con un anticipo di 3 giorni dalla prenotazione stessa. 
						 Una richiesta oltre questi termini non potrà essere presa in considerazione </li>
					<li> E’ vietato spostare lettini o sdraio da un ombrellone ad un altro. </li>
				</ul>
			</article>
			<?php include DIR_LAYOUT . "Footer.php"; ?>		
		</main>
	</body>
</html>