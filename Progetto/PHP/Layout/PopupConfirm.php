<div id = "PopupConfirm" class = "PopupConfirm">
	<h1 class = "PopupHeader"> Dettagli Prenotazione </h1>
	<hr>
	<form action = "javascript: hidePopup('Confirm'); showPopup('ConfirmPayment')" >
		<table class="details_table"> 
			<tr>
				<td> Da: </td> <td class = "detail"> </td>
			</tr>
			<tr>
				<td> A: </td> <td class = "detail"> </td> 
			</tr>
			<tr>
				<td> Tipologia: </td> <td class = "detail"> </td> 
			</tr>
			<tr>
				<td> Ombrelloni: </td> <td class = "detail"> </td> 
			</tr>
			<tr>
				<td> Parcheggio Auto: </td> <td class = "detail"> </td> 
			</tr>
			<tr>
				<td> Parcheggio Moto: </td> <td class = "detail"> </td> 
			</tr>
			<tr>
				<td> Lettino: </td> <td class = "detail"> </td> 
			</tr>
			<tr>
				<td> Cabina: </td> <td class = "detail"> </td> 
			</tr>
			<tr>
				<td> Armadietto: </td> <td class = "detail"> </td> 
			</tr>
			<tr>
				<td> Totale Costo: </td> <td class = "detail"> </td> 
			</tr>
		</table>
		<div class = "PopupButtons">
			<input type = "button" value = "Annulla" onclick = "hidePopup('Confirm')">
			<input type = "submit" value = "Paga Ora">
		</div>
	</form>
</div>