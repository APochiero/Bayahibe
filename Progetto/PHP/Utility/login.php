<?php
	require_once __DIR__ . "./../config.php";
	require_once DIR_UTILITY . "BayahibedbManager.php";
	require_once DIR_UTILITY . "Session.php";
	require_once DIR_AJAX . "AjaxResponse.php";
	require_once DIR_UTILITY . "UserInformation.php";


	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$errorMessage = login($username, $password);
	
	if($errorMessage == null) 
		header('location: ./../#');
	 else 
		header('location: ./../?errorMessage=' . $errorMessage );
		
	function login($username, $password){  
		
		if ( isset($_COOKIE['userAuthentication'] ) ) {	
			$userInfo = explode(";", $_COOKIE['userAuthentication'] );
			session_start();
			setSession($userInfo[0],$userInfo[1]);
			return null;
		} else if ($username != null && $password != null ) {
			$UserID = authenticate($username, $password);
    		if ($UserID > 0) {
    			session_start();
    			setSession( $username, $UserID );
				setcookie( "CurrentUser", $username,0, "/" );
				if( isset( $_POST['ricordami']) )
					setcookie( "userAuthentication", $username.";".$UserID, time() + 86400*30, "/" );
				return null;
			} else 
				return 'Username or Password not valid';
    	}
	}
	
	
?>
	