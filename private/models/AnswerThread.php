<?php

    include_once(dirname(__FILE__).'/CommentThread.php');
    include_once(dirname(__FILE__).'/Answer.php');
    
    
    class AnswerThread{
        var $answer;
        var $answerName;
        var $commentThreadArray;

        function __construct(){
            $this->answer = null;
            $this->answerName = null;
            $this->commentThreadArray = null;
        }

        function getAnswer(){
            return $this->answer;
        }

        function getAnswerName(){
            return $this->answerName;
        }

        function getCommentThreadArray(){
            return $this->commentThreadArray;
        }

        function setAnswer($answer){
            $this->answer = $answer;
        }

        function setAnswerName($answerName){
            $this->answerName = $answerName;
        }

        function setCommentThreadArray($commentThreadArray){
            $this->commentThreadArray = $commentThreadArray;
        }
    }

?>