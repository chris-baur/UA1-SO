
<?php 
$status = session_status();
	if($status == PHP_SESSION_NONE){
		//There is no active session
		session_start();
	}

if($_SERVER['REQUEST_METHOD'] != 'POST'){
	http_response_code(403);
	die();
}

require 'Vote.php';
$vote= new Vote();
if($_GET['vote']==1){
	$vote ->like('questions',$_GET['ref_id'],$_SESSION['userid']);
}else{
	$vote->dislike('questions',$_GET['ref_id'],$_SESSION['userid']);
}

header('Location: ../../public_html/home_page/'. $_GET['page']);