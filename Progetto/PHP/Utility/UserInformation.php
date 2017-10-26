<?php

	function authenticate ( $username, $password ) {
		
		global $BayahibeDB;
		
		$username = $BayahibeDB->sqlInjectionFilter($username);
		$password = $BayahibeDB->sqlInjectionFilter($password);
		
		$findUser = " SELECT *
					  FROM user 
					  WHERE username = '" . $username ."' AND password = '". $password ."'";
					  
		$result = $BayahibeDB->performQuery($findUser);
		$numRow = mysqli_num_rows($result);
		if ($numRow == 0)
			return 0;
		
		$BayahibeDB->closeConnection();
		$userRow = $result->fetch_assoc();
		return $userRow['UserID'];
	}

	function getUserInformation( $userId ) {
		global $BayahibeDB;
		
		$userId = $BayahibeDB->sqlInjectionFilter($userId);
		$query = ' SELECT *
				   FROM User 
				   WHERE UserID = ' . $userId ;
				  
		$result = $BayahibeDB->performQuery($query);
		$BayahibeDB->closeConnection();
		$userRow = $result->fetch_assoc();
		return $userRow;
		
	}
	

	function printUserinformation($UserID) {
		
		$Informations = getUserInformation($_SESSION['userId']);
		$Stats = getReservationStats($UserID);
		
		//Contenitore Avatar e form per la modifica dell'immagine
		echo '<div id = "left_box" > <div id = "avatar_container"> ';
		echo '<img src = "../immagini/Backgrounds/reflex-icon.png" id = "reflex-icon" alt = "" >';
		echo '<img id = "profile_avatar" src="data:image/jpeg;base64,'.base64_encode( $Informations['Avatar'] ).'" alt = ""> </div>';
		echo '<div id = "form_avatar_container"> <form method = "POST" enctype = "multipart/form-data" action = "./Utility/ProfileChangeImage.php" >';
		echo '<input type = "file" name = "Avatar" id = "select_avatar"> <input type = "submit" value = "Conferma" class = "change_profile_button" > </form> </div> </div>';
		
		//Tabella con le informazioni dell'utente
		echo '<div id = "form_container">';
		echo '<table class = "profile_table" > <tbody id = "removeChild" ><th id = "user_table_header" colspan = "2"> '. $Informations['Username'] .'</th> ';
		echo '<tr> <th> Nome: </th> <td class = "changeThis"> ' . $Informations['Name'] . '</td></tr>';
		echo '<tr> <th> Cognome: </th> <td class = "changeThis"> ' . $Informations['Surname'] . '</td></tr>';
		echo '<tr> <th> Email: </th> <td class = "changeThis"> ' . $Informations['Email'] . '</td></tr>';
		echo '<tr><th> Sesso: </th> <td class = "changeThis"> ' . $Informations['Gender'] . '</td></tr>';
		echo '<tr><th> Data di Nascita: </th> <td class = "changeThis"> ' . $Informations['Birth Date'] . '</td></tr> ';
		echo '<tr ><th> Prenotazioni: </th> <td> ' . $Stats['Reservations'] . '</td></tr>';	
		echo '<tr><th> Lettini: </th> <td> ' . $Stats['BeachLoungers'] . '</td></tr>';	
		echo '<tr><th> Parcheggi Auto: </th> <td> ' . $Stats['CarPark'] . '</td></tr>';		
		echo '<tr><th> Parcheggi Moto: </th> <td> ' . $Stats['MotoPark'] . '</td></tr>';
		echo '<tr><th> Cabine: </th> <td> ' . $Stats['Cabins'] . '</td></tr>';
		echo '<tr><th> Armedietti: </th> <td> ' . $Stats['Cabinets'] . '</td></tr>';
		echo '<tr><th> Giorni Prenotati: </th> <td> ' . $Stats['TotalDays'] . '</td></tr> </tbody> </table> </div>';
		
	}

	
	function printUserReservation( $Username ) {
		
		if( isset($_GET['Username'])) {
			$Username = $_GET['Username'];
		}
		
		$OldResult = getOldReservation($Username); //Prenotazioni trascorse
		$NewResult = getNewReservation($Username); //Prenotazioni ancora non trascorse
		//Header		
		echo ' <table class = "User_Reservation_Table"> <thead><tr> <th> Da: </th> <th> A: </th><th> Tipo </th> <th> Ombrelloni </th> <th> Parcheggio Auto </th> ';
		echo ' <th> Parcheggio Moto </th> <th> Lettino </th> <th> Cabina </th> <th> Armadietto </th><th> Modifica </th></tr></thead><tbody> ';
		
		//Ogni riga è una prenotazione 
		if ( mysqli_num_rows($OldResult) == 0 && mysqli_num_rows($NewResult) == 0 )
			echo '<tr> <td colspan = "10"><h2> Nessuna Prenotazione Effettuata </h2></td> </tr></tbody> </table>';
		else {
			if ( mysqli_num_rows($OldResult) > 0 ) {
				while ( $OldReservation = $OldResult->fetch_assoc() ) {
					echo '<tr class = "OldReservation"> <td>'. $OldReservation['fromDate'] .'</td>';
					echo '<td>'. $OldReservation['toDate'] .'</td>';
					$Type = $OldReservation['Type'] == "Daily" ? "Intero": ( $OldReservation['Type'] == "Morning"? "Mattina": "Pomeriggio" ); 
					$BeachLounger = $OldReservation['Beach Lounger']? "Si":"No";
					$CarParking = $OldReservation['Car Parking']? "Si":"No";
					$MotoParking = $OldReservation['Moto Parking']? "Si":"No";
					$Cabin = $OldReservation['Cabin']? "Si":"No";
					$Cabinet = $OldReservation['Cabinet']? "Si":"No";
					echo '<td>'. $Type .'</td>';
					echo '<td>'. $OldReservation['Umbrellas'] .'</td>';
					echo '<td>'. $BeachLounger .'</td>';
					echo '<td>'. $CarParking .'</td>';
					echo '<td>'. $MotoParking .'</td>';
					echo '<td>'. $Cabin .'</td>';
					echo '<td>'. $Cabinet .'</td>';
					echo '<td> <input type = "button" value = "Modifica" disabled> </td></tr>';
				}
			} 
			if ( mysqli_num_rows($NewResult) > 0 ) {
				while ( $NewReservation = $NewResult->fetch_assoc() ) {
					echo '<tr class = "NewReservation"> <td>'. $NewReservation['fromDate'] .'</td>';
					echo '<td>'. $NewReservation['toDate'] .'</td>';
					$Type = $NewReservation['Type'] == "Daily" ? "Intero" : ( $NewReservation['Type'] == "Morning"? "Mattina":"Pomeriggio" );
					$BeachLounger = $NewReservation['Beach Lounger']? "Si":"No";
					$CarParking = $NewReservation['Car Parking']? "Si":"No";
					$MotoParking = $NewReservation['Moto Parking']? "Si":"No";
					$Cabin = $NewReservation['Cabin']? "Si":"No";
					$Cabinet = $NewReservation['Cabinet']? "Si":"No";
					echo '<td>'. $Type .'</td>';
					echo '<td>'. $NewReservation['Umbrellas'] .'</td>';
					echo '<td>'. $BeachLounger .'</td>';
					echo '<td>'. $CarParking .'</td>';
					echo '<td>'. $MotoParking .'</td>';
					echo '<td>'. $Cabin .'</td>';
					echo '<td>'. $Cabinet .'</td>';
					echo '<td> <input type = "button" value = "Modifica" onclick = "ChangeUserReservation( \''.$Username.'\',\''.$Type.'\',\''.$NewReservation['fromDate'].'\',\''.$NewReservation['Umbrellas'].'\')"> </td></tr>';
				}
			}
			echo '</tbody> </table>';
		}	
	}
?>