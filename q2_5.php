<?php
session_start();
include "inc_db.php";

if ( !isset( $_SESSION['u_id'])) {
    $_SESSION['thankyou'] = "נא להתחבר למערכת";
    header("location:login.php");
}

$ok = false;
if (isset( $_REQUEST['add_s_event_btn'])) {
    $s_dog_id = $_REQUEST['s_dog_id'];
    $event_name = $_REQUEST['event_name'];
    $s_datetime = $_REQUEST['s_datetime'];

    $arr = [];
    $arr['event'] = $event_name;
    $s_desc = json_encode( $arr );

    $insert = "insert into s_event (s_dog_id , s_datetime, s_desc, s_status) values ($s_dog_id , '$s_datetime', '$s_desc', 0 )";
    $conn->query( $insert );
    $ok = true;
}


?>
<!DOCTYPE html>
<html lang="he">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>התחברות</title>
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
<body dir="rtl">
<div align="center">
<div align="center">
<h1>הוספת אירוע מיוחד</h1>
<?php
	if (isset( $_SESSION['success']) ) {
                    // display the error message
                    echo $_SESSION['success'];
                    // delete 'err' from the session array
                    unset($_SESSION['success']);
                }

	if ($ok) {
	    echo "Event added!";
		}
?>

<form action="add_special_event.php" method="post">
    <table>
        <tr>
            <td>
                בחירת כלב:
            </td>
            <td>
                <?php
                $u_id = $_SESSION['u_id'];
                $select = "select * from dog where d_id in (select d_id from u_d where u_id=$u_id)";
                $result = $conn->query($select );
                ?>
                <select name="s_dog_id">
                <?php
                while ( $dog = $result->fetch_assoc() ) { ?>
                    <option value="<?php echo $dog['d_id'];?>">
                        <?php echo $dog['d_name'];?>
                    </option>
                    <?php
                }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>סוג האירוע:</td>
            <td>
                <select name="event_name">
                    <option value="Vet">Vet</option>
                    <option value="Hair Salon">Hair Salon</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>תאריך ושעה</td>
            <td>
                <input type="datetime-local" name="s_datetime">
            </td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="add_s_event_btn">הוספת אירוע</button></td>
        </tr>
    </table>
</form>
</div>
</div>
</body>

</html>