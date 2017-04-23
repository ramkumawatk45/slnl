 <?php
 						include("common/conn.php");
					  	$loanId=$_GET['id'];
						$url=$_GET['url'];
						$emiNo=$_GET['emiNo'];
						date_default_timezone_set('Asia/Kolkata');
						$dateTime = date('Y-m-d H:i:s');
						$deleteQuery=mysql_query("update loanemi set deleted='1',datetime='$dateTime' where loanId='$loanId' and emiNo='$emiNo' ");
						header("location:deleteEMI.php?id=".$loanId);
						$msg="EMI Sucessfully Deleted";
?>	