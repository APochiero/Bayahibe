<?php
	session_start();
	
	require_once __DIR__ . "/../config.php";
	require_once DIR_AJAX . "AjaxResponse.php";
	require_once DIR_UTILITY . "Session.php";
	require_once DIR_UTILITY . "BayahibedbManager.php";
	require_once DIR_UTILITY . "UserInformation.php";
	
	$response = new AjaxResponse();
	
	if (!isset($_POST['Username']) || !isset($_POST['Name']) || !isset($_POST['Surname']) || !isset($_POST['Email']) || !isset($_POST['Password']) || !isset($_POST['BirthDate']) ) {
		echo json_encode($response);
		return;
	}	
	
	$Username = $_POST['Username'];
	$Name = $_POST['Name'];
	$Surname = $_POST['Surname'];
	$Email = $_POST['Email'];
	$Password = $_POST['Password'];
	$Gender = $_POST['Gender'];
	$BirthDate = $_POST['BirthDate'];
	$SignUpNewsletter = $_POST['Newsletter'] == 'true' ? true: false;
	$path = DIR_BASE . '../Immagini/Icons/login-icon.png';
	$Avatar = addslashes(file_get_contents( $path ) ) ; 

	$result = SignIn( $Username , $Name, $Surname, $Email, $Password, $Gender, $BirthDate );
	if ( $result ) {
		$message = "successfully completed registration";
		$response = new AjaxResponse("0", $message);
	
		$userId = authenticate ( $Username, $Password );
		setSession( $Username, $userId );
		setcookie( "CurrentUser", $Username,0, "/" );
		uploadAvatar($Avatar);
		
		if ( $SignUpNewsletter === true ) {
			$_POST['Newsletter'] = $Email;
			include DIR_UTILITY . "SignUpNewsletter.php";
		}
		
		echo json_encode($response) ;
		return;
	} else {
		$message = "registration failed";
		$response = new AjaxResponse("-1", $message);
		echo json_encode($response);
		return;
	}
	
	function SignIn( $Username , $Name, $Surname, $Email, $Password, $Gender, $BirthDate ) {
		global $BayahibeDB;
		$Username = $BayahibeDB->sqlInjectionFilter($Username);
		$Name = $BayahibeDB->sqlInjectionFilter($Name);
		$Surname = $BayahibeDB->sqlInjectionFilter($Surname);
		$Email = $BayahibeDB->sqlInjectionFilter($Email);
		$Password = $BayahibeDB->sqlInjectionFilter($Password);
		$Gender = $BayahibeDB->sqlInjectionFilter($Gender);
		$BirthDate = $BayahibeDB->sqlInjectionFilter($BirthDate);
		$TimeStamp = date('Y-m-d H:i:s');
		
		$queryText = 'INSERT INTO `user` (`UserID`, `Username`, `Name`, `Surname`, `Email`, `Password`, `Gender`, `Birth Date`, `Registration Date`) '
					.' VALUES ( \'\', ' 
					.' \'' . $Username .'\', '
					.' \'' . $Name .'\', '
					.' \'' . $Surname .'\', '
					.' \'' . $Email .'\', '
					.' \'' . $Password .'\', '
					.' \'' . $Gender .'\', '
					.' \'' . $BirthDate .'\', '
					.' \'' . $TimeStamp .'\') ';
					
		$result = $BayahibeDB->performQuery($queryText);
		$BayahibeDB->closeConnection();
		return $result; 			
	}
	
	function uploadAvatar($avatar) {
		
		global $BayahibeDB;
		
		$uploadQuery =  " UPDATE User 
						  SET Avatar = '" . $avatar .
						"' WHERE  UserID = '" . $_SESSION['userId'] . "'";
		$result = $BayahibeDB->performQuery($uploadQuery);
		$BayahibeDB->closeConnection();
		return $result;
	}
	