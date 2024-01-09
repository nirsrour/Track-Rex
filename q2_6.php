<?php
session_start();
include "inc_db.php";
?>

<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <script src="script.js"></script>
    <title>דף רישום בעל כלב</title>
    <style>
    h1,h2{
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
<h1>אירועים יומיים</h1>
<?php
if ( isset( $_SESSION['message'] )) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
?>
<form action="q2_6.php" method="post">
    <tr>
        <td>בחירת כלב</td>
        <td>
            <select name="d_id">
                <?php
                $u_id = $_SESSION['u_id'];
                $res = $conn->query( "SELECT * FROM dog WHERE d_id IN ( SELECT d_id FROM u_d WHERE u_id=$u_id)" );
                while ( $dog = $res->fetch_array(  ) ) { ?>
                    <option value="<?php echo $dog['d_id'];?>">
                        <?php echo $dog['d_name'];?>
                    </option>
                    <?php
                }
                ?>
            </select>
        </td>
        <td><input type="submit" name="display" value="הצג אירועים יומיים"></td>
    </tr>
</form>

<br>
<?php
// if the user select a dog and click the submit button
if (isset( $_REQUEST['d_id'] ) ) {
    $d_id = $_REQUEST['d_id'];
    // select all dog's events
    $result = $conn->query("SELECT * FROM `e_event` WHERE e_dog_id=$d_id ORDER BY e_dtime ASC");
    if ( $result->num_rows > 0 ){
        while ( $event = $result->fetch_array() ) {
            ?>
            <form action="add_update_daily_event.php" method="post">
                <table>
                    <tr>
                        <td><input type="text" name="e_desc" value="<?php echo $event['e_desc'];?>"></td>
                        <td><input type="text" name="e_dtime" value="<?php echo $event['e_dtime'];?>"></td>
                        <td><input type="hidden" name="e_id" value="<?php echo $event['e_id'];?>"></td>
                        <td><input type="hidden" name="d_id" value="<?php echo $d_id;?>"></td>
                        <td><input type="submit" name="update_daily_event" value="עידכון"></td>
                    </tr>
                </table>
            </form>
            <?php
        }
    } else {
        echo "אין אירועים להציג";
    }
}
?>
<h2>הוספת אירוע יומי</h2>
<form action="add_update_daily_event.php" method="post">
    <table>
        <tr>
            <td colspan="5">
                <?php
                if ( isset( $_SESSION['success'] )) {
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                }
                ?>
            </td>
        </tr>
        <tr>
            <td><input type="text" name="e_desc"></td>
            <td><input type="text" name="e_dtime"></td>
            <td>
                <select name="d_id">
                    <?php
                    $u_id = $_SESSION['u_id'];
                    $res = $conn->query( "select * from dog where d_id IN ( SELECT d_id FROM u_d WHERE u_id=$u_id)" );
                    while ( $dog = $res->fetch_array( MYSQLI_ASSOC )) { ?>
                        <option value="<?php echo $dog['d_id'];?>">
                            <?php echo $dog['d_name'];?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </td>
            <td><input type="submit" name="add_daily_event" value="הוספה"></td>
        </tr>
    </table>
</form>
</body>
</html>