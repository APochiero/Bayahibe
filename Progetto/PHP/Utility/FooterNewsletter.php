<?php 
	require_once __DIR__ . "/../config.php";
	include DIR_UTILITY . "SignUpNewsletter.php";
	
	$Email = $_POST['Newsletter'];
	
	$ErrorMessage = SignUpNewsletter( $Email );
	
	if ( !$ErrorMessage ) 
		header ( 'location: ../Home.php?NewsletterError' );
	else
		header ( 'location: ../Home.php?NewsletterOk' );
	
	
?>