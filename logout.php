<?php
include("common/conn.php");
	
		$url = "index.php";
unset($_SESSION['login_user']);
header("location:".$url);
?>