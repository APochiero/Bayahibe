<?php
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTILITY . "BayahibeDbManager.php";
	require_once DIR_UTILITY . "UserInformation.php";
	
	function getReview( $Type, $Amount ){  //Seleziono le recensioni dell'utente loggato se il tipo == 1 altrimenti di tutti, senza superare il valore di $Amount
		global $BayahibeDB;
		
		$Type = $BayahibeDB->sqlInjectionFilter($Type);
		$Amount = $BayahibeDB->sqlInjectionFilter($Amount);
		
		$Query = 	 'SELECT * '
					.'FROM `Review`';
		
		if ( $Type == 1 ) 
			$Query = $Query .' WHERE `Author` = '. $_SESSION['userId'];
	
		$Query .= ' ORDER BY `Review Date` DESC';
		$Query .= ' LIMIT '. $Amount;
		
		
		$result = $BayahibeDB->performQuery($Query);
		$BayahibeDB->closeConnection();

		return $result; 
	}
	
	function getUsersReviewInteraction( $IDReview, $Preference ) { //Conto i "mi piace" se $Preference == 1 e i "non mi piace" se $Preference == 0
		global $BayahibeDB;
		
		$IDReview = $BayahibeDB->sqlInjectionFilter($IDReview);
		$Preference = $BayahibeDB->sqlInjectionFilter($Preference);
		
		$Query =	 'SELECT COUNT(*) AS Preference '
					.'FROM `UserReview` '
					.'WHERE `IDReview` = ' . $IDReview . ' AND  `Preference` = ' . $Preference;
		$result= $BayahibeDB->performQuery($Query);
		$BayahibeDB->closeConnection();
		return $result; 
	}
	
	function getCurrentUserInteraction( $IDReview ) { //Seleziono l'interazione dell'utente loggato con la recensione
		global $BayahibeDB;
		
		$IDReview = $BayahibeDB->sqlInjectionFilter($IDReview);
		
		$Query =	 'SELECT Preference '
				    .'FROM `UserReview` '
				    .'WHERE `IDReview` = '. $IDReview .' AND `IDUser` = ' . $_SESSION['userId'];
	
		$result = $BayahibeDB->performQuery($Query);
		$BayahibeDB->closeConnection();
		return $result;
	}
	
	function getAuthorInformation( $Author ) {
		
		$result = getUserInformation($Author);		
		$information = Array('Author' => $result['Username'], 'Avatar' => $result['Avatar'] );
		
		return $information;
		
	}
	
	function insertReview( $Title, $Vote, $Text, $Author ) {
		global $BayahibeDB;
		
		$Title = $BayahibeDB->sqlInjectionFilter($Title);
		$Vote = $BayahibeDB->sqlInjectionFilter($Vote);
		$Text = $BayahibeDB->sqlInjectionFilter($Text);
		$Author = $BayahibeDB->sqlInjectionFilter($Author);
		$Date = date("Y-m-d");

		$Query = 	 'INSERT INTO `Review`( `Title`, `Vote`, `Text`, `Review Date`, `Author` )'
					.'VALUES ( '
					.' \'' . $Title .'\', '
					.' \'' . $Vote .'\', '
					.' \'' . $Text .'\', '
					.' \'' . $Date .'\', '
					.' \'' . $Author .'\')';
		
		$result = $BayahibeDB->performQuery($Query);
		$BayahibeDB->closeConnection();
		return $result;		
	}
	
	
	function updatePreferenceUserReviewStat($ReviewID, $UserID, $Preference) {
		global $BayahibeDB;
		
		$ReviewID = $BayahibeDB->sqlInjectionFilter($ReviewID);
		$UserID = $BayahibeDB->sqlInjectionFilter($UserID);
		$Preference = $BayahibeDB->sqlInjectionFilter($Preference);
		
		$Query =	 ' UPDATE `UserReview`'
					.' SET `Preference` = '. $Preference 
					.' WHERE `IDUser` = ' . $UserID . ' AND `IDReview` = ' . $ReviewID ;
		
		$result = $BayahibeDB->performQuery($Query);
		$BayahibeDB->closeConnection();
		return $result;				
					
	}
	
	 function insertPreferenceUserReviewStat($ReviewID, $UserID, $Preference) {
		global $BayahibeDB;
		
		$ReviewID = $BayahibeDB->sqlInjectionFilter($ReviewID);
		$UserID = $BayahibeDB->sqlInjectionFilter($UserID);
		$Preference = $BayahibeDB->sqlInjectionFilter($Preference);
		
		$Query =	 'INSERT INTO `UserReview` ( `IDUser`, `IDReview`, `Preference` )' 
					.' VALUES ( '.  $UserID . ', ' . $ReviewID . ', ' . $Preference .' )'; 
		
		$result = $BayahibeDB->performQuery($Query);
		$BayahibeDB->closeConnection();
		return $result;				
					
	 }