<?php error_reporting(E_ALL ^ E_DEPRECATED);
session_start();
$msg="";
$edit="";
$servername = "localhost";
$username = "shrilife_loan";
$password = "admin@123";
$dbname = "shrilife_loansoft";
$conn = mysql_connect($servername, $username, $password)or die("Unable to connect to MySQL");
$selected = mysql_select_db($dbname,$conn)or die("Could not select db");
			
?> 