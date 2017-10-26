<?php
	session_start();
	
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTILITY . "UmbrellaDBManager.php";
	require_once DIR_UTILITY . "Session.php";
	require_once DIR_AJAX . "AjaxResponse.php";
	
	
	$response = new AjaxResponse();
	
	if (!isset($_GET['Type']) ||!isset($_GET['fromDate']) || !isset($_GET['toDate']) || !isset($_GET['CarParking']) 
		|| !isset($_GET['MotoParking']) || !isset($_GET['BeachLounger']) || !isset($_GET['Cabin']) || !isset($_GET['Cabinet']) || sizeof($_GET['JSONSelectedUmbrellas']) == 0 ) {
		echo json_encode($response);
		return;
	}	
	
	$Type = $_GET['Type'];
	$fromDate = $_GET['fromDate'];
	$toDate = $_GET['toDate'];
	$CarParking = $_GET['CarParking'];
	$MotoParking = $_GET['MotoParking'];
	$BeachLounger = $_GET['BeachLounger'];
	$Cabin = $_GET['Cabin'];
	$Cabinet = $_GET['Cabinet'];
	$JSONSelectedUmbrellas = json_decode($_GET['JSONSelectedUmbrellas'], true);
	
	for ( $i=0, $size = sizeof($JSONSelectedUmbrellas); $i < $size;  $i++ ) {
		$Number = $JSONSelectedUmbrellas[$i]; 
		$result = reserveUmbrella( $Number, $Type, $fromDate, $toDate, $CarParking, $MotoParking, $BeachLounger, $Cabin, $Cabinet );
		if ( !$result ) {
			$response = InvalidInsert();
			echo json_encode($response);
			return;
		}
	}
	
	$message = "OK";	
	$response = new AjaxResponse("0", $message);
	echo json_encode($response);
	return;
	
	function invalidInsert() {
		$message = "Invalid Insert";
		return new AjaxResponse("-1", $message);
	}	