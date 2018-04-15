<?php

$config = parse_ini_file('..\..\config.ini');

	$servername = $config['servername'];
	$username = $config['username'];
	$password = $config['password'];
	$dbname = $config['dbname'];
class Vote{	

	private $former_vote;

	private function recordExists($ref,$ref_id){

		global $servername, $username, $password, $dbname;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$req = $pdo->prepare("SELECT * FROM $ref WHERE id=?");
			$req->execute(array($ref_id));
			if($req->rowCount()==0){
				throw new Exception("Impossible to vote for a question that does not exist");
			}
			return $pdo;
		}
		catch(PDOException $e){
			throw new Exception("Could not connect to server.");
		}	

	}

	public function like($ref,$ref_id,$user_id){
		global $servername, $username, $password, $dbname;
		
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			if($this->voting($ref,$ref_id,$user_id,1)){
				$sql_part="";
				if($this->former_vote){
					$sql_part=", downvotes=downvotes-1";
				}
				$pdo->query("UPDATE $ref SET upvotes=upvotes+1 $sql_part WHERE id= $ref_id");
				return true;
			}else{
				$pdo->query("UPDATE $ref SET upvotes=upvotes-1 WHERE id= $ref_id");
			}
			return false;
		}catch(PDOException $e){
			throw new Exception("Could not connect to server.");
			}	
		
	}
	public function dislike($ref,$ref_id,$user_id){			
		global $servername, $username, $password, $dbname;

		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			if($this->voting($ref,$ref_id,$user_id,-1)){
				$sql_part="";
				if($this->former_vote){
					$sql_part=", upvotes=upvotes-1";
				}
				$pdo->query("UPDATE $ref SET downvotes=downvotes+1 $sql_part WHERE id= $ref_id");
				return true;
			}else{
				$pdo->query("UPDATE $ref SET downvotes=downvotes-1 WHERE id= $ref_id");
			}
			return false;
			}catch(PDOException $e){
				throw new Exception("Could not connect to server.");
			}	
		
	}

	private function voting($ref,$ref_id,$user_id,$vote){
		$pdo=$this-> recordExists($ref,$ref_id);	
			$req = $pdo->prepare("SELECT id, vote FROM  votes WHERE ref=? AND ref_id=? AND user_id=?");
			$req->execute([$ref,$ref_id,$user_id]);
			$vote_row= $req-> fetch();
			if($vote_row){
				if($vote_row['vote'] == $vote){

					$pdo->query('DELETE FROM votes WHERE id='.$vote_row['id']);
					return false;
				}
				$this->former_vote = $vote_row;
				$pdo->prepare("UPDATE votes SET vote=? WHERE id={$vote_row['id']}") -> execute([$vote]);
				return true;
			}
			$req = $pdo->prepare("INSERT INTO votes SET ref=?, ref_id=?, user_id=?,vote=$vote");
			$req->execute([$ref,$ref_id,$user_id]);
			return true;
	}

	/**
	*	Allow to add a new class is-liked or is-disliked after a register
	* @param $vote mixed false/PDORow
	*/
	public static function getClass($vote){

		if($vote){
			return $vote['vote'] == 1 ? 'is-liked': 'is-disliked';
		}
		return null;
	}

	public function updateCount($ref,$ref_id){

		global $servername, $username, $password, $dbname;
		try{
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$req= $pdo->prepare("SELECT COUNT(id) as count, vote FROM votes WHERE ref=? AND ref_id=? GROUP BY vote");
			$req->execute([$ref,$ref_id]);
			$votes=$req->fetchAll();
			$counts = [
				'-1'=>0,
				'1' =>0
			];
			foreach ($votes as $vote) {
				$counts[$votes['vote']]= $vote['count'];
			}
			$req = $pdo->query("UPDATE $ref SET upvotes={$counts[1]}, downvotes = {$counts[-1]} WHERE id =$ref_id");
			return true;

			}
			catch(PDOException $e){
				throw new Exception("Could not connect to server.");
		}	


	}
}