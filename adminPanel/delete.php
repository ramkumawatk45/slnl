 <?php
 						include("common/conn.php");
					  	$subMenuId=$_GET['id'];
						$url=$_GET['url'];
						$deleteQuery=mysql_query("update sub_menu set s_menu_deleted='1' where s_menu_id='$subMenuId'");
						header("location:".$url);
						$msg="Menu Sucessfully Deleted";
?>