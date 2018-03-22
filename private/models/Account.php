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
		
		function __construct($id = 0, $username = 'username', $password = 'password', $name = 'default name', $last_name = 'last name', $gender = 'other', $security_one = 'default',
			$security_two = 'default 2', $answer_one = 'answer one', $answer_two = 'answer two', $bio = 'my bio', $profession = 'profession', $pin = '0000'){
			
			$this->id = $id;
			$this->username = $username;
			$this->password = $password;
			$this->name = $name;
			$this->last_name = $last_name;
			$this->gender = $gender;
			$this->security_one = $security_one;
			$this->security_two = $security_two;
			$this->answer_one = $answer_one;
			$this->answer_two = $answer_two;
			$this->bio = $bio;
			$this->profession = $profession;
			$this->pin = $pin;
		}
				
		function getId(){
			return $this->id;
		}
		
		function getUsername(){
			return $this->username;
		}
		
		function getPassword(){
			return $this->password;
		}
		
		function getName(){
			return $this->name;
		}
		
		function getLastName(){
			return $this->last_name;
		}
		
		function getGender(){
			return $this->gender;
		}
		
		function getSecurityOne(){
			return $this->security_one;
		}
		
		function getSecurityTwo(){
			return $this->security_two;
		}
		
		function getAnswerOne(){
			return $this->answer_one;
		}
		
		function getAnswerTwo(){
			return $this->answer_two;
		}
		
		function getBio(){
			return $this->bio;
		}

		function getProfession(){
			return $this->profession;
		}
		
		function getPin(){
			return $this->pin;
		}
		
		function setId($new_id){
			$this->id = $new_id;
		}
		
		function setUsername($new_username){
			$this->username = $new_username;
		}
		
		function setPassword($new_password){
			$this->password = $new_password;
		}
		
		function setName($new_name){
			$this->name = $new_name;
		}
		
		function setLastName($new_last_name){
			$this->last_name = $new_last_name;
		}
		
		function setGender($new_gender){
			$this->gender = $new_gender;
		}
		
		function setSecurityOne($new_security_one){
			$this->security_one = $new_security_one;
		}
		
		function setSecurityTwo($new_security_two){
			$this->security_two = $new_security_two;
		}
		
		function setAnswerOne($new_answer_one){
			$this->answer_one = $new_answer_one;
		}
		
		function setAnswerTwo($new_answer_two){
			$this->answer_two = $new_answer_two;
		}
		
		function setBio($new_bio){
			$this->bio = $new_bio;
		}

		function setProfession($new_profession){
			$this->profession = $new_profession;
		}
		
		function setPin($new_pin){
			$this->pin = $new_pin;
		}
	}
?>