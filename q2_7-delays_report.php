<?php
session_start();
include "inc_db.php";
?>

<!DOCTYPE html>
<html lang="he" dir="rtl">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>דף דוחות כלבים</title>
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
    <h1>דו"ח איחורים</h1>
    <br>
    <button onclick="location.href='q2_7.php'">חזרה</button>
    <br>
    <form action="q2_7-delays_report.php" method="post">
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
                            if( isset( $d_id ) && $d_id == $dog['d_id'] ) {
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
        $d_id = $_REQUEST['d_id'];
        // query all the events from the log table
        $sql1 = "SELECT user.u_pname, user.u_fname, log.l_datetime, log.l_desc, e_event.e_dtime, e_event.e_desc  
			 FROM `log` 
             INNER JOIN user ON log.l_user_id=user.u_id 
             INNER JOIN e_event ON log.l_event=e_event.e_id 
             WHERE l_dog_id=$d_id";

        $tableResult = $conn->query($sql1);
        $all_events = $tableResult->fetch_all( MYSQLI_ASSOC );

        // מחשבים את האיחור בדקות
        for ($i = 0; $i < sizeof( $all_events ); $i++ ) {
            $all_events[$i]['time_diff']= 0;

            $date = date('Y-m-d', strtotime($all_events[$i]['l_datetime'])); // 04-06-2023 from 04-06-2023 10:00
            $planned_daytime = strtotime($date . ' ' . $all_events[$i]['e_dtime'] . ':00'); // 04-06-2023 10:00 => 34324234234234
            $actual_daytime = strtotime($all_events[$i]['l_datetime']); // 04-06-2023 10:01 => 34324234234294
            $time_diff = ($actual_daytime - $planned_daytime) / 60;
            $all_events[$i]['time_diff'] = $time_diff;
            $all_events[$i]['l_desc'] = json_decode( $all_events[$i]['l_desc'] );

        }



        $all_events_json = json_encode( $all_events );
    }
    ?>
    <div id="all_events">

    </div>
</div>

</body>


<script>
    <?php if( isset( $all_events_json )) { ?>
    var all_events = JSON.parse( '<?php echo $all_events_json ?>' );

    sortBy('time_diff');
    displayEventTable();
    function displayEventTable() {
        var table = '<table style="width: 100%;" border="0">';
        table += '<tr>';
        table += '<th style="cursor: pointer; color:lawngreen" class="th responsive">#</th>';
        table += '<th  style="cursor: pointer; color:lawngreen" class="th responsive" onclick="sortBy(\'u_pname\')">שם</th>';
        table += '<th  style="cursor: pointer; color:lawngreen" class="th responsive" onclick="sortBy(\'l_datetime\')">תאריך ושעה</th>';
        table += '<th  style="cursor: pointer; color:lawngreen" class="th responsive" onclick="sortBy(\'time_diff\')">איחור(דקות)</th>';
        table += '<th  style="cursor: pointer; color:lawngreen" class="th responsive" onclick="sortBy(\'e_desc\')">שם האירוע</th>';
        table += '<th  style="cursor: pointer; color:lawngreen" class="th responsive" onclick="sortBy(\'desc\')">תיאור</th>';
        table += '</tr>';
        for (var i = 0; i < all_events.length; i++) {
            if (all_events[i].time_diff > 0 ) {
                var desc = "";
                for (const property in all_events[i].l_desc) {
                    desc += property + ':' + all_events[i].l_desc[property] + '<br>';
                }
                all_events[i]['desc'] = desc;
                table += '<tr>';
                table += '<td class="responsive" style="text-align:center;padding:15px;border-bottom:1px solid #ddd;">' + (i + 1) + '</td>';
                table += '<td class="responsive" style="text-align:center;padding:15px;border-bottom:1px solid #ddd;">' + all_events[i].u_pname + ' ' + all_events[i].u_fname + '</td>';
                table += '<td class="responsive" style="text-align:center;padding:15px;border-bottom:1px solid #ddd;">' + all_events[i].l_datetime + '</td>';
                table += '<td class="responsive" style="text-align:center;padding:15px;border-bottom:1px solid #ddd;">' + all_events[i].time_diff + '</td>';
                table += '<td class="responsive" style="text-align:center;padding:15px;border-bottom:1px solid #ddd;">' + all_events[i].e_desc + '</td>';
                table += '<td class="responsive" style="text-align:center;padding:15px;border-bottom:1px solid #ddd;">' + desc + '</td>';
                table += '</tr>';
            }
        }
        table += '</table>';

        document.getElementById('all_events').innerHTML = table;
    }
    <?php
    }
    ?>

    function sortBy( name ) {
        all_events.sort((a,b) => (b[name] > a[name]) ? 1 : ((a[name] > b[name]) ? -1 : 0))
        console.log(all_events);
        displayEventTable();
    }
</script>

</html>
