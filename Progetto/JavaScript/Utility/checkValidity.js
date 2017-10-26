function checkValidityDate(date)
{
    var matches = /^(\d{4})[-](\d{2})[-](\d{2})$/.exec(date); // YYYY-MM-DD
    if (matches == null) return false;
    var d = matches[3];
    var m = matches[2] - 1;
    var y = matches[1];
    var goodDate = new Date(y, m, d); // Data con parametri estratti da date
	var today = new Date( y, new Date().getMonth(), new Date().getDate() + 1 ); // Data di domani 

	//Se la data non è compresa tra aprile e ottobre oppure 
	if ( goodDate.getMonth()+1 > 9 || goodDate.getMonth()+1 < 5 ) 
		return false;

	return goodDate.getDate() == d &&
		goodDate.getMonth() == m &&
		goodDate.getFullYear() == y;
}


function checkValidityBirthDate(date)
{
    var matches = /^(\d{4})[-](\d{2})[-](\d{2})$/.exec(date);
    if (matches == null) return false;
    var d = matches[3];
    var m = matches[2] - 1;
    var y = matches[1];
    var SixteenYearsAgo = new Date(new Date().getTime() - 1000*60*60*24*365*16 - 4*24*60*60*1000); //16 anni e 4 giorni fa 
	var birthDate = new Date (y,m,d);
	if ( birthDate > SixteenYearsAgo )
		return false;

	return birthDate.getDate() == d &&
		birthDate.getMonth() == m &&
		birthDate.getFullYear() == y;
}

function checkValidityCancelReservation( BeachfromDate ) {
	var today = new Date();
	var matches = /^(\d{4})[-](\d{2})[-](\d{2})$/.exec(BeachfromDate);
	if (matches == null) return;
	var d = matches[3];
	var m = matches[2] - 1;
	var y = matches[1];
	var fromDate = new Date(y, m, d);
	var until = new Date( fromDate.getFullYear(), fromDate.getMonth(), fromDate.getDate() - 3 ); //3 giorni prima della prenotazione
	
	return today < until;
}