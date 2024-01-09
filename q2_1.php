<?php
session_start();
?>
<!DOCTYPE>
<html dir="rtl">



<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="style.css" media="all">
    
    

<?php 
if (!(isset($sessionoff)))	// when called using iFrame
	{ ?>
		<script type="text/javascript">
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
<?php 
	} else unset($sessionoff);
?>

    
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
</style>

</head>
<body>
<h1>רישום כבעל כלב</h1>
<form action="check_registration.php" method="post">
    <table style="display: flex; justify-content: center; align-items: center;">
        <tr>
            <td style="color:red"colspan="2">
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
            <td style="text-align:center;padding:10px;border-bottom:1px solid #ddd;">שם משתמש</td>
            <td style="text-align:center;padding:10px;border-bottom:1px solid #ddd;"><input type="text" name="login"></td>
        </tr>
        <tr>
            <td style="text-align:center;padding:10px;border-bottom:1px solid #ddd;">שם פרטי</td>
            <td style="text-align:center;padding:10px;border-bottom:1px solid #ddd;"><input type="text" name="pname"></td>
        </tr>
        <tr>
            <td style="text-align:center;padding:10px;border-bottom:1px solid #ddd;">שם משפחה</td>
            <td style="text-align:center;padding:10px;border-bottom:1px solid #ddd;"><input type="text" name="fname"></td>
        </tr>
        <tr>
            <td style="text-align:center;padding:10px;border-bottom:1px solid #ddd;">סיסמה</td>
            <td style="text-align:center;padding:10px;border-bottom:1px solid #ddd;"><input type="password" name="password"></td>
        </tr>
        <tr>
            <td style="text-align:center;padding:10px;border-bottom:1px solid #ddd;">טלפון</td>
            <td style="text-align:center;padding:10px;border-bottom:1px solid #ddd;"><input type="text" name="phone"></td>
        </tr>
        <tr>
            <td style="text-align:center;padding:10px;border-bottom:1px solid #ddd;">אימיייל</td>
            <td style="text-align:center;padding:10px;border-bottom:1px solid #ddd;"><input type="text" name="mail"></td>
        </tr>
        <tr>
            <td style="text-align:center;padding:10px;border-bottom:0px solid #ddd;"><button type="reset">איפוס</button></td>
            <td style="text-align:center;padding:10px;border-bottom:0px solid #ddd;"><button type="submit">הרשמה</button></td>
        </tr>
    </table>
    
    <input id="today" name="today" type="hidden">
</form>

<script>
document.getElementById("today").value = get_today(); // When called using AJAX, JavaScript is not executed!
</script>


</body>
</html>
