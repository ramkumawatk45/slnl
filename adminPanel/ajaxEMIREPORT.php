<?php
//Include database configuration file
include("common/conn.php");
include("class/datalist.php");
$branchId = $_SESSION['branchId'];	

						if($_SESSION['userType']=="ADMIN")
						{
								
								$query="SELECT * FROM loans inner join loanemi on loans.loanId=loanemi.loanId and loans.deleted='0' and loanemi.deleted='0' order by emiNo,newPaymentDate Desc, loanemi.id Desc  ";
								
						}
						else
						{
								$query="SELECT * FROM loans inner join loanemi on loans.loanId=loanemi.loanId and loans.deleted='0' and loanemi.deleted='0'  and loanemi.branchCode='$branchId' order by emiNo,newPaymentDate Desc ,  loanemi.id Desc";
						}	
					$pageData=fetchData($query);
	$i = 1;
	if(is_array($pageData) || is_object($pageData))
	{
	$emiTotal=0;
	$lateFees =0;
	$serviceCharges =0;
	foreach($pageData as $tableData)
	{
		$emiTotal =$emiTotal+$tableData['emiAmount'];
		$lateFees =$lateFees+$tableData['lateFee'];
		$serviceCharges =$serviceCharges+$tableData['serviceCharge'];
	?> <tr>
                         <td><?php echo  $i++; ?></td>
						 <td><?php echo $tableData['loanId']; ?></td>
						<td><?php $branchCode = $tableData['branchCode']; $queryBranch="SELECT * FROM branchs where branchId='$branchCode' and status='0' and deleted='0' ";
						$menuDatas=fetchData($queryBranch);
						foreach($menuDatas as $branchData)
						{  echo $branchData['branchName']." - ".$branchData['branchCode']; } ?> </td>
						<td><?php echo $tableData['applicantName']; ?></td>
						<td><?php echo $tableData['gurdianName']; ?> </td>
						<td><?php echo $tableData['emiNo']; ?></td>
						<td><?php echo $tableData['id']; ?></td>
						<td><?php echo $tableData['dueDate']; ?></td>
						<td class="col-md-2"><?php echo $tableData['paymentDate']; ?></td>
						<td><?php echo $tableData['emiAmount']; ?></td>
						<td><?php echo $tableData['lateFee']; ?></td>
						<td><?php echo $tableData['serviceCharge']; ?></td>
                      </tr>
	<?php } ?> 
					
	<?php }?>