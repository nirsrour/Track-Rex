<?php
session_start();
include "inc_db.php";

$u_id = $_REQUEST['u_id']; // hidden field

$conn->query("DELETE FROM u_d WHERE u_id=$u_id");
$conn->query("DELETE FROM `log` WHERE l_user_id=$u_id");
$conn->query("DELETE FROM `user` WHERE u_id=$u_id");


$_SESSION['success'] = "בן משפחה נמחק בהצלחה.";
header("location:q2_4.php");
