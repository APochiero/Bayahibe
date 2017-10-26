function Slider() {}

Slider.Images = new Array(); 
Slider.galleryLength = 0;
Slider.timer = null;
Slider.currentIndex = 0;


Slider.initialize = 
	function ( Page, length) { //Inizializzo lo slider caricando le immagini, creando la console e impostando lo slide automatico
	
		Slider.galleryLength = length; 
		for ( var i = 0; i < Slider.galleryLength; ++i ) 
			Slider.Images[i] = "../Immagini/Gallery/" + Page + "/" + Page + "-image-" + i + ".jpg";
		
		createConsole();
		Slider.setAutoSlide();
		document.addEventListener( "visibilitychange", Slider.TimerHandler );
}

Slider.TimerHandler = // implementata perchè quando il browser perde il focus, riduce la priorità delle task attive. Di conseguenza l'animazione dello slider diventa talmente lenta che più cambi di immagine vengono sovrapposti.  
	function() { //Se la pagina del browser non ha il "focus", allora fermo il timer, appena lo riprende riattivo il timer 
		if ( document.visibilityState == "hidden" )
			clearInterval(Slider.timer);
		else if ( document.visibilityState == "visible")
			Slider.setAutoSlide();
}

/* inc_dec == 1 --> mostra immagine successiva
   inc_dec == -1 --> mostra immagine precedente */
Slider.changeImage = 
	function(element, inc_dec) { 
		var consoleIndex = document.getElementById("consoleIndex");
		consoleIndex.childNodes[Slider.currentIndex].setAttribute("class", "consoleIndex"); //Aggiorno la pallina corrente 
		if ( Slider.currentIndex == Slider.galleryLength - 1 && inc_dec == 1 ) { //Se sono sull'ultima immagine e incremento, allora torno alla prima immagine
			Slider.currentIndex = 0;
		} else if ( Slider.currentIndex == 0 && inc_dec == -1) { //Se sono sulla prima immagine e decremento, allora vado all'ultima immagine
			Slider.currentIndex = Slider.galleryLength - 1;
		} else {
			Slider.currentIndex += inc_dec; //altrimenti incremento o decremento 
		}
		consoleIndex.childNodes[Slider.currentIndex].setAttribute("class", "consoleCurrentIndex"); //Aggiorno la nuova pallina
		element.src = Slider.Images[Slider.currentIndex];
}

Slider.setAutoSlide = 
	function() { //Cambia immagine ogni 5 secondi
		Slider.timer = setInterval( function() {
			Slider.slide(1);
		}, 5000 );
} 

Slider.slide =
	function( inc_dec ) {
		var currentImage = document.getElementById("current_image");
		var direction = Slider.getRandomDirection(); //Genero una direzione 
		
		var nextImage = document.getElementById("next_image_" + direction); 
		Slider.changeImage(nextImage, inc_dec); //Cambio l'immagine dell'elemento "next_image"
		var currentPosition = 100; 
		
		var AnimationTimer = setInterval( function() { 
			if ( currentPosition <= 0.1 ) { //Se la posizione corrente è prossima allo zero 
				clearInterval(AnimationTimer); //Pulisco il timer dell'animazione
				currentImage.setAttribute( "src", nextImage.src ); //L'elemento "current_image" prende l'immagine successiva, diventanto quindi l'immagine corrente
				
				//Riposiziono gli elementi nelle posizioni di partenza
				currentImage.setAttribute( "style", direction + ':' + 0 + "%"); 
				nextImage.setAttribute( "style", direction + ':' + 100 + "%" );
				return;
			}
			//Ogni 10ms decremento la posizione dell'immagine corrente e quella della prossima immagine ( traslata del 100% ) 
			currentPosition -= currentPosition*0.5;
			nextImage.setAttribute( "style" , direction + ':'  + currentPosition  + "%" );
			currentImage.setAttribute( "style", direction + ':'  + (currentPosition - 100) + "%");
							
		}, 10);
	
} 

Slider.getRandomDirection =
	function() {
		var random = Math.floor((Math.random() * 4) + 1 );
		var direction;
		switch ( random ) {
			case 1: direction = "left"; break;
			case 2: direction = "right"; break;
			case 3: direction = "top"; break;
			case 4: direction = "bottom"; break;
		}
		return direction;
}

function createConsole() { //Creo la console 
		
	var htmlElement = document.getElementById("console_wrapper");
	
	var button_left = document.createElement('img');
	button_left.setAttribute( 'onclick', 'ButtonEventHandler(-1)' );
	button_left.setAttribute('class', 'consoleButton');	
	button_left.setAttribute('src', '../Immagini/Icons/console-left-arrow.png');
	button_left.setAttribute('alt', 'Console button not found');
	button_left.addEventListener('mouseover', this.OverEventHandler.bind(button_left) );
	button_left.addEventListener('mouseout', this.OutEventHandler.bind(button_left) );
	htmlElement.appendChild(button_left);
	
	var button_right = document.createElement('img');
	button_right.setAttribute( 'onclick', 'ButtonEventHandler(1)' );
	button_right.setAttribute('class', 'consoleButton');
	button_right.setAttribute('src', '../Immagini/Icons/console-right-arrow.png');
	button_right.setAttribute('alt', 'Console button not found');
	button_right.addEventListener('mouseover', this.OverEventHandler.bind(button_right) );
	button_right.addEventListener('mouseout', this.OutEventHandler.bind(button_right) );
	htmlElement.appendChild( button_right);
	
	var ul = document.createElement('ul');
	ul.setAttribute('id', 'consoleIndex');
	
	
	for ( var i in Slider.Images ) { //Creo i dots della console, associando gli handler per gli eventi 
		var dot = document.createElement('li');
		if ( i == 0 ) //Il primo è quello corrente
			dot.setAttribute('class', 'consoleCurrentIndex');
		else 
			dot.setAttribute('class', 'consoleIndex');
		dot.textContent = i;
		dot.addEventListener('click', this.IndexEventHandler.bind(dot) );
		dot.addEventListener('mouseover', this.OverEventHandler.bind(dot) );
		dot.addEventListener('mouseout', this.OutEventHandler.bind(dot) );
		ul.appendChild(dot);
	}
	htmlElement.appendChild(ul);
}

// Funzioni per la gestione della console 

function ButtonEventHandler( inc_dec ) { 
	//Slide manuale, quindi fermo il timer corrente, cambio immagine e lo riattivo
	if ( Slider.timer ) clearInterval(Slider.timer);
	
	Slider.slide(inc_dec);
	Slider.setAutoSlide();
}

function IndexEventHandler() {
		
	if ( Slider.timer ) clearInterval(Slider.timer);
	//aggiorno il current index in base al dot cliccato, cambio immagine e riattivo il timer
	var consoleIndex = document.getElementById("consoleIndex");
	consoleIndex.childNodes[Slider.currentIndex].setAttribute("class", "consoleIndex");
	Slider.currentIndex = parseInt(this.textContent); 
	Slider.slide(0);
	Slider.setAutoSlide();
}
	

function OverEventHandler() {
	if ( this.className == "consoleButton" )
		this.style.backgroundColor = "rgba(255,255,255,0.8)";
	else
		this.className = "consoleCurrentIndex";
}

function OutEventHandler() {
	if (  this.className == "consoleButton" ) 
		this.style.backgroundColor = "rgba(255,255,255,0.5)";
	else if ( parseInt(this.textContent ) != Slider.currentIndex ) 
		this.className = "consoleIndex";
}
