<?php
session_start();
include "inc_db.php";
?>
<!DOCTYPE html>
<html dir="rtl" >

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js"></script>
    <title>Delete Family Member</title>
    <link rel="stylesheet" href="style.css">
    <style>h1{
	text-align:center;
	text-shadow: 2px 2px 5px #000000;
	color:white;
	font-family:"Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
	font-size:48px;
	width:100%;

	
}
</style>
</head>


<body style="justify-content: center; align-items: center;">
<?php
$u_id = $_SESSION['u_id'];
// get all user's dogs
$result = $conn->query("SELECT d_id FROM dog WHERE d_id IN (SELECT d_id FROM u_d WHERE u_id=$u_id)");

$d_ids = "";
while ( $dog = $result->fetch_array()) {
    $d_ids .= $dog['d_id'].',';
}
$d_ids = substr($d_ids, 0 ,-1);
//echo $d_ids;
$users_result = $conn->query("SELECT * FROM `user` WHERE u_owner=1 AND u_id IN (SELECT u_id FROM u_d WHERE d_id IN ($d_ids))");
?>
<h1 style="text-align: center">רשימת בני המשפחה</h1><br>

<table class="ReportsTable" style="display: flex; justify-content: center; align-items: center; >
    <tr>
        <td colspan="5" style="color:green">
            <?php
            // check if 'err' key exist in $_SESSION
            if (isset( $_SESSION['success']) ) {
                // display the error message
                echo $_SESSION['success'];
                // delete 'err' from the session array
                unset($_SESSION['success']);
            }
           ?> 
        </td>
    </tr>
    <tr style="text-align:center;color:lawngreen;">
        <td style="font-size:large"><strong>#</strong></td>
        <td style="font-size:large;font-family:Tahoma"><strong>שם מלא</strong></td>
        <td style="font-size:large;font-family:Tahoma"><strong>טלפון</strong></td>
        <td style="font-size:large;font-family:Tahoma"><strong>רשימת כלבים מטופלים</strong></td>
        <td>&nbsp;</td>
    </tr>
    <?php
    $counter = 1;
    while ( $user = $users_result->fetch_assoc() ) {
        $user_id = $user['u_id'];
        $result1 = $conn->query("SELECT * FROM dog WHERE d_id IN (SELECT d_id FROM u_d WHERE u_id=$user_id)");

        ?>
        <tr>
            <td style="text-align:center;padding:15px;border-bottom:1px solid #ddd;"><?php echo $counter++; ?></td>
            <td style="text-align:center;padding:15px;border-bottom:1px solid #ddd;"><?php echo $user['u_pname'] . ' ' . $user['u_fname'];?></td>
            <td style="text-align:center;padding:15px;border-bottom:1px solid #ddd;"><?php echo $user['u_phone']; ?></td>
            <td style="text-align:center;padding:15px;border-bottom:1px solid #ddd; text-align:rtl">
                <?php
                while ($dog = $result1->fetch_assoc()){
                    echo $dog['d_name'].' ';
                }
                ?>
            </td>
            <td>
                <form action="check_delete_family_member.php" method="post" onsubmit="return confirm('האם למחוק משתמש זה?')">
                    <button type="submit"><?php ?>מחיקה</button>
                    <input type="hidden" name="u_id" value="<?php echo $user['u_id'];?>">
                </form>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
</body>


</html>