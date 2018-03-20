<?php

    include_once(dirname(__FILE__).'/Comment.php');
    
    class CommentThread{
        var $comment;
        var $commentName;

        function __construct(){
            $this->comment = null;
            $this->commentName = null;
        }

        function getComment(){
            return $this->comment;
        }

        function getCommentName(){
            return $this->getCommentName;
        }

        function setComment($comment){
            $this->comment = $comment;
        }

        function setCommentName($commentName){
            $this->commentName = $commentName;
        }

    }

?>