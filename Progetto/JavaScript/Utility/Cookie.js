function getCookie( check_name ) { // Slide Javascript n° 339
	
	var a_all_cookies = document.cookie.split( ';' );
	var a_temp_cookie = '';
	var cookie_name = '';
	var cookie_value = '';
	var b_cookie_found = false;
	for ( i = 0; i < a_all_cookies.length; i++ ) {
		a_temp_cookie = a_all_cookies[i].split( '=' );
		cookie_name = a_temp_cookie[0].replace(/^\s+|\s+$/g, '');
		if ( cookie_name == check_name ){	
			b_cookie_found = true;
			if ( a_temp_cookie.length > 1 ) 
				cookie_value = unescape(a_temp_cookie[1].replace(/^\s+|\s+$/g, '') );
		
			return cookie_value;
		}
		a_temp_cookie = null;cookie_name = '';
	}
	if ( !b_cookie_found )
		return null;
}