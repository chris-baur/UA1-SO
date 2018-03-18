<?php

$status = session_status();
if($status == PHP_SESSION_NONE){
	//There is no active session
	session_start();					
}		 

$uploaddir = '../img/accounts/';
$newfilename = $_SESSION['username'];
$uploadfile =  $uploaddir. $newfilename. '.png';
$_SESSION['name'] =  $uploadfile;

echo "<p>";

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
  echo "File is valid, and was successfully uploaded.\n";
} else {
   echo "Upload failed";
}

header('Location: profile.php'); 

echo "</p>";
echo '<pre>';
echo 'Here is some more debugging info:';
print_r($_FILES);
print "</pre>";

?> 