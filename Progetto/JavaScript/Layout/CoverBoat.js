function showCoverBoat(boat) {
	var cover = document.getElementsByClassName("cover_boat");
	
	cover[boat].style.display = "block";
	
}

function hideCoverBoat(boat) {
	var cover = document.getElementsByClassName("cover_boat");
	
	cover[boat].style.display = "none";
	
}