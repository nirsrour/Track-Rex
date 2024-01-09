<?php
session_start();
include "inc_db.php";

// get all the data from the form
$login = $_REQUEST['login']; 
$pname = $_REQUEST['pname'];
$fname = $_REQUEST['fname'];
$pass = $_REQUEST['password'];
$email = $_REQUEST['mail'];
$phone = $_REQUEST['phone'];
$d_id = $_REQUEST['d_id'];

// check if a user with the same u_login OR u_mail exist
$sql = "select * from user where u_login='$login' or u_mail='$email'";

// select * from user where u_login='gk' and u_password='123';
$result = $conn->query( $sql );

if ( $result->num_rows == 0 ) {
    $sql = "insert into user (u_login, u_pname, u_fname , u_password, u_phone , u_mail, u_owner ) values('$login', '$pname', '$fname', '$pass', '$phone', '$email', 1 )";
    $conn->query($sql);

    // link between the user and the new dog by adding a relation in u_d MTM table
    $u_id = $conn->insert_id;
    $sql2 = "insert into u_d (u_id, d_id) values ($u_id, $d_id)";
    $conn->query($sql2);

    $_SESSION['success'] = "Registrated Successfully";
    header("location:q2_4.php");
} else {
    $_SESSION['err'] = "Error with Registration!";
    header("location:q2_3.php");
}