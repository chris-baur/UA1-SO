<?php
	/* @author Wissem Bahloul
	 * Comments object  
	*/
	
	class Comment{
		//Variables
		var $id;
		var $account_id;
		var $question_id;
		var $answer_id;
		var $content;
		var $date;
		var $upvotes;
		var $downvotes;
		
		function __construct($id = 0, $account_id = 0, $question_id = 0, $answer_id = 0, $content = 'content', $date = '2011-08-08 00:00:00.0', $upvotes = 0, $downvotes = 0) {
			
			$this->id = $id;
			$this->account_id = $account_id;
			$this->question_id = $question_id;
			$this->answer_id = $answer_id;
			$this->content = $content;
			$this->date = $date;
			$this->upvotes = $upvotes;
			$this->downvotes = $downvotes;
			
		}
		
		function getId(){
			return $this->id;
		}
		
		function getAccountId(){
			return $this->account_id;
		}
		
		function getQuestionId(){
			return $this->question_id;
		}

		function getAnswerId(){
			return $this->answer_id;
		}
		
		function getContent(){
			return $this->content;
		}
		
		function getDate(){
			return $this->date;
		}

		function getUpvotes(){
			return $this ->upvotes;
		}
		
		function getDownvotes(){
			return $this ->downvotes;
		}
		
		
		function setId($new_id){
			$this->id = $new_id;
		}
		
		function setAccountId($new_accountID){
			$this->account_id = $new_accountID;
		}
		
		function setQuestionId($new_questionID){
			$this->question_id = $new_questionID;
		}
		
		function setAnswerId($new_answerID){
			$this->answer_id = $new_answerID;
		}

		function setContent($new_content){
			$this->content = $new_content;
		}
		
		function setDate($new_date){
			$this->date = $new_date;
		}
		
		function setUpvotes($new_upvotes){
			$this ->upvotes = $new_upvotes;
		}
		
		function setDownvotes($new_downvotes){
			$this ->downvotes = $new_downvotes;
		}
		
		// function to increament the upvotes/downvotes by one
		function increment_upvotes(){
			$this ->upvotes++;
		}

		function decrement_upvotes(){
			$this ->upvotes--;
		}
		
		function increment_downvotes(){
			$this ->downvotes++;
		}
		function decrement_downvotes(){
			$this ->downvotes--;
		}
	}
?>