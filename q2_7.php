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
    <title>דף דוחות 1</title>
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
    <h1>דו"חות</h1>
    <button onclick="location.href='q2_7-activities_report.php'">דו"ח פעילות</button>
    <button onclick="location.href='q2_7-bonuses_report.php'">דו"ח בונוסים</button>
    <button onclick="location.href='q2_7-delays_report.php'">דו"ח איחורים</button>

</body>
</html>