<?php
include '..\..\private\util\logging.php';
include '..\..\private\util\sets.php';
include '..\..\private\models\Question.php';
include '..\..\private\models\Account.php';
include '..\..\private\models\Answer.php';
include '..\..\private\models\Comment.php';
$config = parse_ini_file('..\..\..\UA1-SO\config.ini');

$servername = $config['servername'];
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];

$log = new Logging();

	/**
	* Adds a comment to the comment table in the Database
	*
	* @param $comment		comment object
	*/
	function addcomment($comment){
		global $servername, $username, $password, $dbname, $log;
		$comment_id = 0;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $stmt = $pdo -> prepare('INSERT INTO comments(account_id, header, content, date, upvotes, downvotes, tags) VALUES(:account_id, :header, :content, :date, :upvotes, :downvotes, :tags);');
                //@TODO complete function
										
			$stmt -> bindParam(':account_id', $comment->getAccountId());
			$stmt -> bindParam(':header', $comment->getHeader());
			$stmt -> bindParam(':content', $comment->getContent());
            $stmt -> bindParam(':date', $comment->getDate());
            $stmt -> bindParam(':upvotes', $comment->getUpvotes());
            $stmt -> bindParam(':downvotes', $comment->getDownvotes());
            $stmt -> bindParam(':tags', $comment->getTags());
			
			$stmt -> execute();
            $comment_id = $pdo -> lastInsertId();
            $log->lwrite('added comment succesfully. ID: '.$comment_id);
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		return $comment_id;
    }

   
			
			// while there is a comment with specified account id
			while($result = $stmt -> fetch()){
                $c = new comment();

				$c->setId($result[0]);
                $c->setAccountId($result[1]);
                $c->setHeader($result[2]);
                $c->setContent($result[3]);
                $c->setDate($result[4]);
                $c->setUpvotes($result[5]);
                $c->setDownvotes($result[6]);
                $c->setTags($result[7]);

                $commentArray[] = $c;
			}
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		// returns the comment array
		return $commentArray;
    }
    
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, header, content, date, upvotes, downvotes, tags FROM comments WHERE content LIKE '%:content%';");						
			$stmt -> bindParam(':content', $content);
		
			$stmt -> execute();
			
            // while there is comment with specified content
            while($result = $stmt -> fetch()){
                $c = new Comment();

				$c->setId($result[0]);
                $c->setAccountId($result[1]);
                $c->setHeader($result[2]);
                $c->setContent($result[3]);
                $c->setDate($result[4]);
                $c->setUpvotes($result[5]);
                $c->setDownvotes($result[6]);
                $c->setTags($result[7]);

                $commentArray[] = $c;
			}
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		// returns the comment array
		return $commentArray;
	}
    
    /**
	 * Returns comment with the specified header
	 *
	 * @param $header		comment's header
	 */
	function getcommentByHeader($header){
		global $servername, $username, $password, $dbname, $log;
        $comment = new comment();
        $commentArray = [];
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

			$stmt = $pdo -> prepare("SELECT id, account_id, header, content, date, upvotes, downvotes, tags FROM comments WHERE header LIKE '%:header%';");						
			$stmt -> bindParam(':header', $header);
		
			$stmt -> execute();
			
			// while there is a comment with specified header
			while($result = $stmt -> fetch()){
                $c = new Comment();

				$c->setId($result[0]);
                $c->setAccountId($result[1]);
                $c->setHeader($result[2]);
                $c->setContent($result[3]);
                $c->setDate($result[4]);
                $c->setUpvotes($result[5]);
                $c->setDownvotes($result[6]);
                $c->setTags($result[7]);

                $commentArray[] = $c;
			}
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
		// returns the comments array
		return $commentArray;
	}

	/**
	* Updates a comment in the comment table of the Database
	*
	* @param $comment		comment object
	*/
	function updateComment($comment){
		global $servername, $username, $password, $dbname, $log;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $stmt = $pdo -> prepare('UPDATE comments set header = :header, content = :content, upvotes = :upvotes, downvotes = :downvotes, tags = :tags
                WHERE id = :id;');
										
			$stmt -> bindParam(':header', $comment->getHeader());
			$stmt -> bindParam(':content', $comment->getContent());
            $stmt -> bindParam(':upvotes', $comment->getUpvotes());
            $stmt -> bindParam(':downvotes', $comment->getDownvotes());
            $stmt -> bindParam(':tags', $comment->getTags());
            $stmt -> bindParam(':id', $comment->getId());
			
			$stmt -> execute();
            $log->lwrite('Updated Comment succesfully. ID: '. $comment->getId());
		}
		catch(PDOException $e){
			$log->lwrite($e -> getMessage());
		}
		finally{
			unset($pdo);
		}
    }
    
?>