<?php
	/* @author Wissem Bahloul
	 * Comments object  
	*/
	
	class Comments{
		//Variables
		var $id;
		var $account_id;
		var $question_id;
		var $content;
		var $date;
		var $upvotes;
		var $downvotes;
		
		function __construct($id = 0, $account_id = 'account_id', $question_id = 'question_id', $answer_id = '$answer_id', $content = 'content', $date = 'date') {
			
			$this->id = $id;
			$this->account_id = $account_id;
			$this->question_id = $question_id;
			$this->answer_id = $answer_id;
			$this->content = $content;
			$this->date = $date;
			
		}
		
		function get_id(){
			return $this->id;
		}
		
		function get_accountID(){
			return $this->account_id;
		}
		
		function get_questionID(){
			return $this->question_id;
		}

		function get_answerID(){
			return $this->answer_id;
		}
		
		function get_content(){
			return $this->content;
		}
		
		function get_date(){
			return $this->date;
		}

		function get_upvotes(){
			return $this -> $upvotes;
		}
		
		function get_downvotes(){
			return $this -> $downvotes;
		}
		
		
		function set_id($new_id){
			$this->id = $new_id;
		}
		
		function set_accountID($new_accountID){
			$this->account_id = $new_accountID;
		}
		
		function set_questionID($new_contentID){
			$this->question_id = $new_questionID;
		}
		
		function set_answerID($new_contentID){
			$this->answer_id = $new_answerID;
		}

		function set_content($new_content){
			$this->content = $new_content;
		}
		
		function set_date($new_date){
			$this->date = $new_date;
		}
		
		function set_upvote($new_upvotes){
			$this -> $upvotes = $new_upvote;
		}
		
		function set_downvote($new_downvotes){
			$this -> $downvotes = $new_downvotes;
		}
		
		// function to increament the upvotes/downvotes by one
		function increment_upvotes(){
			$this -> $upvotes++;
		}
		
		function increment_downvotes(){
			$this -> $downvotes--;
		}
	}
?>