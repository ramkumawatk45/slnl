 <?php
 						include("common/conn.php");
					  	$imgid=$_GET['id'];
						$galleryId=$_GET['galleryId'];
						$url=$_GET['url'];
						$deleteQuery=mysql_query("update galleryimages set deleted='1' where imgId='$imgid'");
						header("location:".$url."?id=".$galleryId);
						$msg="Slide  Sucessfully Deleted";
?>	