<?php 
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTILITY . "BayahibeDbManager.php";
		
	$Email = $_POST['Newsletter'];
	$result = SignUpNewsletter($Email);
	
	
	if ( $result && isset($_POST['NewsletterFooter'])) { //Solo se la registrazione è stata fatta tramite la form nel footer e non durante la registrazione dell'utente
		header('location: ../Home.php?SignUpNewsletterOk');
		return;
	} else if ( isset($_POST['NewsletterFooter']) ) {
		header('location: ../Home.php?SignUpNewsletterFailed');	
		return;
	}
	
	function SignUpNewsletter( $Email ) {
		global $BayahibeDB;
		
		$Email = $BayahibeDB->sqlInjectionFilter($Email);
		
		$Query =	 ' INSERT INTO `Newsletter`'
					.' (`Email`) VALUE ( \'' . $Email . '\')';
		
		$result = $BayahibeDB -> performQuery($Query);		
		$BayahibeDB -> closeConnection();
		return $result;
	}
	
?>