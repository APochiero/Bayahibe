function UserReviewInteraction() {}

UserReviewInteraction.DEFAUL_METHOD = "GET";
UserReviewInteraction.URL_REQUEST = "./AJAX/UserReviewInteraction.php";
UserReviewInteraction.ASYNC_TYPE = true;

UserReviewInteraction.SUCCESS_RESPONSE = "0";
UserReviewInteraction.NOT_LOGGED = "1";

/* FLAG == 1 --> "Mi piace"
   FLAG == null --> "Nessuna Preferenza"
   FLAG == -1 --> "Non mi piace" */
	

UserReviewInteraction.onLikeEvent = function( ID ) {
	
	var Preference = ReviewList.getUserPreference( ID ); // Prelevo la mia preferenza precedente per la recensione 
	
	var flag = 1; // Mi piace 
	if ( Preference == 1 ) // Mi piace una recensione a cui ho dato già "mi piace", quindi voglio togliere il "mi piace"
		flag = null;
	
	var Query = "?ReviewID=" + ID + "&isLiked=" + flag;
	console.log(Preference + '   ' + Query);
	var url = UserReviewInteraction.URL_REQUEST + Query;
	var responseFunction = UserReviewInteraction.onAjaxResponse;
	
	AjaxManager.performAjaxRequest(UserReviewInteraction.DEFAUL_METHOD, url, UserReviewInteraction.ASYNC_TYPE, null, responseFunction)
}

UserReviewInteraction.onDislikeEvent = function( ID ) {
	
	
	var Preference = ReviewList.getUserPreference( ID ); // Prelevo la mia preferenza precedente per la recensione 
	
	var flag = 0; // Non mi piace 
	if ( Preference == 0 ) // Non mi piace una recensione a cui ho dato già "non mi piace", quindi voglio togliere il "non mi piace"
		flag = null;

	var Query = "?ReviewID=" + ID + "&isDisliked=" + flag;
	var url = UserReviewInteraction.URL_REQUEST + Query;
	var responseFunction = UserReviewInteraction.onAjaxResponse;
	
	AjaxManager.performAjaxRequest(UserReviewInteraction.DEFAUL_METHOD, url, UserReviewInteraction.ASYNC_TYPE, null, responseFunction)
}


UserReviewInteraction.onAjaxResponse = function( response ) {

	if (response.responseCode === UserReviewInteraction.SUCCESS_RESPONSE) {
		ReviewList.updateUserReviewStat( response.data.ReviewID, response.data.Preference, response.data.Likes, response.data.Dislikes );
	} else if ( response.responseCode === UserReviewInteraction.NOT_LOGGED )
		showPopup( "Login" );
}

