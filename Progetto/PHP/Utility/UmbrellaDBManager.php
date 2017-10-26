<?php
	
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTILITY . "BayahibeDbManager.php";
		 
	function getDayUmbrella ( $fromDate, $toDate ){  
		global $BayahibeDB;
		
		$fromDate = $BayahibeDB->sqlInjectionFilter($fromDate);
		$toDate = $BayahibeDB->sqlInjectionFilter($toDate);
		
		$queryText = ' SELECT Username, BUNumber ' 
					.' FROM `Reservation` INNER JOIN `User` ON `UserBU` = `UserID` '
					.' WHERE fromDate <= \''. $toDate .'\' AND toDate >= \''. $fromDate . '\' '
					.' ORDER BY BUNumber';
		
		$result = $BayahibeDB->performQuery($queryText);
		$BayahibeDB->closeConnection();
		return $result; 
	}
	
		function getMorningUmbrella( $fromDate, $toDate ) {  
		global $BayahibeDB;
		
		$fromDate = $BayahibeDB->sqlInjectionFilter($fromDate);
		$toDate = $BayahibeDB->sqlInjectionFilter($toDate);
		
		$queryText = ' SELECT Username, BUNumber ' 
					.' FROM `Reservation` INNER JOIN `User` ON `UserBU` = `UserID` '
					.' WHERE ( Type = \'Morning\' OR Type = \'Daily\' )'
					.' AND fromDate <= \''. $toDate .'\' AND toDate >= \''. $fromDate . '\' '
					.' ORDER BY BUNumber';
						
		$result = $BayahibeDB->performQuery($queryText);
		$BayahibeDB->closeConnection();
		return $result; 
	}
	
	function getAfternoonUmbrella( $fromDate, $toDate ) {  
		global $BayahibeDB;
		
		$fromDate = $BayahibeDB->sqlInjectionFilter($fromDate);
		$toDate = $BayahibeDB->sqlInjectionFilter($toDate);
		
		$queryText = ' SELECT Username, BUNumber ' 
					.' FROM `Reservation` INNER JOIN `User` ON `UserBU` = `UserID` '
					.' WHERE ( Type = \'Afternoon\' OR Type = \'Daily\' ) '
					.' AND fromDate <= \''. $toDate .'\' AND toDate >= \''. $fromDate . '\' '
					.' ORDER BY BUNumber';
						
		$result = $BayahibeDB->performQuery($queryText);
		$BayahibeDB->closeConnection();
		return $result; 
	}
	
	
	function reserveUmbrella( $Number, $Type, $fromDate, $toDate, $CarParking, $MotoParking, $BeachLounger, $Cabin, $Cabinet ) {
		global $BayahibeDB;
		
		$userID = $_SESSION['userId'];
		$userID = $BayahibeDB->sqlInjectionFilter($userID);
		$Number = $BayahibeDB->sqlInjectionFilter($Number);
		$Type = $BayahibeDB->sqlInjectionFilter($Type);
		$fromDate = $BayahibeDB->sqlInjectionFilter($fromDate);
		$toDate = $BayahibeDB->sqlInjectionFilter($toDate);
		$CarParking = $BayahibeDB->sqlInjectionFilter($CarParking);
		$MotoParking = $BayahibeDB->sqlInjectionFilter($MotoParking);
		$BeachLounger = $BayahibeDB->sqlInjectionFilter($BeachLounger);
		$Cabin = $BayahibeDB->sqlInjectionFilter($Cabin);
		$Cabinet = $BayahibeDB->sqlInjectionFilter($Cabinet);
		
		$queryText = ' INSERT INTO Reservation (`fromDate`, `toDate`, `Type`, `BUNumber`, `UserBU`, `Beach Lounger`, `Car Parking`, `Moto Parking`, `Cabin`, `Cabinet`)'
					.' VALUES ( ' 
					.' \'' . $fromDate .'\', '
					.' \'' . $toDate .'\', '
					.' \'' . $Type .'\', '
					.' \'' . $Number .'\', '
					.' \'' . $userID .'\', '
					.' \'' . $BeachLounger .'\', '
					.' \'' . $CarParking .'\', '
					.' \'' . $MotoParking .'\', '
					.' \'' . $Cabin .'\', '
					.' \'' . $Cabinet .'\') ';
		
		$result = $BayahibeDB->performQuery($queryText);
		$BayahibeDB->closeConnection();
		return $result; 		
	}
	
	function cancelUmbrella( $Username,  $Number, $Type, $fromDate ) {
		global $BayahibeDB;
		
		$Username = $BayahibeDB->sqlInjectionFilter($Username);
		$Number = $BayahibeDB->sqlInjectionFilter($Number);
		$Type = $BayahibeDB->sqlInjectionFilter($Type);
		$fromDate = $BayahibeDB->sqlInjectionFilter($fromDate);
		
		$Query = ' DELETE FROM `Reservation`'
				.' WHERE `UserBU` IN ( SELECT `UserID` 
										 FROM `User`
										 WHERE `Username` = \''. $Username . '\') AND '
				.' `BUNumber` = '. $Number .' AND `Type` = \''. $Type .'\' AND `fromDate` = \''. $fromDate .'\'';

		$result = $BayahibeDB->performQuery($Query);
		$BayahibeDB->closeConnection();
		return $result; 	
	}
	
	function getToDate( $Username, $SelectedUmbrella, $Type, $fromDate ) {
		global $BayahibeDB;
		
		$Username = $BayahibeDB->sqlInjectionFilter($Username);
		$SelectedUmbrella = $BayahibeDB->sqlInjectionFilter($SelectedUmbrella);
		$Type = $BayahibeDB->sqlInjectionFilter($Type);
		$fromDate = $BayahibeDB->sqlInjectionFilter($fromDate);
		
		$Query = 'SELECT toDate '
				.'FROM `Reservation` INNER JOIN `User` ON `UserBU` = `UserID` '
				.'WHERE `Username` = \''. $Username .'\' AND `BUNumber` = '. $SelectedUmbrella .' AND `Type` = \''. $Type .'\' AND `fromDate` = \''. $fromDate .'\'';
	
		$result = $BayahibeDB->performQuery($Query);
		$BayahibeDB->closeConnection();
		return $result; 		
	}
	
	function getReservation( $Username, $Type, $fromDate, $toDate ) {
		global $BayahibeDB;
		
		$Username = $BayahibeDB->sqlInjectionFilter($Username);
		$Type = $BayahibeDB->sqlInjectionFilter($Type);
		$fromDate = $BayahibeDB->sqlInjectionFilter($fromDate);
		$toDate = $BayahibeDB->sqlInjectionFilter($toDate);
		
		$Query = 'SELECT `BUNumber` '
				.'FROM `Reservation` INNER JOIN `User` ON `UserBU` = `UserID` '
				.'WHERE `Username` = \''. $Username .'\' AND `Type` = \''. $Type  .'\' AND `fromDate` = \''. $fromDate .'\' AND `toDate` = \''. $toDate .'\'';
		
		$result = $BayahibeDB->performQuery($Query);
		$BayahibeDB->closeConnection();
		return $result; 	
	}
?>
	
	