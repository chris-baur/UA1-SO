<?php

    include_once('\CommentThread.php');
    include_once('\AnswerThread.php');
    include_once('\Answer.php');
    
    
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
            return $this->getAnswerName;
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