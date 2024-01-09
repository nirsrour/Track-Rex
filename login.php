<?php
session_start();
$er = "";
	if (isset($_SESSION['er'])) {	// Check if ther was an error
		 $er = $_SESSION['er']."<br><br>";
		unset($_SESSION['er']);		// Clear the error
	}

?>
<!DOCTYPE>
<html dir="rtl">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <form action="check.php" method="post">
        <table style="display: flex; justify-content: center; align-items: center;">
            <tr>
                <td style="font-style:italic;text-decoration-color:red;color:red"colspan="2">
                <?php
                // check if 'err' key exist in $_SESSION
                if (isset( $_SESSION['err']) ) {
                    // display the error message
                    echo $_SESSION['err'];
                    // delete 'err' from the session array
                    unset($_SESSION['err']);
                }
                // check if 'success' key exist in $_SESSION
                if (isset( $_SESSION['success']) ) {
                    // display the success message
                    echo $_SESSION['success'];
                    // delete 'success' from the session array
                    unset($_SESSION['success']);
                }
                ?>
                </td>
            </tr>
            <tr>
                <td>שם משתמש</td>
                <td><input type="text" name="login"></td>
            </tr>
            <tr>
                <td>סיסמה</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td><button type="reset">איפוס</button></td>
                <td><button type="submit">התחברות</button></td>
            </tr>
        </table>
    </form>
</body>
</html>
