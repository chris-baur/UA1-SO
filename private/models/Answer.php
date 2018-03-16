<?php
	/* @author Wissem Bahloul
	 * Answers object  
	*/
	
	class Answer{
		//Variables
		var $id;
		var $account_id;
		var $question_id;
		var $content;
		var $date;
		var $upvotes;
		var $downvotes;
		var $best;
		
		function __construct($id = 0, $account_id = 0, $question_id = 0, $content = 'content', $date = '2011-08-08 00:00:00.0', $upvotes = 0, $downvotes = 0, $best = false) {			
			$this->id = $id;
			$this->account_id = $account_id;
			$this->question_id = $question_id;
			$this->content = $content;
			$this->date = $date;
			$this->upvotes = $upvotes;
			$this->downvotes = $downvotes;
			$this->best = $best;
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
		
		function getContent(){
			return $this->content;
		}
		
		function getDate(){
			return $this->date;
		}
		
		function getUpvotes(){
			return $this->upvotes;
		}
		function getDownvotes(){
			return $this->downvotes;
		}
		function get_best(){
			return $this->best;
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
		
		function setContent($new_content){
			$this->content = $new_content;
		}
		
		function setDate($new_date){
			$this->date = $new_date;
		}
		
		function setUpvotes($new_upvotes){
			$this->upvotes = $new_upvotes;
		}
		function setDownvotes($new_downvotes){
			$this->downvotes = $new_downvotes;
		}

		function set_best($new_best){
			$this->best = $new_best;
		}
		
	}
?>