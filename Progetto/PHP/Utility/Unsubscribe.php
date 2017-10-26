<?php 
	require_once "BayahibedbManager.php";
	require_once "BayahibeStats.php";
	
	$Email = $_GET['Email'];
	
	$check = Unsubscribe($Email);
	if ( $check ) 
		header('location: ../Home.php?Unsubscribed');
?>