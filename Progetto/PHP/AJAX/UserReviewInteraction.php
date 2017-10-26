<?php
	session_start();
	
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTILITY . "Session.php";
	require_once DIR_UTILITY . "ReviewDBManager.php";
	require_once DIR_AJAX . "AjaxResponse.php";
	
	$response = new AjaxResponse();
	$message = "OK";
	
	if ( !isLogged() ) { 
		$message = "Not Logged";
		$response = new AjaxResponse( "1", $message );
		echo json_encode($response);
		return;
	}
	
	if( !isset( $_GET['ReviewID'] ) ) {
		echo json_encode($response);
		return;
	}
	
	$ReviewID = $_GET['ReviewID'];
	if( isset( $_GET['isLiked'] ) ) {
		$currentflag = $_GET['isLiked'];
		setPreferenceUserStat($ReviewID, $currentflag); 
		$response = setResponse($ReviewID, $message, $currentflag );
		echo json_encode($response);
		return;
	}	

	if( isset( $_GET['isDisliked'] ) ) {
		$currentflag = $_GET['isDisliked'];
		setPreferenceUserStat($ReviewID, $currentflag);
		$response = setResponse($ReviewID, $message, $currentflag );		
		echo json_encode($response);
		return;
	}	

	function setPreferenceUserStat($ReviewID, $Preference){  
		$UserReviewInteraction = getCurrentUserInteraction($ReviewID); //Cerco una precedente preferenza
		if( mysqli_num_rows($UserReviewInteraction) > 0 ) //Se non ho mai espresso la preferenza su quella recensione allora inserisco, altrimenti aggiorno 
			$result = updatePreferenceUserReviewStat($ReviewID, $_SESSION['userId'], $Preference);
		else
			$result = insertPreferenceUserReviewStat($ReviewID, $_SESSION['userId'], $Preference);
					  
		return $result;
	}
	
	function setResponse( $ReviewID, $message, $currentflag) {
		
		$response = new AjaxResponse("0", $message);
		
		$UserReviewLikes = getUsersReviewInteraction( $ReviewID, 1); //Conto i "Mi piace"
		$UserReviewDilikes = getUsersReviewInteraction( $ReviewID, 0); // Conto i "Non mi piace"
		$Likes = $UserReviewLikes->fetch_assoc();
		$Dislikes = $UserReviewDilikes->fetch_assoc();

		$response->data = Array( 'ReviewID' => $ReviewID, 'Preference' => $currentflag, 
								 'Likes' => $Likes['Preference'], 'Dislikes' => $Dislikes['Preference']  ); 
		
		return $response;
	}
	