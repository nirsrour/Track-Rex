<?php
session_start();
include "inc_db.php";

$message = "";
?>
<!DOCTYPE html>
<html lang="he" dir="rtl">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>דו"ח פעילויות</title>
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
<h1>דו"ח פעילויות</h1>
<br>
<button onclick="location.href='q2_7.php'">חזרה</button>
<br>
<form action="q2_7-activities_report.php" method="post">
    <table>
        <tr>
            <td>שם הכלב:</td>
            <td>
                <select name="d_id">
                    <option value="0">בחר</option>
                    <?php
                    $u_id = $_SESSION['u_id'];
                    $select = "SELECT * FROM dog WHERE d_id IN (SELECT d_id FROM u_d WHERE u_id=$u_id)";
                    $result = $conn->query($select);
                    while( $dog = $result->fetch_assoc() ) {
                        if( isset( $_REQUEST['d_id'] ) && $_REQUEST['d_id'] == $dog['d_id'] ) {
                            echo '<option value="' . $dog['d_id'] . '" selected="selected">' . $dog['d_name'] . '</option>';
                        }else {
                            echo '<option value="' . $dog['d_id'] . '">' . $dog['d_name'] . '</option>';
                        }
                    }
                    ?>
                </select>
                <button type="submit">הצג דו"ח</button>
            </td>
        </tr>
    </table>
</form>
<?php
// check if the form was submitted
if(isset( $_REQUEST['d_id'])) {
    $current_year = date('Y');
    $current_month = date('m');


    $d_id = $_REQUEST['d_id'];

    $result = $conn->query("SELECT * from dog WHERE d_id=$d_id");
    $dog = $result->fetch_assoc();

    // query all the events from the log table
    $sql1 = "SELECT user.u_pname, user.u_fname, log.l_datetime, e_event.e_desc  
                                     FROM `log` 
                                     INNER JOIN user ON log.l_user_id=user.u_id 
                                     INNER JOIN e_event ON log.l_event=e_event.e_id 
                                     WHERE l_dog_id=$d_id ORDER BY log.l_datetime";

    $result = $conn->query($sql1);
}
?>
    <table style="width: 100%; margin-top: 30px;" border="0">
        <tr>
            <th class="responsive" style="color:lawngreen">שם הכלב</th>
            <th class="responsive" style="color:lawngreen">שם המשתמש</th>
            <th class="responsive" style="color:lawngreen">תיאור האירוע</th>
            <th class="responsive" style="color:lawngreen">תאריך ושעה</th>
        </tr>
        <?php
        while ($row = $result->fetch_array( MYSQLI_ASSOC ) ) { ?>
            <tr>
                <td class="responsive" style="text-align:center;padding:15px;border-bottom:1px solid #ddd;"><?php echo $dog['d_name'];?></td>
                <td class="responsive" style="text-align:center;padding:15px;border-bottom:1px solid #ddd;"><?php echo $row['u_pname'] . ' ' . $row['u_fname'];?></td>
                <td class="responsive" style="text-align:center;padding:15px;border-bottom:1px solid #ddd;"><?php echo $row['e_desc'];?></td>
                <td class="responsive" style="text-align:center;padding:15px;border-bottom:1px solid #ddd;"><?php echo $row['l_datetime'];?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</body>

</html>