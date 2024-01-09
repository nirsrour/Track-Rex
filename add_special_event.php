<?php
session_start();
include "inc_db.php";

$dog_id = $_REQUEST['d_id'];
$s_datetime = $_REQUEST['s_datetime'];

$key = $_REQUEST['key'];
$value = $_REQUEST['event_name'];

$desc_array = [];
$desc_array['Event'] = $value;
$desc_json = json_encode( $desc_array );


$sql = "INSERT INTO s_event (s_dog_id, s_datetime, s_desc, s_status )
                VALUES ('$dog_id', '$s_datetime','$desc_json', 0 )";
$conn->query( $sql );

$_SESSION['success'] = "Added Successfuly";
header("location:q2_5.php");