<?php
//Include database configuration file
include("common/conn.php");
include("class/datalist.php");
$branchId = $_SESSION['branchId'];	
$today=date('Y-m-d');
if($_SESSION['userType']=="ADMIN")
{
$query=" SELECT * FROM loans inner join loanemi on loans.loanId=loanemi.loanId and loans.deleted='0'";
}
else
{
		$query=" SELECT * FROM loans inner join loanemi on loans.loanId=loanemi.loanId and  loans.deleted='0'   and loans.branchCode='$branchId'";
}	
$pageData=fetchData($query);
var_dump($query);
if (is_array($pageData) || is_object($pageData))
{
$i=1;
foreach($pageData as $tableData)
{
?>

  <tr>
	 <td><?php echo  $i++; ?></td>
	 <td><?php echo $tableData['loanId']; ?></td>
	<td><?php $branchCode = $tableData['branchCode']; $queryBranch="SELECT * FROM branchs where branchId='$branchCode' and status='0' and deleted='0' ";
	$menuDatas=fetchData($queryBranch);
	foreach($menuDatas as $branchData)
	{  echo $branchData['branchName']." - ".$branchData['branchCode']; } ?> </td>
		<td><?php  echo $tableData['applicantName']; ?> </td>
		<td><?php  echo $tableData['gurdianName']; ?></td>
		<td><?php  echo $tableData['address']; ?></td>
		<td><?php $areaId = $tableData['areaId']; $queryBranch="SELECT * FROM areas where areaId='$areaId' and status='0' and deleted='0' ";$menuDatas=fetchData($queryBranch);foreach($menuDatas as $branchData){  echo $branchData['areaName']; } ?> </td>
		<td><?php  echo $tableData['memberMobile'];?></td>
		<td><?php $planId=$tableData['loanPlanId'];
	$planQuery="SELECT * FROM loanplan where id='$planId' ";$menuDatas=fetchData($planQuery);foreach($menuDatas as $branchData){  echo $branchData['planName']; } ?></td>
		<td><?php $planId=$tableData['planTypeId'];
	$planQuerys="SELECT * FROM plantypes where id='$planId' ";$menuDatass=fetchData($planQuerys);foreach($menuDatass as $branchDataa){  echo $branchDataa['planName']; } ?></td>
	<td><?php  $ndd =  explode('-',$tableData['ndd']); echo $ndd[2].'/'.$ndd[1].'/'.$ndd[0]; ?></td>
	<td><?php  echo $tableData['emiNo']+1; ?></td> 
	<td><?php echo $tableData['emi']; ?></td>
  </tr>
<?php } } ?>