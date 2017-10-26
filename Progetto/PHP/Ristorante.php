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
		<link rel="stylesheet" href="../css/Ristorante.css" type="text/css" media="screen"> 
		<title>Bayahibe::La nostra Cucina</title>
		</head>
	<body onLoad = "Slider.initialize('Ristorante', 8)" >
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
			<div class = "restaurant_container">
				<div class = "restaurant_article">
					<aside class = "slider_section" >
						<img id = "current_image" src = "../Immagini/Gallery/Ristorante/Ristorante-image-0.jpg" alt = "restaurant image not found" >
						<img id = "next_image_left" src = "../Immagini/Gallery/Ristorante/Ristorante-image-0.jpg"  alt = "restaurant image not found" > 
						<img id = "next_image_right" src = "../Immagini/Gallery/Ristorante/Ristorante-image-0.jpg"  alt = "restaurant image not found" >
						<img id = "next_image_top" src = "../Immagini/Gallery/Ristorante/Ristorante-image-0.jpg" alt = "restaurant image not found" > 
						<img id = "next_image_bottom" src = "../Immagini/Gallery/Ristorante/Ristorante-image-0.jpg"  alt = "restaurant image not found" >
						<nav id = "console_wrapper"> </nav>
					</aside>
					<h2> La Nostra Cucina </h2>
					<p> La nostra cucina è in continua ricerca di materie prime per ideare menù e sapori raffinati.<br>
						L’attenzione nella preparazione e nella presentazione delle portate rendono il vostro menù speciale e di alta qualità.<br> Prevediamo alternative ad ogni portata per ospiti vegetariani, vegani, intolleranze alimentari, allergie o altre diverse esigenze con notevole attenzione e professionalità. </p>
						
					<h2> L’aperitivo </h2>
					<p> Ricco e completo di ogni qualità di pesce, è il nostro aperitivo, nel quale potrete ammirare la minuziosità nell’organizzazione e nella disposizione dei vari Finger-Food. <br>Ostriche, Salmone, Sushi, Pesce Spada marinato e Tonno Affumicato, sono solo alcune delle ottime specialità che vi proponiamo in occasione del vostro ricevimento.<br> Inoltre dedichiamo un’area alla consumazione dei rustici e di tutte le pietanze calde. </p>
					
					<h2> Il Gran Buffet di Dolci e Frutta </h2>
					<p> Gustosi e invitanti sono i buffet dolci e frutta che la location è in grado di offrire. <br> Specializzati infatti nella realizzazione di una notevole varietà di dolci, nonché della torta nuziale, frutto dell’abilità e della maestria dei nostri pasticceri.<br> Il tutto abbinato all’eleganza  e alla sontuosità degli scenari all’aperto e non, in cui i buffet vengono allestiti. </p>
				</div>
			</div>
			<?php include DIR_LAYOUT . "Footer.php"; ?>
		</main>
	</body>
</html>