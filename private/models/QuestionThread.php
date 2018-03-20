<?php

    include_once('\CommentThread.php');
    include_once('\AnswerThread.php');
    include_once('\Question.php');
    
    
    class QuestionThread{
        var $question;
        var $questionName;
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
            return $this->getQuestionName;
        }

        function getAnswerThreadArray(){
            return $this->answerThreadArray;
        }

        function getCommentThreadArray(){
            return $this->commentThreadArray;
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
    }

?>