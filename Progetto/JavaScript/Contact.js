/*Eventi che gestiscono il comportamento del cursore sopra la mappa di google per evitare che mentre si esegue lo scroll della pagina e il cursore va sopra la mappa, si attivi l'evento per zoomare la mappa tramite la rotellina del mouse*/
function enableMouseOnMap() {
	var element = document.getElementById("map_container");
	
	element.style.pointerEvents= "none";
	element.style.display = "none";
}

function disableMouseOnMap() {
	
	var element = document.getElementById("map_container");

	element.style.display = "block";
	element.style.pointerEvents= "auto";
}