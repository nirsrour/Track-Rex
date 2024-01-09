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
<h1>דו"ח בונוסים</h1>
<br>
<button onclick="location.href='q2_7.php'">חזרה</button>
<br>
<form action="q2_7-bonuses_report.php" method="post">
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
<div id="log_table">

</div>
<?php
if(isset( $_REQUEST['d_id'])) {
    $d_id = $_REQUEST['d_id'];

    $result = $conn->query("SELECT * FROM dog WHERE d_id=$d_id");
    $dog = $result->fetch_array( MYSQLI_ASSOC );

    $sql1 = "SELECT `user`.u_pname, `user`.u_fname, log.l_user_id, count(l_id) as counter, e_event.e_desc FROM `log` 
             LEFT JOIN `user` ON log.l_user_id=`user`.u_id 
             LEFT JOIN `e_event` ON log.l_event=e_event.e_id 
             WHERE l_dog_id=$d_id
             GROUP BY log.l_user_id";

    $result = $conn->query($sql1);
    $data = $result->fetch_all( MYSQLI_ASSOC );
    $json = json_encode( $data ); // convert the array into JSON string

    ?>
    <script>
        // JS JSON.parse, PHP json_decode
        // JS JSON.stringify, PHP json_encode
        var data = JSON.parse( '<?php echo $json; ?>' ); // [ [], ]

        console.log( data );

        var dog_name = '<?php echo $dog['d_name'];?>';
        displayTable();

        function displayTable() {
            var table = '<h2>' + dog_name + '</h2>';
            table += '<table style="width: 100%;" border="0">';
            table += '<tr>';
            table += '<th class="th responsive" title="לחץ למיון" style="cursor: pointer; color:lawngreen" onclick="sortByAsc(\'u_pname\')">שם המשתמש</th>';
            table += '<th class="th responsive" title="לחץ למיון" style="cursor: pointer; color:lawngreen" onclick="sortByAsc(\'d_name\')">שם הכלב</th>';
            table += '<th class="th responsive" title="לחץ למיון" style="cursor: pointer; color:lawngreen" onclick="sortByAsc(\'e_desc\')">שם הפעילות</th>';
            table += '<th class="th responsive" title="לחץ למיון" style="cursor: pointer; color:lawngreen" onclick="sortByDesc(\'counter\')">כמות הפעילויות</th>';
            table += '</tr>';

            for (var i = 0; i < data.length; i++) {
                table += '<tr>';
                table += '<td class="responsive" style="text-align:center;padding:15px;border-bottom:1px solid #ddd;">' + data[i].u_pname + ' ' + data[i].u_fname + '</td>';
                table += '<td class="responsive" style="text-align:center;padding:15px;border-bottom:1px solid #ddd;">' + dog_name + '</td>';
                table += '<td class="responsive" style="text-align:center;padding:15px;border-bottom:1px solid #ddd;">' + data[i].e_desc + '</td>';
                table += '<td class="responsive" style="text-align:center;padding:15px;border-bottom:1px solid #ddd;">' + data[i].counter + '</td>';
                table += '<tr>';
            }
            table += '</table>';
            document.getElementById('log_table').innerHTML = table;
        }

        function sortByAsc( name ) {
            data.sort((a,b) => (a[name] > b[name]) ? 1 : ((b[name] > a[name]) ? -1 : 0))
            console.log(data);
            displayTable();
        }

        function sortByDesc( name ) {
            data.sort((b,a) => (a[name] > b[name]) ? 1 : ((b[name] > a[name]) ? -1 : 0))
            console.log(data);
            displayTable();
        }
    </script>
    <?php
}
?>
</body>
</html>