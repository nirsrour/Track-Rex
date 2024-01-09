<?php
session_start();
include "inc_db.php";

$data = json_decode( $_REQUEST['data' ]) ;
$u_id = $_SESSION['u_id'];
$d_id = $data->dog_id;
$e_id = $data->event_id;
$desc = $data->desc;

$conn->query("INSERT INTO log(l_dog_id , l_user_id , l_event, l_datetime, l_desc) VALUES ($d_id, $u_id, $e_id, CURRENT_TIMESTAMP(), '$desc' )");
echo "ok";