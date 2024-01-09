<?php
session_start();
include "inc_db.php";


$success = "";
if ( isset( $_REQUEST['dog_registration'])) {
    $name = $_REQUEST['name'];
    $address = $_REQUEST['address'];

    $key_1 = $_REQUEST['key_1'];
    $value_1 = $_REQUEST['value_1'];
    $desc_arr = [ $key_1 => $value_1 ];

    if ( strlen(  $_REQUEST['key_2']) > 0 && strlen(  $_REQUEST['value_2']) > 0 ) {
        $desc_arr[ $_REQUEST['key_2'] ] = $_REQUEST['value_2'];
    }

    $desc_json = json_encode( $desc_arr ); // [ $key_1 => $value_1 ] ===> {"desc": "funny dog" }

    $sql = "insert into dog (d_name, d_address, d_desc) values('$name', '$address', '$desc_json' )";
    $conn->query( $sql );

    // link between the user and the new dog by adding a relation in u_d MTM table
    $u_id = $_SESSION['u_id'];
    $d_id = $conn->insert_id; // return the d_id of the new dog
    $sql2 = "insert into u_d (u_id, d_id) values ($u_id, $d_id)";
    $conn->query($sql2);

    $success = "הכלב התווסף בהצלחה";
}

?>
<!DOCTYPE>
<html dir="rtl">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>מטלה 2023</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <style>
    h1{
	text-align:center;
	text-shadow: 2px 2px 5px #000000;
	color:white;
	font-family:"Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
	font-size:48px;
	width:100%;

	
}
</style>

</head>
<body>
<h1 style="text-align: center">רישום כלב</h1>
<form action="q2_2.php" method="post">
    <table style="display: flex; justify-content: center; align-items: center;">
        <tr>
            <td colspan="2">
                <?php
                echo $success;
                ?>
            </td>
        </tr>
        <tr>
            <td style="text-align:center;padding:15px;border-bottom:1px solid #ddd;">שם הכלב</td>
            <td style="text-align:center;padding:15px;border-bottom:1px solid #ddd;"><input type="text" name="name"></td>
        </tr>
        <tr>
            <td style="text-align:center;padding:15px;border-bottom:1px solid #ddd;">כתובת הכלב</td>
            <td style="text-align:center;padding:15px;border-bottom:1px solid #ddd;"><input type="text" name="address"></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center;padding:15px;border-bottom:0px solid #ddd;">תכונות הכלב</td>
        </tr>
        <tr>
            <td style="text-align:center;padding:15px;border-bottom:0px solid #ddd;"><input type="text" name="key_1" placeholder="fur-color" required></td>
            <td style="text-align:center;padding:15px;border-bottom:0px solid #ddd;"><input type="text" name="value_1" placeholder="Description value" required></td>
        </tr>
        <tr>
            <td style="text-align:center;padding:15px;border-bottom:1px solid #ddd;"><input type="text" name="key_2" placeholder="eye-color"></td>
            <td style="text-align:center;padding:15px;border-bottom:1px solid #ddd;"><input type="text" name="value_2" placeholder="Description value"></td>
        </tr>
        <tr>
            <td style="text-align:center;padding:15px;border-bottom:0px solid #ddd;"><button type="reset">איפוס</button></td>
            <td style="text-align:center;padding:15px;border-bottom:0px solid #ddd;"><button type="submit" name="dog_registration">הרשמה</button></td>
        </tr>
    </table>
</form>
</body>
</html>