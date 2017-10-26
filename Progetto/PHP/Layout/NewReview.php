<div class = "NewReview_container">
	<div class = "Review_UserInfo"> 
		<?php 
			echo '<h1 id = "Reviewer">' . $_SESSION['username'] .'</h1>';  
			$data = getUserInformation($_SESSION['userId']);
			echo '<img id = "Reviewer_Avatar" src="data:image/jpeg;base64,'.base64_encode( $data['Avatar'] ).'" alt = "Avatar not Found">';?>
	</div>
	<div class = "NewReviewMain">
		<form action = "javascript: ReviewSender.Send()" >
			<ul>
				<li class = "NewReviewInput_container"> 
					<label> Titolo: </label>
					<input  id = "NewReviewTitle" type = "text" required >
				</li>
				<li class = "NewReviewInput_container">
					<label id = "Vote"> Voto:  </label>
					<div class = "NewReviewStars" id = "StarDiv"> 
						<div class = "Star"  id = "0" ></div>
						<div class = "Star"  id = "0.5" ></div>
						<div class = "Star"  id = "1" ></div>
						<div class = "Star"  id = "1.5" ></div>
						<div class = "Star"  id = "2"></div>
						<div class = "Star"  id = "2.5"></div>
						<div class = "Star"  id = "3"></div>
						<div class = "Star"  id = "3.5"></div>
						<div class = "Star"  id = "4"></div>
						<div class = "Star"  id = "4.5"></div>
						<div class = "Star"  id = "5"></div>
					</div>
					<img class = "NewReviewVote" id = "NewReviewVote" src = "../immagini/Stars/0.png" alt = "0 su 5">
					<input id = "VoteValue" type = "number" min = "0" max = "5" step = "0.5" value = "0" > 
					<script type="text/javascript" src="./../JavaScript/ReviewSender.js"></script>
				</li>
				<li class = "NewReviewText" >
					<label> Testo: </label>
					<textarea id = "NewReviewText" maxlength = 500 > </textarea>
				</li>
			</ul>
			<input class = "Send_Review" type = "submit" value = "Invia" >
		</form>
	</div>
</div>