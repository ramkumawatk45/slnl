 <?php
 						include("common/conn.php");
					  	$pageId=$_GET['id'];
						$url=$_GET['url'];
						$deleteQuery=mysql_query("update pages set deleted='1' where pageId='$pageId'");
						header("location:".$url);
						$msg="Menu Sucessfully Deleted";
?>