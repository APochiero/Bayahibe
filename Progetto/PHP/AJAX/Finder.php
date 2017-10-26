<?php
	session_start();
	
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTILITY . "UmbrellaDBManager.php";
	require_once DIR_UTILITY . "Session.php";
	require_once DIR_AJAX . "AjaxResponse.php";
	
	
	$response = new AjaxResponse();
	
	if ( !isset($_GET['Username'] ) || !isset($_GET['SelectedUmbrella'] ) || !isset($_GET['Type'] ) || !isset($_GET['fromDate']) ) {
		echo json_encode($response);
		return;
	}
	
	$Username = $_GET['Username'];
	$SelectedUmbrella = $_GET['SelectedUmbrella'];
	$Type = $_GET['Type'];
	$fromDate = $_GET['fromDate'];
	$toDateResult = getToDate( $Username, $SelectedUmbrella, $Type, $fromDate );
	$toDate = $toDateResult->fetch_assoc();

	$result = getReservation( $Username, $Type, $fromDate, $toDate['toDate'] );
	
	if ( mysqli_num_rows( $result ) == 0 ) {
		$response = new AjaxResponse( -1, "Wrong Input");
		echo json_encode($response);
		return;
	}
	
	$response = setResponse( $result, $toDate );
	echo json_encode($response);
	return;	
	
	function setResponse($result, $toDate) {
		$response = new AjaxResponse("0", "OK" );
		$index = 0;
		while ( $Umbrellas = $result->fetch_assoc() ) {
			$response->data[$index] = $Umbrellas['BUNumber'];
			$index++;
		}
		$response->data[$index++] = $toDate['toDate'];
		return $response;
	}
	

	
	