<?php
	
	require_once "BayahibedbManager.php";
	require_once "BayahibeStats.php";
	
	$today = date( 'D d M Y');
	
	$Name = isset($_POST['Name'])? $_POST['Name'] : null;
	$Surname =  isset($_POST['Surname'])? $_POST['Surname'] : null;
	$Email =  isset($_POST['Email'])? $_POST['Email'] : null;
	$Object = isset($_POST['Object'])? $_POST['Object'] : 'Bayahibe Newsletter';
	$BayahibeEmail = "progettopweb@gmail.com";	
	
	//Se le variabili post sono settate significa che si sta inviando un email dalla form della pagina Contattaci, altrimenti si tratta di Newsletter
	if ( $Name != null ) {
		$Message = $_POST['Message'] . "  \n From: ". $Name . ' ' . $Surname . ', ' . $today . ' \n Email: ' .  $Email;
		mail($BayahibeEmail, $Object, $Message );
		header('location: ../Contattaci.php?ok');
	} else {
		$header = "Content-Type: text/html; charset=UTF-8\r\n"; // Interprete HTML
		$Subscribers = getSubscribers(); 
		
		while ( $SendTo = $Subscribers->fetch_assoc() ) {
			$Message = "<!DOCTYPE html>
						<html>
							<head> <meta charset=\"utf-8\">  
							<style> 
										footer {
											background-color: rgb(24, 95, 125);
											color: white;
										}
										footer a { color:rgb(255, 128, 0); }
										footer p { text-align: center; }
										.footer_informations{
												position: relative;
												margin: 0 auto;
												width: 960px;
												height: 200px;
												padding: 50px;	
										 }
										
							</style>
						</head>
					<body>" . $_POST['Message'];
			$Footer = " <footer> 
						<div class = 'footer_informations'>
							<p> © 2014-2016 All Rights Reserved  <br> 
								Privacy Policy <br>
								Bayahibe. <br> Per maggiori informazioni sulla struttura, i servizi, il ristorante o le prenotazioni non esitate a contattarci.
								Saremo davvero lieti di rispondere alle vostre domande. <br>
								Telefono: +39 0966930043 / +39 0966937766 <br>
								Mobile: 3202459861 <br>
						</p>
						<address> Email: <a href = 'mailto:progettopweb@gmail.com' > info@Bayahibe.com </a> </address>
						<a href = \"localhost/Progetto/PHP/Utility/Unsubscribe.php?Email=" . $SendTo['Email'] . "\" > Unsubscribe </a>
						</div>
						</footer>
					</body>";
					
			$Message .= $Footer;
			mail($SendTo['Email'], $Object, $Message, $header  );
			header('location: ../Home.php?NewsletterSent');
		}
	
	}
?>
	
	