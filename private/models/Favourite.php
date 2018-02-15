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

    function get_id(){
        return $this->id;
    }

    function get_accountId(){
        return $this->accountId;
    }

    function get_questionId(){
        return $this->questionId;
    }

    function get_answerId(){
        return $this->answerId;
    }

    function set_id($newId){
        $this->id = $newId;
    }

    function set_accountId($newAccountId){
        $this->accountId = $newAccountId;
    }

    function set_questionId($newQuestionId){
        $this->questionId = $newQuestionId;
    }

    function set_answerId($newAnswerId){
        $this->answerId = $newAnswerId;
    }


 }


?>