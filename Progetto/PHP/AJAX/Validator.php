<?php
	session_start();
	
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTILITY . "Session.php";
	require_once DIR_AJAX . "AjaxResponse.php";
	require_once DIR_UTILITY . "BayahibeDbManager.php";
	
	$response = new AjaxResponse();
	
	if (!isset($_GET['Element']) || !isset($_GET['Type']) ) {
		echo json_encode($response);
		return;
	}	
	
	$Element = $_GET['Element'];
	$Type = $_GET['Type'];
	
	$result = searchElement( $Element, $Type );
	$row = $result -> fetch_assoc();
	
	if ( $row['UserID'] > 0   ) { // Username o Email già registrati 
		$message = "already exists";
		$response = new AjaxResponse("-1", $message);
		echo json_encode($response);
		return;
	}	
	
	$message = "OK";	
	$response = new AjaxResponse("0", $message);
	echo json_encode($response);
	return;

	//Ricerca esistenza di utenti con i parametri forniti
	function searchElement ( $Element, $Type ){  
		global $BayahibeDB;
		$Element = $BayahibeDB->sqlInjectionFilter($Element);
		$Type = $BayahibeDB->sqlInjectionFilter($Type);
		$queryText = ' SELECT UserID' 
					.' FROM User '
					.' WHERE ' . $Type . '= \'' . $Element . '\' ';
					
		$result = $BayahibeDB->performQuery($queryText);
		$BayahibeDB->closeConnection();
		return $result; 
	}