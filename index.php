<?php
session_start();
?>
<!DOCTYPE>
<html dir="rtl">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exe 3-Teddy</title>
    <link rel="stylesheet" type="text/css" href="style.css" media="all">
    <style>
		body {
		background-image: url('light-grey-terrazzo.png');
		background-repeat: no-repeat;
		background-size: cover;
		}
		  
		  
    .headline{
	text-align:center;
	text-shadow: 2px 2px 5px #000000;
	color:white;
	font-family:"Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
	font-size:48px;
	width:100%;

	
}


		
		iframe {
		background-color: transparent;
		}

        #maindata {
            border:0px #666 solid;
            height:80vh;
        }
        .action {
		  border: none;
		  border-style:groove;
		  color: black;
		  padding: 4px 4px;
		  text-align: center;
		  text-decoration: none;
		  display:  inline-block;
		  font-size: 16px;
		  margin: 5px 5px;
		  cursor: pointer;
		  alignment-adjust:central;

        }
        .action:hover {
            background: #CCD1D1 ;
			color: #555555;
			box-shadow: 0px 0px 5px #888888;
			cursor:pointer;
        }
        
        .action:focus{
			outline: none;
  			box-shadow: 0 0 5px #0099FF;
		}

        #myiframe {
            width:100%;
            height:100%;
        }
    </style>
    
    <script type="text/javascript">
        // Conver month and day to 2 digits with leading zero

        function to2(t){ return (t<10 ? "0"+t : t );}

        // Get the personal computer date using JavaScript
        // YYYY-MM-DD hh:mm:ss
        function get_today()
        {
            d = new Date();
            var today = new Date();
            return today.getFullYear()+'-'+to2(today.getMonth()+1)+'-'+to2(today.getDate())+" "+
                to2(today.getHours()) + ":" +to2(today.getMinutes()) + ":" + to2(today.getSeconds());
        }

    </script>


</head>

<body>

<table style="width: 100%; height:70px;">
    <tr>
        <th></th>
        <th style="direction:rtl; width: 1643px;" class="headline" >מערכת לניהול כלבי המשפחה</th>
        <th style="width: 107px">D-4</th>
        <th>ת.ז. :313294993 </th>
        <th style="width:20%;">ניר סרור</th>
    </tr>
</table>

<table style="width: 100%">
    <tr>
        <td id="menu" style="vertical-align:top; width:200px">

            <table id="subtable" style="width: 100%; height: 156px;">
                <tr>
                    <td class="action" onclick="document.getElementById('myiframe').src='login.php'">התחברות למערכת</td>
                </tr>
                               <tr>
                    <td class="action" onclick="document.getElementById('myiframe').src='q2_1.php'">רישום בעלים חדש</td>
                </tr>
                               <tr>
                    <td class="action" onclick="document.getElementById('myiframe').src='q2_2.php'">רישום כלב חדש</td>
                </tr>
                                <tr>
                    <td class="action" onclick="document.getElementById('myiframe').src='q2_3.php'">הוספת בן משפחה</td>
                </tr>
                                <tr>
                    <td class="action" onclick="document.getElementById('myiframe').src='q2_4.php'">מחיקת בן משפחה</td>
                </tr>
                                <tr>
                    <td class="action" onclick="document.getElementById('myiframe').src='q2_5.php'">הוספת אירוע מיוחד</td>
                </tr>
                                <tr>
                    <td class="action" onclick="document.getElementById('myiframe').src='q2_6.php'">אירועים יומיים של כל כלב</td>
                </tr>
                                <tr>
                    <td class="action" onclick="document.getElementById('myiframe').src='q2_7.php'">הצגת ד"וחות</td>
                </tr>
                                <tr>
                    <td class="action" onclick="document.getElementById('myiframe').src='q3.php'">עידכון אירועים יומיים</td>
                </tr>
            </table>

        </td>
        <td id="maindata" valign="top">
            <iframe id="myiframe" frameBorder="0" src="login.php"></iframe>
        </td>
    </tr>
</table>

</body>

</html>
