<script type="text/javascript" src="../JavaScript/Utility/Cookie.js"></script>
<header id = "header">
	<div id = "container">  
		<ul id = "navlist">
			<li class = "navelement" >
				<a  class = "link_header" href = "./Home.php" > Home </a>
			</li>
			<li class = "navelement" onmouseover = " showSubMenu('bagno') " onmouseout = "hideSubMenu('bagno')" >
				<a  class = "link_header" href = "./Struttura.php" > Il Bagno </a>
				<ul id = "sub_menu_bagno" class = "sub_menu">
					<li class = "sub_element">
						<a class = "link_header" href = "./Struttura.php"> La Struttura </a>
					</li>
					<li class = "sub_element">
						<a class = "link_header" href = "./Ristorante.php"> Ristorante </a>
					</li>
					
					<li class = "sub_element">
						<a class = "link_header" href = "./Struttura.php#Tariffe"> Tariffe 2017 </a>
					</li>
					<li class = "sub_element">
						<a class = "link_header" href = "./Recensioni.php"> Recensioni </a>
					</li>
					<li class = "sub_element">
						<a class = "link_header" href = "./Regolamento.php"> Regolamento </a>
					</li>
				</ul>
			</li>
			<li class = "logo_header">
				<a href = "./Home.php" > 
					<img  id = "logo_bayahibe"src = "../immagini/Icons/logo-bayahibe.png" alt = "logo-Bayahibe not found">
				</a>
			</li>
			<li class = "navelement" id = "Menu" onmouseover = " showSubMenu('menu') " onmouseout = "hideSubMenu('menu')" >
				<a  class = "link_header" > Menu </a>
				<ul id = "sub_menu_menu" class = "sub_menu">
					<li class = "sub_element">
						<a  class = "link_header" href = "./Home.php" > Home </a>
					</li>
					<li class = "sub_element" onmouseover = " showSubMenu('menu_bagno') " onmouseout = "hideSubMenu('menu_bagno')">
						<a  class = "link_header" href = "./Struttura.php" > Il Bagno </a>
						<ul id = "sub_menu_menu_bagno" class = "sub_menu">
							<li class = "sub_element">
								<a class = "link_header" href = "./Struttura.php"> La Struttura </a>
							</li>
							<li class = "sub_element">
								<a class = "link_header" href = "./Menù.php"> Ristorante </a>
							</li>
							
							<li class = "sub_element">
								<a class = "link_header" href = "./Struttura.php#Tariffe"> Tariffe 2017 </a>
							</li>
							<li class = "sub_element">
								<a class = "link_header" href = "./Recensioni.php"> Recensioni </a>
							</li>
							<li class = "sub_element">
								<a class = "link_header" href = "./Regolamento.php"> Regolamento </a>
							</li>
						</ul>
					</li>
					<li class = "sub_element">
						<a  class = "link_header" href = "./Prenotazioni.php" > Prenotazioni </a>
					</li>
					<li class = "sub_element">
						<a  class = "link_header" href = "./Contattaci.php"> Contattaci </a>
					</li>
				</ul>
			</li>
			<li class = "navelement">
				<a class = "link_header" href = "./Prenotazioni.php"> Prenotazioni </a>
			</li>
			<li class = "navelement">
				<a  class = "link_header"  href = "./Contattaci.php" > Contattaci </a>
			</li>
			<?php
			if ( !isLogged() ){
				
			}
			?>				
		</ul>
		<?php
			require_once DIR_UTILITY . "Userinformation.php";
			if ( isLogged() ) {
				$data = getUserInformation( $_SESSION['userId']);
				echo '<div onmouseover = " showSubMenu(\'profile\') " onmouseout = "hideSubMenu(\'profile\')" id = "user_profile_header"> ';
				echo '<a href = "./Profile.php"  class = "link_header">' . $_SESSION['username'] . '</a>';
				echo '<img class = "user_avatar" src="data:image/jpeg;base64,'.base64_encode( $data['Avatar'] ) . '" alt = "" >';
				echo '<ul id = "sub_menu_profile" class = "sub_menu" > ';
				echo '<li class = "sub_element">';
				if ( $_SESSION['userId'] > 1 ) {
					echo '<a class = "link_header" href = "./Profile.php">Profilo</a> </li>';
					echo '<li class = "sub_element">
							<a class = "link_header" href = "./Profile.php?Change"> Modifica Profilo</a> </li>';
				} else 
					echo '<a class = "link_header" href = "./Gestione.php">Gestione</a> </li>';
				
					echo '<li class = "sub_element">
						<a class = "link_header" href = "./Utility/logout.php"> Logout </a> </li>';
			} else {
				echo '<div id = "user_profile_header"> ';
				echo '	<a class = "link_header" href= "javascript:showPopup(\'Login\')"> Accedi </a>';
				echo '	<img class = "user_avatar" src = "../immagini/Icons/login-icon.png" alt = "login_icon not found"> ';
				echo '</div> '; 
			}
			
		?>
	</div>
</header>