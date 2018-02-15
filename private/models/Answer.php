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
		
		function get_id(){
			return $this->id;
		}
		
		function get_accountId(){
			return $this->account_id;
		}
		
		function get_questionId(){
			return $this->question_id;
		}
		
		function get_content(){
			return $this->content;
		}
		
		function get_date(){
			return $this->date;
		}
		
		function get_upvotes(){
			return $this->upvotes;
		}
		function get_downvotes(){
			return $this->downvotes;
		}
		function get_best(){
			return $this->best;
		}
		
		function set_id($new_id){
			$this->id = $new_id;
		}
		
		function set_accountId($new_accountID){
			$this->account_id = $new_accountID;
		}
		
		function set_questionId($new_questionID){
			$this->question_id = $new_questionID;
		}
		
		function set_content($new_content){
			$this->content = $new_content;
		}
		
		function set_date($new_date){
			$this->date = $new_date;
		}
		
		function set_upvotes($new_upvotes){
			$this->upvotes = $new_upvotes;
		}
		function set_downvotes($new_downvotes){
			$this->downvotes = $new_downvotes;
		}

		function set_best($new_best){
			$this->best = $new_best;
		}
		
	}
?>