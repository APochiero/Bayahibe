function AjaxManager(){}

AjaxManager.getAjaxObject = 
	function(){
		var xmlHttp = null;
		try { 
			xmlHttp = new XMLHttpRequest(); 
		} catch (e) {
			try { 
				xmlHttp = new ActiveXObject("Msxml2.XMLHTTP"); //IE (recent versions)
			} catch (e) {
				try { 
					xmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); //IE (older versions)
				} catch (e) {
					xmlHttp = null; 
				}
			}
		}
		return xmlHttp;
	}

AjaxManager.performAjaxRequest = 
	function(method, url, isAsync, dataToSend, responseFunction){
		var xmlHttp = AjaxManager.getAjaxObject();
		if (xmlHttp === null){
			window.alert("Your browser does not support AJAX!"); // set error function
			return;
		}
	
		
		xmlHttp.open(method, url, isAsync);
		
		if ( method == "POST" ) 
			xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
		xmlHttp.onreadystatechange = 
			function ()	{
				if (xmlHttp.readyState == 4) {
					console.log(xmlHttp);
					var data = JSON.parse( xmlHttp.responseText );
					responseFunction(data);
				}
			};
			
		xmlHttp.send(dataToSend);
};		