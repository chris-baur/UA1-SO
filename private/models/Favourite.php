<?php

/**
 * @author Christoffer Baur
 * 
 * Model representation of the favourties table
 * 
 */

 class Favourite{
    //class variables
    var $id;
    var $accountId;
    var $questionId;
    var $answerId;

    function __contruct($id = 0, $accoundId = null, $questionId = null, $answerId = null){
        $this->id = $id;
        $this->accountId = $accountId;
        $this->questionId = $questionId;
        $this->answerId = $answerId;
    }

    function getId(){
        return $this->id;
    }

    function getAccountId(){
        return $this->accountId;
    }

    function getQuestionId(){
        return $this->questionId;
    }

    function getAnswerId(){
        return $this->answerId;
    }

    function setId($newId){
        $this->id = $newId;
    }

    function setAccountId($newAccountId){
        $this->accountId = $newAccountId;
    }

    function setQuestionId($newQuestionId){
        $this->questionId = $newQuestionId;
    }

    function setAnswerId($newAnswerId){
        $this->answerId = $newAnswerId;
    }
 }


?>