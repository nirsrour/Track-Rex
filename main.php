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
    <script src="script.js"></script>
</head>
<body>
    <h1>
    שלום
    <?php
    echo $_SESSION['u_pname'] . ' ' . $_SESSION['u_fname'];
    ?>
    </h1>
    <?php
    // get all user's dogs using the u_d table
    $u_id = $_SESSION['u_id'];
    $sql = "select d_id from u_d where u_id=$u_id";
    $result = $conn->query( $sql );
    // the user has at least one dog
    if ( $result->num_rows > 0 ) { ?>
    <select name="d_id">
        <?php
        while ( $row = $result->fetch_assoc() ) {
            $d_id = $row['d_id'];
            $sql1 = "select * from dog where d_id=$d_id";
            $result1 = $conn->query( $sql1 );
            $dog = $result1->fetch_assoc();
            echo '<option>' . $dog['d_name'] . '</option>';
        } ?>
    </select>
        <?php
    } else { ?>
        <p>לא נמצאו כלבים בבעלותך.</p>
        <button onclick="window.location.href='q2_2.php'">רישום כלב חדש</button>
    <?php
    }
    ?>

    <?php
    // index.php, inc_db.php, script.js, style.css

    // 1 login.php & check.php
    //  2.1 q2_1.php & check_registration.php
    ?>
</body>
</html>