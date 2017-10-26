<?php
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTILITY . "BayahibeDbManager.php";
	require_once DIR_UTILITY . "Session.php";
	require_once DIR_UTILITY . "UserInformation.php";
	
	session_start();
	$UserID = $_SESSION['userId'];
	$result = getUserInformation( $UserID );
	
	$Name = $_POST['Name'] ;
	$Surname = $_POST['Surname']; 
	$Email = $_POST['Email'] ;
	$Gender = $_POST['Gender'] ;
	$BirthDate = $_POST['BirthDate'] ;
	$NewPassword = $_POST['newPassword'] ;
	$oldPassword = $_POST['oldPassword'];
	
	
	if ( $Name . $Surname . $Email . $Gender . $BirthDate . $NewPassword == NULL )
		header('location: ../Profile.php?Vuoto');
	
	if ( $_POST['Email'] != NULL ) $checkNewEmail = CheckNewEmail($Email);
	
	$errorMessage = ApplyUserChanges($UserID, $Name, $Surname, $Email, $Gender, $BirthDate, $NewPassword );
	
    if ( $oldPassword != $result['Password']) 
		header('location: ../Profile.php?Password');
	else if ( $checkNewEmail ) 
		header('location: ../Profile.php?Email');
	else if ( !$errorMessage ) 
		header('location: ../Profile.php?Errore');
	else 
		header('location: ../Profile.php?Avviso');
	

	function CheckNewEmail($Email) {
		global $BayahibeDB;
		
		$Query =	' SELECT * '
				.	' FROM User'
				.	' WHERE `Email` = ' . $Email;
				
		$resultQuery = $BayahibeDB -> performQuery($Query);		
		$BayahibeDB -> closeConnection();
		
		if (  mysqli_num_rows($resultQuery) > 0 )
			return false;
		return true;
		
	}

	function ApplyUserChanges($UserID, $Name, $Surname, $Email, $Gender, $BirthDate, $NewPassword ) {
		global $BayahibeDB;
		
		$UserID = $BayahibeDB->sqlInjectionFilter($UserID);
		$Name = $BayahibeDB->sqlInjectionFilter($Name);
		$Surname = $BayahibeDB->sqlInjectionFilter($Surname);
		$Email = $BayahibeDB->sqlInjectionFilter($Email);
		$Gender = $BayahibeDB->sqlInjectionFilter($Gender);
		$BirthDate = $BayahibeDB->sqlInjectionFilter($BirthDate);
		$NewPassword = $BayahibeDB->sqlInjectionFilter($NewPassword);
		
		$Query =	'UPDATE User SET ';
		$Query = $Name != NULL? $Query . ' `Name` = \'' .$Name . ' \' ' : $Query . '';  
		$Query = $Surname != NULL? $Query . ' `Surname` = \''.$Surname.'\'': $Query . ''; 
		$Query = $Email != NULL? $Query . ' `Email` = \'' .$Email.'\'': $Query . '';  
		$Query = $Gender != NULL? $Query . ' `Gender` = \'' .$Gender.'\'': $Query . '';  
		$Query = $BirthDate != NULL? $Query . ' `Birth Date` = \'' .$BirthDate.'\'': $Query . ''; 
		$Query = $NewPassword != NULL? $Query . ' `Password` = \'' .$NewPassword.'\'': $Query . '';  
		$Query = $Query . ' WHERE `UserID` = '. $UserID;
		
		$result = $BayahibeDB -> performQuery($Query);		
		$BayahibeDB -> closeConnection();
		return $result;
	}
	
