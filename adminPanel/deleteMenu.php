<?php
 						include("common/conn.php");
					  	$subMenuId=$_GET['id'];
						$url=$_GET['url'];
						$deleteQuery=mysql_query("update main_menu set m_menu_deleted='1' where m_menu_id='$subMenuId'");
						header("location:".$url);
						$msg="Menu Sucessfully Deleted";
?>