 <?php
 						include("common/conn.php");
					  	$areaId=$_GET['id'];
						$url=$_GET['url'];
						$deleteQuery=mysql_query("update areas set deleted='1' where areaId='$areaId'");
						header("location:".$url);
						$msg="Sucessfully Deleted";
?>	