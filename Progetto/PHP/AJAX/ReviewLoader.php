<?php
	session_start();
	
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTILITY . "Session.php";
	require_once DIR_UTILITY . "ReviewDBManager.php";
	require_once DIR_AJAX . "AjaxResponse.php";
	
	$response = new AjaxResponse();
	
	if ( !isset($_GET['Type']) || !isset($_GET['Amount'])){
		echo json_encode($response);
		return;
	}	
	
	$Type = $_GET['Type'];
	$Amount = $_GET['Amount'];
	

	$result = getReview( $Type, $Amount );
	
	if ( mysqli_num_rows($result) == 0 ){
		$response = setEmptyResponse();
		echo json_encode($response);
		return;
	}
	
	$message = "OK";	
	$response = setResponse( $result, $message);
	echo json_encode($response);
	return;
	
	function setEmptyResponse(){
		$message = "No reviews to load";
		return new AjaxResponse("-1", $message);
	}
	
	function setResponse ( $result, $message ) {
		$response = new AjaxResponse("0", $message);		
		$index = 0;
		
		while ( $Reviews = $result->fetch_assoc() )  { //Per ogni recensione trovata creo un oggetto Review e lo inserisco nel campo data della response
			
			$UserReviewLikes = getUsersReviewInteraction( $Reviews['IDReview'], 1);
			$UserReviewDilikes = getUsersReviewInteraction( $Reviews['IDReview'], 0);
			$Likes = $UserReviewLikes->fetch_assoc();
			$Dislikes = $UserReviewDilikes->fetch_assoc();
				
			$Author = getAuthorInformation($Reviews['Author']);
			
			$CurrentPreference = null; 
			if ( isLogged() ) { //Se sono loggato, prelevo la mia preferenza per la recensione
				$CurrentUserReviewInteraction = getCurrentUserInteraction( $Reviews['IDReview'] );
				if ( mysqli_num_rows($CurrentUserReviewInteraction ) > 0 ) { //Se esiste 
					$CurrentUserReviewInteraction = $CurrentUserReviewInteraction->fetch_assoc();
					$CurrentPreference = $CurrentUserReviewInteraction['Preference'];
				} //Altrimenti rimane nulla 
			}
			
			$review = new Review(	$Reviews['IDReview'], $Author['Author'], base64_encode($Author['Avatar']), $Reviews['Title'],
									$Reviews['Text'], $Reviews['Vote'], $Reviews['Review Date'], $CurrentPreference, 
									$Likes['Preference'], $Dislikes['Preference'] );
			
			$response->data[$index] = $review;
			$index++;
			
		}
		
		return $response;
	}
	
	