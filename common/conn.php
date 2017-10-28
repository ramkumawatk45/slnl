<?php error_reporting(E_ALL ^ E_DEPRECATED);
$msg="";
$edit="";
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "shrilife_loansoft";
$conn = mysql_connect($servername, $username, $password)or die("Unable to connect to MySQL");
$selected = mysql_select_db($dbname,$conn)or die("Could not select db");
?> 