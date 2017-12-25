 <?php
 						include("common/conn.php");
					  	$id=$_GET['id'];
						$branchCode =$_GET['branchCode'];
						$url=$_GET['url'];
						$deleteuser=mysql_query("update user set deleted='1' where id='$id'");
						header("location:".$url);
						$msg="User  Sucessfully Deleted";
?>	