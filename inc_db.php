<?php
$host="localhost";
$username = "root";
$password = "";
$database="teddy";


$conn = new mysqli($host,$username,$password,$database);
$conn->set_charset("utf8" );
if ($conn->connect_errno) exit;
?>
