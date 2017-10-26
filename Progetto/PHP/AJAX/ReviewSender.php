<?php
	session_start();
	
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTILITY . "ReviewDBManager.php";
	require_once DIR_UTILITY . "Session.php";
	require_once DIR_AJAX . "AjaxResponse.php";
	
	
	$response = new AjaxResponse();
	
	if (!isset($_GET['Title']) ||!isset($_GET['Vote']) || !isset($_GET['Text'])  ) {
		echo json_encode($response);
		return;
	}	
	
	$Title = $_GET['Title'];
	$Vote = $_GET['Vote'];
	$Text = $_GET['Text'];
	
	$result = insertReview( $Title, $Vote, $Text, $_SESSION['userId'] );
	
	if ( !$result ){
		$response = setInvalidInsert();
		echo json_encode($response);
		return;
	}
		
	$response = setResponse();
	echo json_encode($response);
	return;
	
	function setInvalidInsert(){
		$message = "Invalid Insert";
		return new AjaxResponse("-1", $message);
	}
	
	function setResponse() {
		$message = "Review Sent";
		return new AjaxResponse("0", $message);
	}