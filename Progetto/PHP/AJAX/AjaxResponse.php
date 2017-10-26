<?php  
	
	class AjaxResponse{
		public $responseCode;
		public $message;
		public $data;
		
		function AjaxResponse($responseCode = 1, 
								$message = "Somenthing went wrong! Please try later.",
								$data = null){
			$this->responseCode = $responseCode;
			$this->message = $message;
			$this->data = null;
		}
	
	}
	
	class Umbrella{
		public $Number;
		public $State;
		public $Username;

		function Umbrella( $Username, $Number, $State ) {
			$this->Number = $Number;
			$this->State = $State;
			$this->Username = $Username;
		}
	}
	
	class Review {
		public $ID;
		public $Reviewer;
		public $Avatar;
		public $Title;
		public $Text;
		public $ReviewDate;
		public $Preference;
		public $Likes;
		public $Dislikes;
		
		function Review( $ID, $Reviewer, $Avatar, $Title, $Text, $Vote, $ReviewDate, $Preference, $Likes, $Dislikes ) {
			$this->ID = $ID;
			$this->Reviewer = $Reviewer;
			$this->Avatar = $Avatar;
			$this->Title = $Title;
			$this->Text = $Text;
			$this->Vote = $Vote;
			$this->ReviewDate = $ReviewDate;
			$this->Preference = $Preference;
			$this->Likes = $Likes;
			$this->Dislikes = $Dislikes;
		} 
	}
?>