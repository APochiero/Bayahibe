<?php
	session_start();
	
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTILITY . "UmbrellaDBManager.php";
	require_once DIR_UTILITY . "Session.php";
	require_once DIR_AJAX . "AjaxResponse.php";
	
	
	$response = new AjaxResponse();
	if ( !isset($_GET['Username'] ) || !isset($_GET['SelectedUmbrellas'] ) || !isset($_GET['Type'] ) || !isset($_GET['fromDate']) ) {
		echo json_encode($response);
		return;
	}
	
	$JSONSelectedUmbrellas = json_decode($_GET['SelectedUmbrellas'], true);
	$Type = $_GET['Type'];
	$Username = $_GET['Username'];
	$fromDate = $_GET['fromDate'];

	for ( $i=0, $size = sizeof($JSONSelectedUmbrellas); $i < $size;  $i++ ) {
		$Number = $JSONSelectedUmbrellas[$i]; 
		$result =	cancelUmbrella( $Username, $Number, $Type, $fromDate );
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
		$message = "Invalid Delete";
		return new AjaxResponse("-1", $message);
	}	