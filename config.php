<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "timeTracker_db";

$conn = mysql_connect($server,$username,$password)or die("Server not Found");
mysql_select_db($dbname)or die("Database not found");

?>