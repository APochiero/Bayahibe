<div id = "PopupConfirmCancel" class = "PopupConfirm">
	<h1 class = "PopupHeader"> Annulla Prenotazione </h1>
	<hr>
	<form action = "javascript: Beach.cancel()" >
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
		</table>
		<div class = "PopupButtons">
			<input type = "button" value = "Annulla" onclick = "hidePopup('ConfirmCancel')">
			<input type = "submit" value = "Conferma">
		</div>
	</form>
</div>