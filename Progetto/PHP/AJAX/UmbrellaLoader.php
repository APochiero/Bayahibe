<?php
	session_start();
	
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTILITY . "UmbrellaDBManager.php";
	require_once DIR_UTILITY . "Session.php";
	require_once DIR_AJAX . "AjaxResponse.php";
	
	$response = new AjaxResponse();
	
	if (!isset($_GET['searchType']) ||!isset($_GET['fromDate']) || !isset($_GET['toDate'])){
		echo json_encode($response);
		return;
	}	
	
	$searchType = $_GET['searchType'];
	$fromDate = $_GET['fromDate'];
	$toDate = $_GET['toDate'];
	
	switch ( $searchType ) { 
		case 'Daily':
			$result = getDayUmbrella( $fromDate, $toDate ); break;
		case 'Morning':
			$result = getMorningUmbrella( $fromDate, $toDate ); break;
		case 'Afternoon':
			$result = getAfternoonUmbrella( $fromDate, $toDate ); break;
		default:
			$result = null;
		break;
	}
	
	if ( mysqli_num_rows($result) == 0 ){
		$response = setEmptyResponse();
		echo json_encode($response);
		return;
	}
	
	$message = "OK";	
	$response = setResponse($result, $message);
	echo json_encode($response);
	return;
	
	function setEmptyResponse(){
		$message = "No umbrella to load";
		return new AjaxResponse(-1, $message);
	}
	
	function setResponse ( $result, $message ) {
		$response = new AjaxResponse(0, $message);
			
		$index = 0;
		$UsernameLogged = '';
		if ( isLogged() ) {
			$UsernameLogged = $_SESSION['username'];
		}
		
		while ( $row = $result->fetch_assoc() ) { // Per ogni ombrellone trovato creo un nuovo oggetto Umbrella e lo inserisco nel campo data del response
			
			$Username = $row['Username'];
			$Number = $row['BUNumber'];
			$State = null;
			
			if ( $Username == $UsernameLogged ) 
				$State = 'userUmbrella';
			else 
				$State = 'reserved';
			
			$umbrella = new Umbrella( $Username, $Number, $State ); 
			
			$response->data[$index] = $umbrella; 
			$index++;
		}
		return $response;
	}
	