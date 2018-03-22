<?php

    include_once(dirname(__FILE__).'/CommentThread.php');
    include_once(dirname(__FILE__).'/AnswerThread.php');
    include_once(dirname(__FILE__).'/Question.php');
    
    
    class QuestionThread{
        var $question;
        var $questionName;
        var $questionFileName;
        var $answerThreadArray;
        var $commentThreadArray;

        function __construct(){
            $this->question = null;
            $this->questionName = null;
            $this->answerThreadArray = null;
            $this->commentThreadArray = null;
        }

        function getQuestion(){
            return $this->question;
        }

        function getQuestionName(){
            return $this->questionName;
        }

        function getAnswerThreadArray(){
            return $this->answerThreadArray;
        }

        function getCommentThreadArray(){
            return $this->commentThreadArray;
        }

        function getQuestionFileName(){
            return $this->questionFileName;
        }

        function setQuestion($question){
            $this->question = $question;
        }

        function setQuestionName($questionName){
            $this->questionName = $questionName;
        }

        function setAnswerThreadArray($answerThreadArray){
            $this->answerThreadArray = $answerThreadArray;
        }

        function setCommentThreadArray($commentThreadArray){
            $this->commentThreadArray = $commentThreadArray;
        }

        function setQuestionFileName($questionFileName){
            $this->questionFileName = $questionFileName;
        }
    }

?>