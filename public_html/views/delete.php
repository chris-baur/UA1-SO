<?php
$config = parse_ini_file('../../config.ini');
	$username = $config['username'];
    $password = $config['password'];
    $dbname = $config['dbname'];
    $servername = $config['servername'];

	$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");
    $sql= "DELETE FROM comments WHERE id='".$_GET['del_id']."'";
    $result=mysqli_query($conn, $sql);
    header('Location:'. $_GET['page']);

?>