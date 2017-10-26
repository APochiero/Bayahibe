<?php
	session_start();
	require_once __DIR__ . "/config.php";
    require_once DIR_UTILITY . "Session.php";
	require_once DIR_UTILITY . "BayahibedbManager.php";
	require_once DIR_UTILITY . "UserInformation.php";
?>

<!DOCTYPE html>
<html lang = "it">
	<head>
		<meta charset="utf-8"> 
    	<meta name = "author" content = "Progettazione WEB">
    	<meta name = "keywords" content = "bayahibe, lido, baia di riaci">	
		<script type="text/javascript" src="./../JavaScript/AJAX/ajaxManager.js"></script>
		<script type="text/javascript" src="./../JavaScript/AJAX/Signer.js"></script>
		<script type="text/javascript" src="./../JavaScript/Utility/checkValidity.js"></script>
		<script type="text/javascript" src="./../JavaScript/Effects.js"></script>
		<script type="text/javascript" src="./../JavaScript/ReviewList.js"></script>
		<script type="text/javascript" src="./../JavaScript/Review.js"></script>
		<script type="text/javascript" src="./../JavaScript/AJAX/ReviewLoader.js"></script>
		<script type="text/javascript" src="./../JavaScript/AJAX/UserReviewInteraction.js"></script>
		<script type="text/javascript" src="./../JavaScript/Layout/Popups.js"></script>
		<link rel="shortcut icon" type="image/x-icon" href="../Immagini/Icons/logo-title-Bayahibe.ico">
		<link rel="stylesheet" href="./../css/bayahibe.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/Header.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/Footer.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/Popup.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/Recensioni.css" type="text/css" media="screen">
		<title>Bayahibe::Recensioni</title>
	</head>
	<body onLoad = "ReviewList.loadReviews()" >
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
			include DIR_LAYOUT . "Header.php"; ?>
		<main id = "MoveOnScroll">
		<script type="text/javascript" src="../JavaScript/Layout/HeaderEvents.js"></script>
			<h1 id = "Recensioni"> Recensioni </h1>
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
			<div class = "article_container">
				<p> Scopri quello che le persone dicono di noi! Ogni recensione ci aiuta a crescere e a migliorare i nostri servizi. <br>
					<a href = "<?php if (!isLogged()) echo 'javascript: showPopup(\'Login\')' ?>"> Dì la tua anche tu!</a> </p>
			</div>
			<?php if ( isLogged() ) 
					include DIR_LAYOUT . "NewReview.php"; ?>
			<?php include DIR_LAYOUT . "Footer.php"; ?>		
		</main>
	</body>
</html>