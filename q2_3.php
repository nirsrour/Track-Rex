<?php
session_start();
include "inc_db.php";
?>
<!DOCTYPE>
<html dir="rtl">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Register</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="script.js"></script>
    <style>
    h1{
	text-align:center;
	text-shadow: 2px 2px 5px #000000;
	color:white;
	font-family:"Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
	font-size:48px;
	width:100%;
	
}

	td{
	
	text-align:center;
	padding:10px;
	border-bottom:1px solid #ddd;
}
</style>
</head>
<body>
<h1>רישום בן משפחה</h1>
<form action="check_family_registration.php" method="post">
    <table style="display: flex; justify-content: center; align-items: center;">
        <tr>
            <td colspan="2" style="text-align:center;padding:0px;border-bottom:0px solid #ddd;color:red" >
                <?php
                // check if 'err' key exist in $_SESSION
                if (isset( $_SESSION['err']) ) {
                    // display the error message
                    echo $_SESSION['err'];
                    // delete 'err' from the session array
                    unset($_SESSION['err']);
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>שם משתמש</td>
            <td><input type="text" name="login"></td>
        </tr>
        <tr>
            <td>שם פרטי</td>
            <td><input type="text" name="pname"></td>
        </tr>
        <tr>
            <td>שם משפחה</td>
            <td><input type="text" name="fname"></td>
        </tr>
        <tr>
            <td>סיסמה</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td>טלפון</td>
            <td><input type="text" name="phone"></td>
        </tr>
        <tr>
            <td>אימיייל</td>
            <td><input type="text" name="mail"></td>
        </tr>
        <tr>
            <td>בחירת כלב</td>
            <td>
                <?php
                // get all user's dogs using the u_d table
                $u_id = $_SESSION['u_id'];
                $sql = "select d_id from u_d where u_id=$u_id";
                $result = $conn->query( $sql );
                // the user has at least one dog
                if ( $result->num_rows > 0 ) { ?>
                <select name="d_id">
                    <?php
                    while ( $row = $result->fetch_assoc() ) {
                        $d_id = $row['d_id'];
                        $sql1 = "select * from dog where d_id=$d_id";
                        $result1 = $conn->query( $sql1 );
                        $dog = $result1->fetch_assoc();
                        echo '<option value="' . $dog['d_id'] . '">' . $dog['d_name'] . '</option>';
                    }
                }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <td style="text-align:center;padding:5px;border-bottom:0px solid #ddd;"><button type="reset">איפוס</button></td>
            <td style="text-align:center;padding:5px;border-bottom:0px solid #ddd;"><button type="submit">הוספה</button></td>
        </tr>
    </table>
</form>
</body>
</html>
