<?php
session_start();
include "inc_db.php";

//print_r( $_REQUEST );

$login = $_REQUEST['login']; 
$pass = $_REQUEST['password']; 
$sql = "select * from user where u_login='$login' and u_password='$pass'";
// select * from user where u_login='gk' and u_password='123';
$result = $conn->query( $sql );

if ( $result->num_rows == 1 ) {
    // success login
    $row = $result->fetch_assoc(); // returns one row from the query result

    // after login, save some data about the user
    $_SESSION['u_id'] = $row['u_id'];
    $_SESSION['u_pname'] = $row['u_pname'];
    $_SESSION['u_fname'] = $row['u_fname'];
    $_SESSION['u_owner'] = $row['u_owner'];

    header("location:main.php");

} else {
    // login failed
    $_SESSION['err'] = "Wrong login or password";
    // $err = "ההתחברות נכשלה";
    header("location:login.php");
}
