 <?php
 						include("common/conn.php");
					  	$branchId=$_GET['id'];
						$branchCode =$_GET['branchCode'];
						$url=$_GET['url'];
						$deleteQuery=mysql_query("update branchs set deleted='1' where branchId='$branchId'");
						$deleteuser=mysql_query("update user set deleted='1' where branchCode='$branchCode'");
						header("location:".$url);
						$msg="Branch  Sucessfully Deleted";
?>	