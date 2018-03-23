<?php

$config = parse_ini_file('../../config.ini');
	$username = $config['username'];
    $password = $config['password'];
    $dbname = $config['dbname'];
    $servername = $config['servername'];

	$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");

	if(isset($_POST['action']) && isset($_POST['content']) && isset($_POST['commentId'])){		
		
    $sql= "UPDATE comments SET content ='".$_POST['content']."' WHERE id='".$_POST['commentId']."'";

    $result=mysqli_query($conn, $sql);
	}  

?>