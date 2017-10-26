<?php
	session_start();
	require_once __DIR__ . "/config.php";
    require_once DIR_UTILITY . "Session.php";
	require_once DIR_UTILITY . "BayahibedbManager.php";
	require_once DIR_UTILITY . "UserInformation.php";
	require_once DIR_UTILITY . "BayahibeStats.php";
	
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
    	<meta name = "author" content = "Progettazione WEB">
    	<meta name = "keywords" content = "bayahibe, lido, baia di riaci">	
		<script type="text/javascript" src="../JavaScript/AJAX/ajaxManager.js"></script>
		<script type="text/javascript" src="../JavaScript/effects.js"></script>
		<script type="text/javascript" src="../JavaScript/Utility/checkValidity.js"></script>
		<script type="text/javascript" src="./../JavaScript/Layout/Popups.js"></script>
		<script type="text/javascript" src="../JavaScript/Layout/ChangeUserInformation.js"></script>
		<link rel="shortcut icon" type="image/x-icon" href="../Immagini/Icons/logo-title-Bayahibe.ico">
		<link rel="stylesheet" href="../css/bayahibe.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../css/Header.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../css/Footer.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../css/Popup.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../css/Profile.css" type="text/css" media="screen"> 
		<title>Bayahibe::Gestione</title>
	</head>
	<body>
		<?php		
			if ( !isLogged() ) {
				header('location: ./Home.php');
			}
			include DIR_LAYOUT . "Header.php";
			include DIR_LAYOUT . "PopupMessage.php";
		?>
		<main id = "MoveOnScroll">
			<script type="text/javascript" src="../JavaScript/Layout/HeaderEvents.js"></script>
			<section class = "profile_info"> 
				<div class = "profile_container">
					<h2> Statistiche Bayahibe </h2>
					<?php  printUserInformation(NULL); ?>
				</div>
			</section>
			<script type="text/javascript" src="../JavaScript/Layout/DrawGraph.js"></script>
			<section class = "Graph"> 
				<h2> Grafico Prenotazioni Mensili </h2>
				<canvas id = "Graph" height = 300 width = 800> 
					<?php  $result = getUmbrellaDaysByMonth();
						   $Array = Array(5);
						   $index = 0;
						   while ( $MonthUmbrella = $result->fetch_assoc() ) {
								$Array[$index] = $MonthUmbrella;
								$index++;
						   }	
						   echo '<script> window.onload = function() { drawGraph('. json_encode($Array) .'); } </script>'; ?>
				</canvas>
			</section>
			<section>
				<div class = "User_Reservation_container">
					<h2 id = "Target" > Cerca Prenotazione </h2>
					<form method = "GET" action = "./Gestione.php#Target">
						<label> Username: 
							<input type = "text" name = "Username"> </label>
						<input type = "submit" value = "Cerca">
					</form>
					<?php printUserReservation("") ?>
				</div>
			</section>
			<section> 
				<div class = "NewsletterSender_container">
				<h2> Invia Newsletter </h2>
				<form method = "POST" action = "./Utility/sendEmail.php"> 
					<p> Messaggio: </p>
					<textarea name = "Message" id= "contact_message" required> </textarea>
					<input type = "submit" value = "Invia">
				</form>
				</div>
			</section>
			<?php include DIR_LAYOUT . "Footer.php"; ?>
		</main>
	</body>
</html>