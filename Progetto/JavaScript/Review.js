function Review( ID, Reviewer, Avatar,  Title, Text, Vote, ReviewDate, Preference, Likes, Dislikes ) {
	this.ID = ID;  
	this.Reviewer = Reviewer; 
	this.Avatar = Avatar;
	this.Title = Title; 
	this.Text = Text;
	this.Vote = Vote;
	this.ReviewDate = ReviewDate;
	this.Preference = Preference;
	this.Likes = Likes;
	this.Dislikes = Dislikes;
}

//Creazione della recensione
Review.prototype.drawReview = function() { 
	var Review = document.createElement( "li" );
	Review.setAttribute( "class", "Review_container");
	
	var ReviewUserInfo = document.createElement("div");
	ReviewUserInfo.setAttribute("class", "Review_UserInfo");
	
	var Reviewer = document.createElement( "h2" );
	Reviewer.setAttribute("id", "Reviewer" + this.ID );
	Reviewer.textContent = this.Reviewer;

	var Avatar = document.createElement( "img" );
	Avatar.setAttribute( "src", "data:image/jpeg;base64," + this.Avatar );
	Avatar.setAttribute( "alt", "Avatar not found" );
	Avatar.setAttribute( "id", "Reviewer_Avatar" + this.ID );
	
	ReviewUserInfo.appendChild(Reviewer);
	ReviewUserInfo.appendChild(Avatar);
	Review.appendChild(ReviewUserInfo);
	
	var Main = document.createElement("div");
	Main.setAttribute("class", "Review_Main");
	
	var header = document.createElement("header");
	var title = document.createElement("q");
	title.setAttribute("id", "Review_Title" + this.ID );
	title.textContent = this.Title;
	
	var Reviewer_nav_container = document.createElement("div");
	Reviewer_nav_container.setAttribute("class", "Reviewer_nav_container");
	
	var nav = document.createElement("nav");
	nav.setAttribute("class", "Review_nav");
	
	var div_Vote = document.createElement("div");
	var Review_Vote = document.createElement("img");
	Review_Vote.setAttribute("class", "Review_Vote");
	Review_Vote.setAttribute("id", "Review_Vote" + this.ID);
	Review_Vote.setAttribute("src", "../immagini/Stars/" + this.Vote + ".png" );
	Review_Vote.setAttribute("alt", this.Vote + " su 5" );
	
	var Date = document.createElement("div");
	Date.setAttribute("id", "Review_Date" + this.ID );
	Date.textContent = this.ReviewDate;
	
	var div_Like_Dislike = document.createElement("div");
	div_Like_Dislike.setAttribute("class", "Like-Dislike");
	
	var div_Like = document.createElement("div");
	var img_Like = document.createElement("img");
	var Liked = this.Preference == 1 ? "../immagini/Icons/Liked.png" : "../immagini/Icons/Like.png";
	img_Like.setAttribute("src", Liked );
	img_Like.setAttribute("alt", "Like" );
	img_Like.setAttribute("id", "Like" + this.ID );
	img_Like.setAttribute("onclick", "UserReviewInteraction.onLikeEvent( " +  this.ID + ")" );
	
	var Likes_Counter = document.createElement("div");
	Likes_Counter.setAttribute( "id", "Likes_Counter" + this.ID );
	Likes_Counter.textContent = "("+ this.Likes + ")";

	var div_Dislike = document.createElement("div");
	var img_Dislike = document.createElement("img");
	var Disliked = this.Preference == 0? "../immagini/Icons/Disliked.png" : "../immagini/Icons/Dislike.png";
	img_Dislike.setAttribute("src", Disliked );
	img_Dislike.setAttribute("alt", "Dislike" );
	img_Dislike.setAttribute("id", "Dislike" + this.ID );
	img_Dislike.setAttribute("onclick", "UserReviewInteraction.onDislikeEvent( " +  this.ID + ")" );
	
	var Dislikes_Counter = document.createElement("div");
	Dislikes_Counter.setAttribute( "id", "Dislikes_Counter" + this.ID );
	Dislikes_Counter.textContent = "("+ this.Dislikes + ")";
	
	div_Like.appendChild(img_Like);
	div_Dislike.appendChild(img_Dislike);
	div_Like_Dislike.appendChild(div_Like);
	div_Like_Dislike.appendChild(Likes_Counter);
	div_Like_Dislike.appendChild(div_Dislike);
	div_Like_Dislike.appendChild(Dislikes_Counter);
		
	div_Vote.appendChild(Review_Vote);
	nav.appendChild(div_Vote);
	nav.appendChild(Date);
	nav.appendChild(div_Like_Dislike);
	Reviewer_nav_container.appendChild(nav);
	
	header.appendChild(title);
	header.appendChild(Reviewer_nav_container);
	
	var Review_Text_container = document.createElement("div");
	Review_Text_container.setAttribute("class", "Review_Text_container");
	var Review_Text = document.createElement("p");
	Review_Text.setAttribute("id", "Review_Text" + this.ID );
	Review_Text.textContent = this.Text;
	
	Review_Text_container.appendChild(Review_Text);
	Main.appendChild(header);
	Main.appendChild(Review_Text_container);
	Review.appendChild(ReviewUserInfo);
	Review.appendChild(Main);
	
	var Review_List = document.getElementsByClassName("Review_List");
	Review_List[0].appendChild(Review);
			
}

Review.prototype.updateReviewPreference = function() {
	
	var Liked = this.Preference == 1 ? "../immagini/Icons/Liked.png" : "../immagini/Icons/Like.png";
	var Disliked = this.Preference == 0? "../immagini/Icons/Disliked.png" : "../immagini/Icons/Dislike.png";
	document.getElementById("Like" + this.ID ).src = Liked;
	document.getElementById("Dislike" + this.ID).src = Disliked;
	
	var Likes_Counter = document.getElementById( "Likes_Counter" + this.ID );
	Likes_Counter.textContent = "("+ this.Likes + ")"; 
	
	var Dislikes_Counter = document.getElementById( "Dislikes_Counter" + this.ID );
	Dislikes_Counter.textContent = "("+ this.Dislikes + ")"; 
}