
function fadeIn(element, speed ){
    var op = 0.1;
    if (op >= 1)
    	return;
    
    var timer = setInterval(function () {
        if (op >= 1){
            clearInterval(timer);
            op = 1;
        }
        
        element.style.opacity = op;
        op += speed;
    }, 20);   
}

function fadeOut(element, finalOpacity, speed ){
    var op = 0.9;
    if (op <= finalOpacity)
    	return;
    
    var timer = setInterval(function () {
        if (op <= finalOpacity){
            clearInterval(timer);
            op = finalOpacity;
        }
        
        element.style.opacity = op;
        op -= speed ;
    }, 20);		
}

function slideUp(element, startPosition, endPosition, speed){
	if (endPosition > startPosition)
		return;
	console.log("slideUp");
	console.log(element);
    var timer = setInterval(function () {
        if (startPosition <= endPosition){
            clearInterval(timer);
            startPosition = endPosition;
        }
        
        element.style.top = startPosition + '%';
        startPosition -= speed;
        element.style.display = 'block';
    }, 20);
}

