<div id = "PopupConfirmPayment" class = "PopupConfirm">
	<h1 class = "PopupHeader"> Effettua Pagamento </h1>
	<hr>
	<form action = "javascript: Beach.reserve(); " >
		<table class="details_table"> 
			<tr>
				<td> Username: </td> <td class = "detail_payment"> NULL </td>
			</tr>
			<tr>
				<td> Totale: </td> <td class = "detail_payment"> NULL </td> 
			</tr>
		</table>
		<input type = "radio" name = "PaymentMethod" value = "PayPal" checked = "checked" onclick = "hideCardsDetails()" >
		<img id = "paypal-icon" src = "../immagini/Icons/PayPal-icon.png" alt = "icon input not found">
		<input type = "radio" name = "PaymentMethod" value = "Cards" onclick = "showCardsDetails()">
		<img id = "cards-icon" src = "../immagini/Icons/Prepaid-Cards.png" alt = "icon input not found">
		<div id = "showIfCards">
			<h1> Dettagli Carta </h1>
			<label> Seleziona Carta
				<select>
					<option> VISA </option>
					<option> VISA Electron </option>
					<option> PostePay </option>
					<option> Mastercard </option>
					<option> American Express </option>
					<option> Maestro </option>
					<option> Carta Si </option>
				</select> 
			</label>	
			<div class = "popup_input">
				<input type = "text" placeholder = "Numero Carta" maxlength = 20> 
				<img class = "icon_input" src = "../immagini/Icons/credit-card-icon.png" alt = "icon input not found"> </img>
			</div>
			<div class = "popup_input">
				<input type = "text" placeholder = "Intestatario Carta">
				<img class = "icon_input" src = "../immagini/Icons/login-icon.png" alt = "icon input not found"> </img>
			</div>
			<div class = "popup_input">
				<input type = "text" placeholder = " Scadenza MM/YY" maxlength = 5>
				<img class = "icon_input" src = "../immagini/Icons/Calendar-icon.png" alt = "icon input not found"> </img>
			</div>
			<div class = "popup_input">
				<input type = "text" placeholder = "CVV" maxlength = 3>
				<img class = "icon_input" src = "../immagini/Icons/credit-card-icon.png" alt = "icon input not found"> </img>
			</div>
		</div>
		<div class = "PopupButtons">
			<input type = "button" value = "Annulla" onclick = "hidePopup('ConfirmPayment')">
			<input type = "submit" value = "Conferma">
		</div>
	</form>
</div>