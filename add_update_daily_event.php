<?php
session_start();
include "inc_db.php";

if (isset( $_REQUEST['update_daily_event'])) {
    $e_desc = $_REQUEST['e_desc'];
    $e_dtime = $_REQUEST['e_dtime'];
    $e_id = $_REQUEST['e_id']; // hidden value
    $d_id = $_REQUEST['d_id']; // hidden value

    $update = "UPDATE e_event SET e_desc='$e_desc', e_dtime=$e_dtime WHERE e_id=$e_id";
    $conn->query($update);
    $_SESSION['success'] = "אירוע יומי עודכן";
    header("location:q2_6.php?d_id=$d_id");
}

if (isset( $_REQUEST['add_daily_event'])) {
    $e_dog_id = $_REQUEST['d_id'];
    $e_desc = $_REQUEST['e_desc'];
    $e_dtime = $_REQUEST['e_dtime'];
    $insert = "INSERT INTO e_event (e_dog_id, e_desc, e_dtime) VALUES($e_dog_id, '$e_desc', $e_dtime )";
    $conn->query($insert);
    $_SESSION['successs'] = "אירוע יומי התווסף";
    header("location:q2_6.php?d_id=$e_dog_id");
}