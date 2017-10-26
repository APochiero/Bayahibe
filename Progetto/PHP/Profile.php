<?php
	session_start();
	if ( $_SESSION['userId'] == 1 ) 
		header('location: ./Gestione.php' );
	
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
		<script type="text/javascript" src="../JavaScript/AJAX/Validator.js"></script>
		<script type="text/javascript" src="../JavaScript/AJAX/Signer.js"></script>
		<script type="text/javascript" src="../JavaScript/effects.js"></script>
		<script type="text/javascript" src="../JavaScript/Utility/checkValidity.js"></script>
		<script type="text/javascript" src="../JavaScript/Layout/ChangeUserInformation.js"></script>
		<script type="text/javascript" src="./../JavaScript/ReviewList.js"></script>
		<script type="text/javascript" src="./../JavaScript/Review.js"></script>
		<script type="text/javascript" src="./../JavaScript/AJAX/ReviewLoader.js"></script>
		<script type="text/javascript" src="./../JavaScript/AJAX/UserReviewInteraction.js"></script>
		<link rel="shortcut icon" type="image/x-icon" href="../Immagini/Icons/logo-title-Bayahibe.ico">
		<link rel="stylesheet" href="../css/bayahibe.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../css/Header.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../css/Footer.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../css/Popup.css" type="text/css" media="screen">
		<link rel="stylesheet" href="../css/Profile.css" type="text/css" media="screen"> 
		<link rel="stylesheet" href="../css/Recensioni.css" type="text/css" media="screen"> 
		<title>Bayahibe::Profilo</title>
	</head>
	<body onLoad = "ReviewList.TYPE = 1; ReviewList.AMOUNT = 5; ReviewList.loadReviews();  <?php 
		if(isset($_GET['Change']))
			echo 'ChangeUserInformation()'; 
		else if (isset($_GET['Password']) )
			echo 'showPopup(\'Message\', \'Password Errata!\', false)';
		else if (isset($_GET['Email']) )
			echo 'showPopup(\'Message\', \'Email già in uso!\', false)';
		else if (isset($_GET['Errore']) )
			echo 'showPopup(\'Message\', \'Si è verificato un errore\', false)';
		else if (isset($_GET['Vuoto']) )
			echo 'showPopup(\'Message\', \'Nessuna Modifica da apportare\', false)';
		else if (isset($_GET['Avviso']) )
			echo 'showPopup(\'Message\', \'Modifiche apportate con successo!\', true)'; 
		?>   ">
		<?php		
			if ( !isLogged() ) {
				header('location: ./Home.php');
			}
			include DIR_LAYOUT . "Header.php";
			include DIR_LAYOUT . "PopupMessage.php";
		?>
		<main id = "MoveOnScroll">
			<script type="text/javascript" src="../JavaScript/Layout/HeaderEvents.js"></script>
			<script type="text/javascript" src="../JavaScript/Layout/Popups.js"></script>
			<section class = "profile_info"> 
				<div class = "profile_container">
					<h1> Profilo Utente </h1>
					<?php  printUserInformation($_SESSION['userId']); ?>
				</div>
			</section>
			<section>
				<div class = "User_Reservation_container">
					<h1> Prenotazioni Effettuate </h1>
					<?php  printUserReservation($_SESSION['username']); ?>
				</div>
			</section>
			<section>
				<nav class = "Review_Sorting_Nav"> 
					<label> Ordina per:
						<select name = "SortBy" onchange = "ReviewList.Sort()">
							<option value = "ReviewDate"> Data Recensione </option>
							<option value = "Likes"> Mi Piace </option>
							<option value = "Dislikes"> Non Mi Piace </option>
							<option value = "Vote"> Voto </option>
						</select>
					 </label> 
					<label> Visualizza: 
						<select name = "View" onchange = "ReviewList.Sort()">
							<option value = "DESC"> Decrescente </option>
							<option value = "ASC"> Crescente </option>
						</select>
					</label>
				</nav>
				<ul class = "Review_List" > 
					<!-- Riempita con Ajax -->
				</ul>
				<div id = "showMoreReview">
					<a href = "javascript: ReviewList.showMore()"> Mostra altri risultati </a>
				</div>
			</section>
			<?php include DIR_LAYOUT . "Footer.php"; ?>
		</main>
	</body>
</html>
		