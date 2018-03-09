<?php

session_start();
session_destroy();
header('Location: ..\..\public_html\home_page\homepage.php');

?>