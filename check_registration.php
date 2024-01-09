<?php
session_start();
include "inc_db.php";

// get all the data from the form
$login = $_REQUEST['login']; // ['login' => 'Nir' , 'password' => '1212' ]
$pname = $_REQUEST['pname'];
$fname = $_REQUEST['fname'];
$pass = $_REQUEST['password'];
$email = $_REQUEST['mail'];
$phone = $_REQUEST['phone'];

// check if a user with the same u_login OR u_mail exist
$sql = "select * from user where u_login='$login' or u_mail='$email'";

// select * from user where u_login='gk' and u_password='123';
$result = $conn->query( $sql );

if ( $result->num_rows == 0 ) {
    $sql = "insert into user (u_login, u_pname, u_fname , u_password, u_phone , u_mail, u_owner ) values('$login', '$pname', '$fname', '$pass', '$phone', '$email', 0 )";
    $conn->query($sql);

    $_SESSION['success'] = "Registrated Successfuly";
    header("location:login.php");
} else {
    $_SESSION['err'] = "Error with Registration ";
    header("location:q2_1.php");
}