<?php
	/* @author Christoffer Baur
	 * Account object  
	*/
	
	class Account{
		//Variables
		var $id;
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
		
		function __construct($id = 0, $username = 'username', $password = 'password', $name = 'name', $last_name = 'last name', $gender = 'other', $security_one = 'default',
			$security_two = 'default 2', $answer_one = 'answer one', $answer_two = 'answer two', $bio = 'my bio', $profession = 'profession', $pin = '0000'){
			
			$this->id = $id;
			$this->$username = $username;
			$this->$password = $password;
			$this->$name = $name;
			$this->$last_name = $last_name;
			$this->$gender = $gender;
			$this->$security_one = $security_one;
			$this->$security_two = $security_two;
			$this->$answer_one = $answer_one;
			$this->$answer_two = $answer_two;
			$this->$bio = $bio;
			$this->$profession = $profession;
			$this->$pin = $pin;
		}
				
		function get_id(){
			return $this->id;
		}
		
		function get_username(){
			return $this->username;
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
		
		function set_id($new_id){
			$this->id = $new_id;
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
			$this->answer_one = $new_answer_one;
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
	}
?>