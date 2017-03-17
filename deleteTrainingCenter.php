 <?php
 						include("common/conn.php");
					  	$branchId=$_GET['id'];
						$url=$_GET['url'];
						$deleteQuery=mysql_query("update branchs set deleted='1' where branchId='$branchId'");
						header("location:".$url);
						$msg="Branch C Sucessfully Deleted";
?>	