<?php

    include_once(dirname(__FILE__).'/../models/QuestionThread.php');
    include_once(dirname(__FILE__).'/../models/AnswerThread.php');
    include_once(dirname(__FILE__).'/../models/CommentThread.php');

    include_once(dirname(__FILE__).'/../util/logging.php');
    include_once(dirname(__FILE__).'/../util/sets.php');
    include_once(dirname(__FILE__).'/../models/Account.php');

    class QuestionThreadController{

        private static $servername;
        private static $username;
        private static $password;
        private static $dbname;
        private static $log;
        

        function __construct(){
            $config = parse_ini_file(dirname(__FILE__).'/../../config.ini');
            
            self::$servername = $config['servername'];
            self::$username = $config['username'];
            self::$password = $config['password'];
            self::$dbname = $config['dbname'];
            self::$log = new Logging();
        }

        /**
         * Returns question thread with the specified id
         *
         * @param $id		Question's id
         */
        static function getQuestionThread($id){
            global $servername, $username, $password, $dbname, $log;
            $questionThread = new QuestionThread();
            
            try{
                $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $stmt = $pdo -> prepare("SELECT Q.id, Q.account_id, Q.header, Q.content, Q.date, Q.upvotes, Q.downvotes, Q.tags, AC.username, AC.profile_picture_path FROM questions Q 
                    JOIN accounts AC ON AC.id = Q.account_id 
                    WHERE Q.id = :id;");						
                $stmt -> bindParam(':id', $id);
                $stmt -> execute();
                $result = $stmt -> fetch();
                
                // while there is a question with specified header
                if($result){
                    $q = new Question();
                    $q->setId($result[0]);
                    $q->setAccountId($result[1]);
                    $q->setHeader($result[2]);
                    $q->setContent($result[3]);
                    $q->setDate($result[4]);
                    $q->setUpvotes($result[5]);
                    $q->setDownvotes($result[6]);
                    $q->setTags(explode(' ', $result[7]));
                    $uname = $result[8];                    
                    $questionThread->setQuestion($q);
                    $questionThread->setQuestionName($uname);
                    $questionThread->setQuestionFileName($result[9]);

                    self::$log->lwrite("Got the question with account username: $uname");                 
                    
                    //get other objects from questoinThread
                    $questionThread->setAnswerThreadArray(self::getAnswerThread($id));
                    $questionThread->setCommentThreadArray(self::getCommentThread($id, 'question')); 
                    
                    self::$log->lwrite('Got everything for the QuestionThread');                 
                }
            }
            catch(PDOException $e){
                self::$log->lwrite($e -> getMessage());
            }
            finally{
                unset($pdo);
            }
            // returns the questions array
            return $questionThread;
        }

        /**
         * Returns answers thread with the specified question id
         *
         * @param $id		Answer's question id
         */
        private static function getAnswerThread($id){
            global $servername, $username, $password, $dbname, $log;
            $answerThreadArray = null;
            
            try{
                $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $stmt = $pdo -> prepare("SELECT A.id, A.account_id, A.question_id, A.content, A.date, A.upvotes, A.downvotes, A.best, AC.username, AC.profile_picture_path FROM answers A 
                    JOIN accounts AC ON AC.id = A.account_id 
                    WHERE A.question_id = :id
                    ORDER BY A.upvotes DESC, A.downvotes, A.date DESC;");						
                $stmt -> bindParam(':id', $id);
            
                $stmt -> execute();
                
                // while there is a answer with specified question id
                while($result = $stmt -> fetch()){
                    $a = new Answer();
                    $answerThread = new AnswerThread();
                    $a->setId($result[0]);
                    $a->setAccountId($result[1]);
                    $a->setQuestionId($result[2]);
                    $a->setContent($result[3]);
                    $a->setDate($result[4]);
                    $a->setUpvotes($result[5]);
                    $a->setDownvotes($result[6]);
                    $a->setBest($result[7]);
                    $answerThread->setAnswer($a);
                    $answerThread->setAnswerName($result[8]);
                    $answerThread->setAnswerFileName($result[9]);

                    //get comment thread for this answer
                    $answerThread->setCommentThreadArray(self::getCommentThread($id, 'answer'));
                    $answerThreadArray[] = $answerThread;
                    
                }
                $size = isset($answerThreadArray)?sizeof($answerThreadArray):0;
                self::$log->lwrite("Got all the answer threads. Size of array: $size");
            }
            catch(PDOException $e){
                self::$log->lwrite($e -> getMessage());
            }
            finally{
                unset($pdo);
            }
            // returns the answerThread array
            return $answerThreadArray;
        }

        /**
         * Returns comment thread with the specified  id
         *
         * @param $id		answer or question's id
         * @param $type     string containing 'answer' or 'question'
         */
        private static function getCommentThread($id, $type){
            global $servername, $username, $password, $dbname, $log;
            $commentThreadArray = null;
            
            try{
                $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $sql = "SELECT C.id, C.account_id, C.question_id, C.answer_id, C.content, C.date, AC.username FROM comments C 
                JOIN accounts AC ON AC.id = C.account_id 
                WHERE C.".$type."_id = :id
                ORDER BY C.date ASC;";
                $stmt = $pdo -> prepare($sql);						
                $stmt -> bindParam(':id', $id);
            
                $stmt -> execute();
                
                // while there is a answer with specified question id
                while($result = $stmt -> fetch()){
                    $c = new Comment();
                    $commentThread = new commentThread();
                    $c->setId($result[0]);
                    $c->setAccountId($result[1]);
                    $c->setQuestionId($result[2]);
                    $c->setAnswerId($result[3]);                    
                    $c->setContent($result[4]);
                    $c->setDate($result[5]);
                    $commentThread->setComment($c);
                    $commentThread->setCommentName($result[6]);

                    $commentThreadArray[] = $commentThread;
                    
                }
                $size = isset($commentThreadArray)?sizeof($commentThreadArray):0;
                self::$log->lwrite("Got all the comment threads for Type: $type with ID: $id. Size of array: $size");
            }
            catch(PDOException $e){
                self::$log->lwrite($e -> getMessage());
            }
            finally{
                unset($pdo);
            }
            // returns the commentThread array
            return $commentThreadArray;
        } 

    }

?>