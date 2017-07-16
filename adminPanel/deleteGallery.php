 <?php
 						include("common/conn.php");
					  	$pageId=$_GET['id'];
						$url=$_GET['url'];
						$deleteQuery=mysql_query("update gallery set deleted='1' where galleryId='$pageId'");
						header("location:".$url);
						$msg="Menu Sucessfully Deleted";
?>