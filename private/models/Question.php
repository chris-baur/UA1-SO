<?php
	/* @author Wissem Bahloul
	 * Questions object  
	*/
	
	class Question{
		//Variables
		var $id;
		var $account_id;
		var $header;
		var $content;
		var $date;
		var $upvotes;
		var $downvotes;
		var $tags;

		function __construct($id = 0, $account_id = null, $header = 'header', $content = 'content', $date = '2018-01-01 01:00:00.0', $upvotes = 0, $downvotes = 0, $tags = []) {
			
			$this->id = $id;
			$this->account_id = $account_id;
			$this->header = $header;
			$this->content = $content;
			$this->date = $date;
			$this->upvotes = $upvotes;
			$this->downvotes = $downvotes;
			$this->tags = $tags;
			
		}
		
		function get_id(){
			return $this->id;
		}
		
		function get_accountId(){
			return $this->account_id;
		}
		
		function get_header(){
			return $this->header;
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

		function get_tags(){
			return $this->tags;
		}
		
		function set_id($new_id){
			$this->id = $new_id;
		}
		
		function set_accountId($new_accountID){
			$this->account_id = $new_accountID;
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
		
		function set_tags($new_tags){
			$this->tags = $new_tags;
		}
	}
?>