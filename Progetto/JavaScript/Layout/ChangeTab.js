WRAPPERCOLOR1 = "#558C89" //"rgb(132, 169, 173)";
WRAPPERCOLOR2 = "#74AFAD" //"rgb(221, 150, 86)";
WRAPPERCOLOR3 = "#bedada"//"rgb(179, 255, 102)";

WRAPPERBORDER1 = "rgb(97, 158, 155)";
WRAPPERBORDER2 = "rgb(93, 162, 160)";
WRAPPERBORDER3 = "rgb(158, 199, 199)";

function exalt( tab ) {
	var intero = document.getElementById("tab1");
	var mattina = document.getElementById("tab2");
	var pomeriggio = document.getElementById("tab3");
	var mapWrapper = document.getElementById("map_box");
	var mapBorder = document.getElementById("map");
	var exalt;
	var normalTab;
	var normalTab2;
	var wrapperColor;
	var wrapperBorder; 
	var exaltShadow = "rgba(0,0,0,0.4) 3px -3px 2px";
	var noneShadow = "rgba(0,0,0,0.4) 0px -3px 2px inset";
	switch ( tab ) {
		case 1:
				exalt = intero;
				normalTab = mattina;
				normalTab2 = pomeriggio;
				wrapperColor = WRAPPERCOLOR1;
				wrapperBorder = WRAPPERBORDER1;
				Beach.Type = "Daily";
				break;
		case 2:
				exalt = mattina;
				normalTab = intero;
				normalTab2 = pomeriggio;
				wrapperColor = WRAPPERCOLOR2;
				wrapperBorder = WRAPPERBORDER2;
				Beach.Type = "Morning";
				break;
		case 3:
				exalt = pomeriggio;
				normalTab = mattina;
				normalTab2 = intero;
				wrapperColor = WRAPPERCOLOR3;
				wrapperBorder = WRAPPERBORDER3;
				Beach.Type = "Afternoon";
				break;
		default: break;
	}

	
	exalt.style.zIndex = "100";
	exalt.style.border = "solid 3px";
	exalt.style.borderColor = wrapperBorder;
	exalt.style.borderBottomColor = wrapperColor;
	exalt.style.boxShadow = exaltShadow;
	
	normalTab.style.border = "0px";
	normalTab.style.zIndex = "60";
	normalTab.style.borderBottomColor = wrapperBorder;
	normalTab.style.boxShadow = noneShadow;
	
	normalTab2.style.border = "0px";
	normalTab2.style.zIndex = "50";
	normalTab2.style.borderBottomColor = wrapperBorder;
	normalTab2.style.boxShadow = noneShadow;
	
	mapBorder.style.border = "solid 3px";
	mapBorder.style.borderColor = wrapperBorder;
	mapWrapper.style.backgroundColor = wrapperColor;
	mapWrapper.style.borderColor = wrapperBorder;
	
}