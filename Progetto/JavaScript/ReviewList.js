ReviewList.SORTBY = "ReviewDateDESC";
ReviewList.TYPE = 0;
ReviewList.AMOUNT = 10;
ReviewList.REVIEWS = new Array(ReviewList.AMOUNT);

function ReviewList() {}

ReviewList.showMore = function() { 
	
	ReviewList.AMOUNT += 10;
	ReviewList.loadReviews();
}

ReviewList.loadReviews = function() {
	ReviewLoader.load( ReviewList.TYPE, ReviewList.AMOUNT );
}

ReviewList.refreshData = function( data ) {

	if ( data.length < ReviewList.AMOUNT ) { //Se il numero di recensioni caricate è inferiore alla quantità da mostrare, allora aggiorno AMOUNT e disabilito l'elemento per incrementare AMOUNT
		ReviewList.AMOUNT = data.length;
		document.getElementById("showMoreReview").style.display = "none";
	}
	
	//Aggiorno la lista delle recensioni
	ReviewList.REVIEWS = new Array(ReviewList.AMOUNT); 
	for ( var i in data ) {
		ReviewList.REVIEWS[i] = new Review( 	data[i].ID, data[i].Reviewer, data[i].Avatar, data[i].Title,
												data[i].Text, data[i].Vote, data[i].ReviewDate, data[i].Preference, 
												data[i].Likes, data[i].Dislikes );
	}
	ReviewList.Sort(); 
}

ReviewList.drawReviewList = function() {
	
	var Review_List = document.getElementsByClassName("Review_List");
	
	while( Review_List[0].hasChildNodes() ) //Svuoto la lista 
		Review_List[0].removeChild(Review_List[0].childNodes[0]);
	
	for ( var i in ReviewList.REVIEWS ) { //Riempio la lista
		ReviewList.REVIEWS[i].drawReview();
	}
}

ReviewList.Sort = function() {
	
	var selects = document.getElementsByTagName("select"); //Seleziono i parametri per effettuare il sorting 
	
	if ( selects != null ) 
		ReviewList.SORTBY = selects[0].value + selects[1].value;
	
	switch( ReviewList.SORTBY ) { //Sorting
		case "ReviewDateASC": ReviewList.REVIEWS.sort( function( first, second ) { return first.ReviewDate > second.ReviewDate } ); break;
		case "ReviewDateDESC": ReviewList.REVIEWS.sort( function( first, second ) { return first.ReviewDate < second.ReviewDate } ); break;
		case "LikesASC": ReviewList.REVIEWS.sort( function( first, second ) { return first.Likes > second.Likes } ); break;
		case "LikesDESC": ReviewList.REVIEWS.sort( function( first, second ) { return first.Likes < second.Likes } ); break;
		case "DislikesASC": ReviewList.REVIEWS.sort( function( first, second ) { return first.Dislikes > second.Dislikes } ); break;
		case "DislikesDESC": ReviewList.REVIEWS.sort( function( first, second ) { return first.Dislikes < second.Dislikes } ); break;
		case "VoteASC": ReviewList.REVIEWS.sort( function( first, second ) { return first.Vote > second.Vote } ); break;
		case "VoteDESC": ReviewList.REVIEWS.sort( function( first, second ) { return first.Vote < second.Vote } ); break;
		default: ReviewList.REVIEWS.sort( function( first, second ) { return first.ReviewDate < second.ReviewDate } ); break;
	}
	ReviewList.drawReviewList(); //Stampo la lista di recensioni ordinate secondo i parametri scelti
}

ReviewList.updateUserReviewStat = function( ID, Preference, Likes, Dislikes ) { 
	
	for ( var i in ReviewList.REVIEWS ) //Cerco e aggiorno le interazioni utente-recensione
		if ( ReviewList.REVIEWS[i].ID == ID ) {
			ReviewList.REVIEWS[i].Preference = Preference;
			ReviewList.REVIEWS[i].Likes = Likes;
			ReviewList.REVIEWS[i].Dislikes = Dislikes;
			ReviewList.REVIEWS[i].updateReviewPreference();
		}

}

ReviewList.getUserPreference = function( ID ) { 
	
	for ( var i in ReviewList.REVIEWS ) {
			if ( ReviewList.REVIEWS[i].ID == ID )
				return ReviewList.REVIEWS[i].Preference;
	}
	
	
}
