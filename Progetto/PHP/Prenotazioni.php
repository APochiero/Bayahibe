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
		<script type="text/javascript" src="./../JavaScript/AJAX/ajaxManager.js"></script>
		<script type="text/javascript" src="./../JavaScript/Umbrella.js"></script>
		<script type="text/javascript" src="./../JavaScript/Beach.js"></script>
		<script type="text/javascript" src="./../JavaScript/AJAX/UmbrellaLoader.js"></script>
		<script type="text/javascript" src="./../JavaScript/AJAX/Reserver.js"></script>
		<script type="text/javascript" src="./../JavaScript/AJAX/Finder.js"></script>
		<script type="text/javascript" src="./../JavaScript/AJAX/Canceler.js"></script>
		<script type="text/javascript" src="./../JavaScript/Layout/CoverBoat.js"></script>
		<script type="text/javascript" src="./../JavaScript/AJAX/Signer.js"></script>
		<script type="text/javascript" src="./../JavaScript/Utility/checkValidity.js"></script>
		<script type="text/javascript" src="./../JavaScript/Utility/Cookie.js"></script>
		<script type="text/javascript" src="./../JavaScript/Effects.js"></script>
		<script type="text/javascript" src="../JavaScript/AJAX/Validator.js"></script>
		<script type="text/javascript" src="./../JavaScript/Layout/Popups.js"></script>
		<link rel="shortcut icon" type="image/x-icon" href="../Immagini/Icons/logo-title-Bayahibe.ico">
		<link rel="stylesheet" href="./../css/bayahibe.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/Header.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/Footer.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/Popup.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./../css/Prenotazioni.css" type="text/css" media="screen"> 
		<link rel="stylesheet" href="./../css/InterfacciaSpiaggia.css" type="text/css" media="screen"> 
		<link rel="stylesheet" href="./../css/Imbarcazioni.css" type="text/css" media="screen"> 
		<title>Bayahibe::Prenotazioni</title>
	</head>
	<body
		<?php if ( isset($_GET['Username']) && isset($_GET['Type']) && isset($_GET['fromDate']) && isset($_GET['Umbrella']) ) { 
					echo 'onLoad = "Beach.initialize();';
					echo ' Beach.OnLoadSelectReservationtoModify(\''.$_GET['Username'] .'\',\''.$_GET['Type'] .'\',\''.$_GET['fromDate'] .'\','. $_GET['Umbrella'] . ')"';
			} else 
				echo 'onLoad = "Beach.initialize(); Beach.loadUmbrellas()"';
			?> >
			<?php
			if ( !isLogged() ) {
				if ( isset($_COOKIE['userAuthentication']) ) {	
					$userInfo = explode(";", $_COOKIE['userAuthentication'] );
					setSession($userInfo[0],$userInfo[1]);
				} else 	{
					include DIR_LAYOUT . "PopupLogin.php";
					include DIR_LAYOUT . "PopupSignIn.php";
				}
			} else {
				include DIR_LAYOUT . "PopupConfirm.php";
				include DIR_LAYOUT . "PopupConfirmCancel.php";
				include DIR_LAYOUT . "PopupConfirmPayment.php";
			}
			include DIR_LAYOUT . "PopupMessage.php";
			include DIR_LAYOUT . "Header.php";
			
		?>
		<main id = "MoveOnScroll">
			<script type="text/javascript" src="../JavaScript/Layout/HeaderEvents.js"></script>
			<div class = "manual_container"> 
				<article> 
					<h2> Prenotare un posto al mare non è mai stato così semplice!! </h2> 
					<div class = "manual">
						<p> Prenota ora la tua vacanza nel nostro fantastico Bagno tramite la <em>Spiaggia Interattiva</em>. 
							Seleziona le date della tua vacanza e scegli una tipologia di prenotazione tra: </p>
						<ul> 
							<li><strong>Intero</strong>: dalle ore 8:00 alle ore 20:00 </li>
							<li><strong>Mattina</strong>: dalle ore 8:00 alle ore 12:00 </li>
							<li><strong>Pomeriggio</strong>: dalle ore 14:00 alle ore 20:00 </li>
						</ul>
						<p> La Spiaggia Interattiva mostrerà lo stato degli ombrelloni della combinazione selezionata, in particolare: </p>
						<ul> 
							<li><img src = "../immagini/Icons/umbrella_available.png" alt = "Umbrella not found "><strong>Disponibile</strong> </li>
							<li><img src = "../immagini/Icons/umbrella_reserved.png" alt = "Umbrella not found "><strong> Prenotato</strong> </li>
							<li><img src = "../immagini/Icons/umbrella_selected.png" alt = "Umbrella not found "><strong> Selezionato</strong> </li>
							<li><img src = "../immagini/Icons/umbrella_user.png" alt = "Umbrella not found "> <strong>Il Mio Ombrellone</strong> </li>
							<li><img src = "../immagini/Icons/umbrella_toBeCanceled.png" alt = "Umbrella not found "> <strong>Da Annullare</strong> </li>
						</ul>
						<p> Arricchisci inoltre la tua permanenza con i servizi disponibili e conferma la prenotazione con il tasto <strong>Prenota</strong>.
							In caso di ripensamenti, basta selezionare la tipologia di prenotazione, il giorno di inizio e uno degli ombrelloni e verrano mostrati gli ombrelloni prenotati. Selezionare gli ombrelloni da annullare
							( selezionandoli tutti si annulla l'intera prenotazione ) e confermare con il tasto <strong>Cancella</strong> <br><em>-L'operazione può essere effettuata fino a 3 giorni prima della prenotazione stessa-</em> </p>
					</div>
				</article>
			</div>
			<div class="background_image_section">
				<section class = "map_section">
					<h2 id="Prenotazioni"> Prenotazioni </h2>
					<ul>
						<li id = "tab1" onclick = "exalt(1); Beach.loadUmbrellas()"> 
							<img id = "swatch_icon1" src = "./../immagini/Icons/intero.gif" alt = "swatch not found">
							<h3> Intero </h3>
						</li>
						<li id = "tab2"  onclick = "exalt(2); Beach.loadUmbrellas()" > 
							<img id = "swatch_icon2" src = "./../immagini/Icons/mattina.gif" alt = "swatch not found">
							<h3> Mattina </h3>
						</li>
						<li id = "tab3" onclick = "exalt(3); Beach.loadUmbrellas()"> 
							<img id = "swatch_icon3" src = "./../immagini/Icons/pomeriggio.gif" alt = "swatch not found">
							<h3> Pomeriggio </h3>
						</li>
						
						<li id = "map_box">	
							<div class = "header_map">
								<div class = "reservation_date">
									<h3> Seleziona il periodo: da     
										<input id = "reservation_from_date" type = "date"> 
										a
										<input id = "reservation_to_date" type = "date">
									</h3>
								</div>	
							</div>
							<div id = "map">
								<table id = "umbrella_grid">
								<tr>
									<td class = "umbrella_number"> 1 </td>
									<td class = "umbrella_number"> 2 </td>
									<td class = "umbrella_number"> 3 </td>
									<td class = "umbrella_number"> 4 </td>
									<td class = "umbrella_number"> 5 </td>
									<td class = "umbrella_number"> 6 </td>
									<td class = "umbrella_number"> 7 </td>
									<td class = "umbrella_number"> 8 </td>
									<td class = "umbrella_number"> 9 </td>
								</tr>
								<tr>
									<td id="umbrella1" class="umbrella_available" ></td>
									<td id="umbrella2" class="umbrella_available" ></td>
									<td id="umbrella3" class="umbrella_available" ></td>
									<td id="umbrella4" class="umbrella_available" ></td>
									<td id="umbrella5" class="umbrella_available" ></td>
									<td id="umbrella6" class="umbrella_available" ></td>
									<td id="umbrella7" class="umbrella_available" ></td>
									<td id="umbrella8" class="umbrella_available" ></td>
									<td id="umbrella9" class="umbrella_available" ></td>
								</tr>
								<tr>
									<td class = "umbrella_number"> 10 </td>
									<td class = "umbrella_number"> 11 </td>
									<td class = "umbrella_number"> 12 </td>
									<td class = "umbrella_number"> 13 </td>
									<td class = "umbrella_number"> 14 </td>
									<td class = "umbrella_number"> 15 </td>
									<td class = "umbrella_number"> 16 </td>
									<td class = "umbrella_number"> 17 </td>
									<td class = "umbrella_number"> 18 </td>
								</tr>
								<tr>
									<td id="umbrella10" class="umbrella_available" ></td>
									<td id="umbrella11" class="umbrella_available" ></td>
									<td id="umbrella12" class="umbrella_available" ></td>
									<td id="umbrella13" class="umbrella_available" ></td>
									<td id="umbrella14" class="umbrella_available" ></td>
									<td id="umbrella15" class="umbrella_available" ></td>
									<td id="umbrella16" class="umbrella_available" ></td>
									<td id="umbrella17" class="umbrella_available" ></td>
									<td id="umbrella18" class="umbrella_available" ></td>
								</tr>
								<tr>
									<td class = "umbrella_number"> 19 </td>
									<td class = "umbrella_number"> 20 </td>
									<td class = "umbrella_number"> 21 </td>
									<td class = "umbrella_number"> 22 </td>
									<td class = "umbrella_number"> 23 </td>
									<td class = "umbrella_number"> 24 </td>
									<td class = "umbrella_number"> 25 </td>
									<td class = "umbrella_number"> 26 </td>
									<td class = "umbrella_number"> 27 </td>
								</tr>
								<tr>
									<td id="umbrella19" class="umbrella_available" ></td>
									<td id="umbrella20" class="umbrella_available" ></td>
									<td id="umbrella21" class="umbrella_available" ></td>
									<td id="umbrella22" class="umbrella_available" ></td>
									<td id="umbrella23" class="umbrella_available" ></td>
									<td id="umbrella24" class="umbrella_available" ></td>
									<td id="umbrella25" class="umbrella_available" ></td>
									<td id="umbrella26" class="umbrella_available" ></td>
									<td id="umbrella27" class="umbrella_available" ></td>
								</tr>
								<tr>
									<td class = "umbrella_number"> 28 </td>
									<td class = "umbrella_number"> 29 </td>
									<td class = "umbrella_number"> 30 </td>
									<td class = "umbrella_number"> 31 </td>
									<td class = "umbrella_number"> 32 </td>
									<td class = "umbrella_number"> 33 </td>
									<td class = "umbrella_number"> 34 </td>
									<td class = "umbrella_number"> 35 </td>
									<td class = "umbrella_number"> 36 </td>
								</tr>
								<tr>
									<td id="umbrella28" class="umbrella_available" ></td>
									<td id="umbrella29" class="umbrella_available" ></td>
									<td id="umbrella30" class="umbrella_available" ></td>
									<td id="umbrella31" class="umbrella_available" ></td>
									<td id="umbrella32" class="umbrella_available" ></td>
									<td id="umbrella33" class="umbrella_available" ></td>
									<td id="umbrella34" class="umbrella_available" ></td>
									<td id="umbrella35" class="umbrella_available" ></td>
									<td id="umbrella36" class="umbrella_available" ></td>
								</tr>
								<tr>
									<td class = "umbrella_number"> 37 </td>
									<td class = "umbrella_number"> 38 </td>
									<td class = "umbrella_number"> 39 </td>
									<td class = "umbrella_number"> 40 </td>
									<td class = "umbrella_number"> 41 </td>
									<td class = "umbrella_number"> 42 </td>
									<td class = "umbrella_number"> 43 </td>
									<td class = "umbrella_number"> 44 </td>
									<td class = "umbrella_number"> 45 </td>
								</tr>
								<tr>
									<td id="umbrella37" class="umbrella_available" ></td>
									<td id="umbrella38" class="umbrella_available" ></td>
									<td id="umbrella39" class="umbrella_available" ></td>
									<td id="umbrella40" class="umbrella_available" ></td>
									<td id="umbrella41" class="umbrella_available" ></td>
									<td id="umbrella42" class="umbrella_available" ></td>
									<td id="umbrella43" class="umbrella_available" ></td>
									<td id="umbrella44" class="umbrella_available" ></td>
									<td id="umbrella45" class="umbrella_available" ></td>
								</tr>
								</table>
							</div>
							<script type="text/javascript" src="./../JavaScript/Layout/ChangeTab.js"></script>
							<div class = "extra" >
								<h3> Aggiungi alla tua prenotazione: </h3>
								<form> 
									<label class = "extra_item"> <input name = "extra_item_checkbox" type = "checkbox" > Parcheggio Auto </label>
									<label class = "extra_item"> <input name = "extra_item_checkbox" type = "checkbox" > Parcheggio Moto </label>
									<label class = "extra_item"> <input name = "extra_item_checkbox" type = "checkbox" > Lettino </label>
									<label class = "extra_item"> <input name = "extra_item_checkbox" type = "checkbox" > Cabina </label>
									<label class = "extra_item"> <input name = "extra_item_checkbox" type = "checkbox" > Armadietto </label>
								</form>
							</div>
							<form class = "Beach_form">
								<input class = "Cancel_button" formaction =  <?php if(isLogged()) 
														echo '"javascript: Beach.fillDetailsToBeCanceled()"';
													else 
														echo '"javascript: showPopup(\'Login\')"' ?> type = "submit" value = "Cancella"> 
								<input class = "Reserve_button" formaction =  <?php if(isLogged()) 
													echo '"javascript: Beach.fillDetails()"';
												else 
													echo '"javascript: showPopup(\'Login\')"' ?> type = "submit" value = "Prenota">
							</form>
						</li>
					</ul>
				</div>
			</section>
			<section> 
				<div class = "article_container">
					<article> 
						<h2> Aggiungi altro divertimento al divertimento ! </h2>
						<p> Vivi l'avventura di prendere il largo a bordo delle nostre imbarcazioni o un giro sulla movimentata <strong><em>Banana Boat</em></strong>. 
							Rivolgiti al personale dello Stabilimento <em> Bayahibe </em> per noleggiarle!  </p>
					</article>
				</div>
				<div class = "wrapper_boat"> 
					<table class = "boat_table">
						<tbody>
							<tr> <th> Pedalò </th> <th> Banana Boat </th></tr>
							<tr> <td> <div class = "box_boat" onmouseover = "showCoverBoat(0)" onmouseout = "hideCoverBoat(0)"> <div class = "cover_boat" > <h2>15€/1h Max 4 persone </h2> </div>
								<img src = "./../immagini/Imbarcazioni/imbarcazione1.png" alt = "boat not found"> </div> </td>
								 <td> <div class = "box_boat" onmouseover = "showCoverBoat(1)" onmouseout = "hideCoverBoat(1)"> <div class = "cover_boat" > <h2>10€/20m Max 5 persone</h2> </div>
								 <img src = "./../immagini/Imbarcazioni/imbarcazione4.png" alt = "boat not found"> </div> </td></tr>
							<tr> <th> Canona Singola </th> <th> Canoa Doppia </th></tr>
							<tr> <td> <div class = "box_boat" onmouseover = "showCoverBoat(2)" onmouseout = "hideCoverBoat(2)"> <div class = "cover_boat" > <h2>7€/1h </h2></div>
								<img src = "./../immagini/Imbarcazioni/imbarcazione3.png" alt = "boat not found"> </div> </td> 
								 <td> <div class = "box_boat" onmouseover = "showCoverBoat(3)" onmouseout = "hideCoverBoat(3)"> <div class = "cover_boat" > <h2>10€/1h </h2></div>
								 <img src = "./../immagini/Imbarcazioni/imbarcazione2.png" alt = "boat not found"> </div> </td> </tr>
						</tbody>		
					</table>
				</div>
			</section>	
			<?php include DIR_LAYOUT . "Footer.php"; ?>		
		</main>
	</body>
</html>