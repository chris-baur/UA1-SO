<?php
	/* @author Wissem Bahloul
	 * Answers object  
	*/
	
	class Answers{
		//Variables
		var $id;
		var $account_id;
		var $question_id;
		var $content;
		var $date;
		var $upvotes;
		var $downvotes;

		
		function __construct($id = 0, $account_id = 'account_id', $question_id = 'question_id', $content = 'content', $date = 'date', $upvotes = 'upvotes', $downvotes = 'downvotes') {
			
			$this->id = $id;
			$this->account_id = $account_id;
			$this->question_id = $question_id;
			$this->content = $content;
			$this->date = $date;
			$this->upvotes = $upvotes;
			$this->downvotes = $downvotes;
			
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
		
		function set_id($new_id){
			$this->id = $new_id;
		}
		
		function set_accountID($new_accountID){
			$this->account_id = $new_accountID;
		}
		
		function set_questionID($new_contentID){
			$this->question_id = $new_questionID;
		}
		
		function set_content($new_content){
			$this->content = $new_content;
		}
		
		function set_date($new_date){
			$this->date = $new_date;
		}
		
		function set_upvotes($new_downvotes){
			$this->upvotes = $new_upvotes;
		}
		function set_downvotes($new_downvotes){
			$this->downvotes = $new_downvotes;
		}
		
	}
?>