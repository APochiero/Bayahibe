
function drawGraph( result ) {
	
	var canvas = document.getElementById('Graph');
	var context = canvas.getContext('2d');
	
	var offsetY = 0;
	var offsetX = 100;
	var rectWidth = 50;
	var maxValue = 1395;
	
	context.textBaseline = 'middle';
	context.font = 'bold 15px "Bilbo"';

	for ( var i = 0; i < 10; ++i ) {
		//Creazione delle linee orizzontali e degli indici sull'asse Y del grafico
		context.moveTo(45,canvas.height - 50 - offsetY*200/maxValue);      		
		context.lineTo(canvas.width, canvas.height - 50 - offsetY*200/maxValue);
		context.lineWidth = 1;	
		context.strokeStyle = "#0066ff";
		context.stroke();
		context.fillText(offsetY, 0, canvas.height - 50 - offsetY*200/maxValue);
		offsetY += 155;
	}

	
	var gradient= context.createLinearGradient(0,canvas.height - 50,0, canvas.height - 250 );
	gradient.addColorStop(0, 'rgb(255, 0, 0)' );
	gradient.addColorStop(0.25, 'rgb(255, 255, 0)' );
	gradient.addColorStop(0.5, 'rgb(0, 204, 0)' );
	gradient.addColorStop(0.75, 'rgb(0, 255, 204)' );
	gradient.addColorStop(1, 'rgb(0, 0, 255)' );
	
		
	
	for( var i = 0; i < 5; i++ ) {
		//Creazione dei rettangoli di altezza proporzionale al risultato della query 
		var height = result[i].UmbrellaDays; 
		context.fillStyle = gradient;
		context.fillRect( offsetX, canvas.height - height*200/maxValue - 50, rectWidth, height*200/maxValue );
		context.textAlign = 'center';
		context.font = 'bold 20px "Bilbo"';
		context.fillText(height, offsetX + 25, canvas.height - height*200/maxValue - 60);
		context.font = 'bold 20px Amatic SC';
		context.fillText( result[i].Month, offsetX + 25, canvas.height - 20 );
		offsetX += 100 + rectWidth;
	}
		
}