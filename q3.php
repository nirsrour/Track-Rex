<?php
session_start();
include "inc_db.php";
?>
<!DOCTYPE>
<html dir="rtl">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>מטלה 2023</title>
    <link rel="stylesheet" href="style.css">
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
<h1> עידכון אירועים יומיים</h1>
<form action="q3.php" method="post">
    <table>
        <tr>
            <td>בחירת כלב</td>
            <td>
                <select name="d_id">
                    <?php
                    $u_id = $_SESSION['u_id'];
                    $res = $conn->query( "SELECT * FROM dog WHERE d_id IN ( SELECT d_id FROM u_d WHERE u_id=$u_id)" );
                    while ( $dog = $res->fetch_array( MYSQLI_ASSOC )) { ?>
                        <option value="<?php echo $dog['d_id'];?>">
                            <?php echo $dog['d_name'];?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
                <button type="submit">בחירת כלב</button>
            </td>
        </tr>
    </table>
</form>
<?php
if (isset($_REQUEST['d_id']) ) {
    $d_id = $_REQUEST['d_id'];
    $res = $conn->query("SELECT * FROM `e_event` WHERE e_dog_id=$d_id ORDER BY e_dtime");
    if ($res->num_rows > 0) {
        ?>
        <table border="0" style="width: 100%; text-align: center">
            <tr>
            <?php
            while ($event = $res->fetch_assoc()) {
                // check if this event already completed
                $l_event = $event['e_id'];
                $current_date = date('Y-m-d'); // 2023-06-15
                // האם האירוע בוצע על הכלב שנבחר היום
                $select = "SELECT * FROM log WHERE l_dog_id=$d_id AND l_event=$l_event AND DATE(l_datetime)='$current_date'";
                $res1 = $conn->query( $select );
                $class = "";
                if( $res1->num_rows > 0 ){
                    $class = " completed";
                }
                ?>
            <td style="width: <?php echo 100/$res->num_rows;?>%;">
                <div class="circle<?php echo $class?>" onclick="display_form(<?php echo $l_event;?>)">
                <?php echo $event['e_desc'];?>
                </div>
                <div style="display: none;" id="event_<?php echo $l_event;?>">

                    <input type="text" id="description_<?php echo $l_event;?>" placeholder="Details on event">
                    <br>
                    <button onclick="ajax_daily_event(<?php echo $d_id; ?>, <?php echo $l_event;?>)">עידכון</button>
                </div>
            </td>
            <?php
            }
            ?>
            </tr>
        </table>
    <?php
    }
}
?>

<script>
    function display_form( event_id ) {
        if (document.getElementById('event_'+event_id).style.display === "block"){
            document.getElementById('event_'+event_id).style.display = "none";
        } else {
            document.getElementById('event_'+event_id).style.display = "block";
        }
    }

    function ajax_daily_event( dog_id, event_id ) {
        if (document.getElementById('description_'+event_id).value.length > 0 ) {
            // create AJAX object
            var xhr = new XMLHttpRequest();
            // callback function - waiting for a response from php file
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status === 200 ) {
                    alert("אירועי יומי התווסף.");
                    window.location.reload();
                }
            };
            var data = {
                dog_id: dog_id,
                event_id: event_id,
                desc: document.getElementById('description_' + event_id).value
            }
            data = JSON.stringify(data);
            // open request
            xhr.open("GET", "ajax_add_daily_event.php?data=" + data, true);	// Clean the table from this talk
            xhr.send();
        } else {
            alert("נא לרשום את תיאור האירוע");
        }
    }
</script>
</body>
</html>
