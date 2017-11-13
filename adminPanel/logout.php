<?php
error_reporting(E_ALL ^ E_DEPRECATED);
include("common/conn.php");
$url = "index.php";
unset($_SESSION['login_user']);
?>
<script> window.location.href = "index.php";</script>
//header("location:".$url);
?>