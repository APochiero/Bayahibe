<?php 
	
	function getReservationStats($userId) {
		global $BayahibeDB;
		
		$userId = $BayahibeDB->sqlInjectionFilter($userId);
		//Somma degli extra 
		$QuerySums = '	SELECT SUM(`Beach Lounger`) AS BeachLoungers, 
						SUM(`Car Parking`) AS CarPark, SUM(`Moto Parking`) AS MotoPark, 
						SUM(`Cabin`) AS Cabins,SUM(`Cabinet`) AS Cabinets
						FROM Reservation';
					if ( $userId != null )
						$QuerySums = $QuerySums . ' WHERE UserBU = '. $userId;
		//Numero di prenotazioni effettuate e Numero di giorni prenotati			
		$QueryDays = '	SELECT COUNT(*) AS Reservations, SUM(ReservationDays) AS TotalDays 
						FROM ( 	SELECT (DATEDIFF( toDate, fromDate ) + 1) AS ReservationDays
								FROM Reservation';
						if ( $userId != null )
							$QueryDays = $QueryDays . ' WHERE UserBU = '. $userId;	
						
						$QueryDays = $QueryDays . '	GROUP BY UserBU, toDate, fromDate, Type ) AS D';
		
		$result1 = $BayahibeDB->performQuery($QuerySums);
		$result2 = $BayahibeDB->performQuery($QueryDays);
		$BayahibeDB->closeConnection();

		$array1 = $result1->fetch_assoc();
		$array2 = $result2->fetch_assoc();
		$UserStatsRow = array_merge($array1, $array2);
		if ( $UserStatsRow['BeachLoungers'] == NULL )
			$UserStatsRow = array( "Reservations" => 0,"BeachLoungers" => 0,"CarPark" => 0,"MotoPark" => 0,"Cabins" => 0,"Cabinets" => 0,"TotalDays" => 0,  );
		
		return $UserStatsRow;		
	}
	
	
	function getOldReservation( $Username ) {
		global $BayahibeDB;
		
		$Username = $BayahibeDB->sqlInjectionFilter($Username);
		$today = Date("Y-m-d");
		
		$Query = ' SELECT `UserBU`,`fromDate`,`toDate`,`Type`, GROUP_CONCAT(`BUNumber` SEPARATOR \'-\' ) AS Umbrellas, `Beach Lounger`,`Car Parking`,`Moto Parking`,`Cabin`, `Cabinet`'
				.' FROM `reservation` INNER JOIN `User` ON `UserBU` = `UserID` '
				.' WHERE `Username` = \''. $Username .'\' AND `toDate` < \'' . $today . '\''
				.' GROUP BY `UserBU`,`fromDate`, `toDate`, `Type`';
	
		$result = $BayahibeDB->performQuery($Query);
		$BayahibeDB->closeConnection();
		return $result;
	}
	
	function getNewReservation( $Username ) {
		global $BayahibeDB;
		
		$Username = $BayahibeDB->sqlInjectionFilter($Username);
		$today = Date("Y-m-d");
		
		$Query = ' SELECT `UserBU`,`fromDate`,`toDate`,`Type`, GROUP_CONCAT(`BUNumber` SEPARATOR \'-\' ) AS Umbrellas, `Beach Lounger`,`Car Parking`,`Moto Parking`,`Cabin`, `Cabinet`'
				.' FROM `reservation` INNER JOIN `User` ON `UserBU` = `UserID` '
				.' WHERE `Username` = \''. $Username .'\' AND `toDate` > \'' . $today . '\''
				.' GROUP BY `UserBU`,`fromDate`, `toDate`, `Type`';
		
		$result = $BayahibeDB->performQuery($Query);
		$BayahibeDB->closeConnection();
		return $result;
	}
	
	function getUmbrellaDaysByMonth() {
		global $BayahibeDB;
		
		$Query = 'SELECT Name AS Month, IFNULL(SUM( DATEDIFF( LEAST(toDate, LAST_DAY(month.FirstDay)), GREATEST(fromDate, month.FirstDay)) + 1),0) AS UmbrellaDays
				  FROM  Reservation
				  RIGHT JOIN  month ON fromDate <= LAST_DAY(month.FirstDay) AND month.FirstDay <= toDate
				  GROUP BY month.FirstDay ';
					  
		$result = $BayahibeDB->performQuery($Query);
		$BayahibeDB->closeConnection();
		return $result;
	}

	function getSubscribers() {
		global $BayahibeDB;
		
		$Query = 'SELECT *
				  FROM `Newsletter`';
					  
		$result = $BayahibeDB->performQuery($Query);
		$BayahibeDB->closeConnection();
		return $result;
	}
		
	function Unsubscribe( $Email ) {
		global $BayahibeDB;
		
		$Email = $BayahibeDB->sqlInjectionFilter($Email);
		
		$Query = 'DELETE FROM `Newsletter`
				  WHERE `Email` = \''. $Email .'\'';
					  
		$result = $BayahibeDB->performQuery($Query);
		$BayahibeDB->closeConnection();
		return $result;
	}
	
?>