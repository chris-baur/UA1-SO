<?php
	/* @author Christoffer Baur
	 * Account object  
	*/
	
	class Account{
		//Variables
		var $username;
		var $password;
		var $name;
		var $last_name;
		var $gender;
		var $security_one;
		var $security_two;
		var $answer_one;
		var $answer_two;
		var $bio;
		var $profession;
		var $pin;
		
		function get_username(){
			return $this->username
		}
		
		function get_password(){
			return $this->password;
		}
		
		function get_name(){
			return $this->name;
		}
		
		function get_last_name(){
			return $this->last_name;
		}
		
		function get_gender(){
			return $this->gender;
		}
		
		function get_security_one(){
			return $this->security_one;
		}
		
		function get_security_two(){
			return $this->security_two;
		}
		
		function get_answer_one(){
			return $this->answer_one;
		}
		
		function get_answer_two(){
			return $this->answer_two;
		}
		
		function get_bio(){
			return $this->bio;
		}

		function get_profession(){
			return $this->profession;
		}
		
		function get_pin(){
			return $this->pin;
		}
		
		function set_username($new_username){
			$this->username = $new_username;
		}
		
		function set_password($new_password){
			$this->password = $new_password;
		}
		
		function set_name($new_name){
			$this->name = $new_name;
		}
		
		function set_last_name($new_last_name){
			$this->last_name = $new_last_name;
		}
		
		function set_gender($new_gender){
			$this->gender = $new_gender;
		}
		
		function set_security_one($new_security_one){
			$this->security_one = $new_security_one;
		}
		
		function set_security_two($new_security_two){
			$this->security_two = $new_security_two;
		}
		
		function set_answer_one($new_answer_one){
			$this->answer_one - $new_answer_one;
		}
		
		function set_answer_two($new_answer_two){
			$this->answer_two = $new_answer_two;
		}
		
		function set_bio($new_bio){
			$this->bio = $new_bio;
		}

		function set_profession($new_profession){
			$this->profession = $new_profession;
		}
		
		function set_pin($new_pin){
			$this->pin = $new_pin;
		}
?>