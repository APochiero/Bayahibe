<?php
	require_once __DIR__ . "./../config.php";
	require_once DIR_AJAX . "SignIn.php";
	session_start();

	if( !is_uploaded_file($_FILES['Avatar']['tmp_name']) OR $_FILES['Avatar']['error']>0  ) 
		header('location: ./../Profile.php?Vuoto');
	
	else {
		$avatar = addslashes(file_get_contents($_FILES['Avatar']['tmp_name']) ) ;
		
		$errorMessage = uploadAvatar($avatar);
		
		if (!$errorMessage)
			header('location: ./../Profile.php?Errore');
		else
			header('location: ./../Profile.php?Avviso');
			
	}
	
?>