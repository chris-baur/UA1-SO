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
		
		function getId(){
			return $this->id;
		}
		
		function getAccountId(){
			return $this->account_id;
		}
		
		function getHeader(){
			return $this->header;
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

		function getTags(){
			return $this->tags;
		}
		
		function setId($new_id){
			$this->id = $new_id;
		}
		
		function setAccountId($new_accountID){
			$this->account_id = $new_accountID;
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
		
		function setTags($new_tags){
			$this->tags = $new_tags;
		}
		function setHeader($new_header){
			$this->header=$new_header;
		}

	}
?>