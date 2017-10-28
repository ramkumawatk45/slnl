<?php
//Include database configuration file
include("common/conn.php");
include("class/datalist.php");
$branchId = $_SESSION['branchId'];	
date_default_timezone_set("Asia/Calcutta");
$today=date('Y-m-d');
if($_SESSION['userType']=="ADMIN")
{
$query=" SELECT * FROM loans inner join loanemi on loans.loanId=loanemi.loanId and loans.deleted='0' and loanemi.emiNo =(SELECT max(emiNO) from loanemi where loans.loanId=loanemi.loanId) and loanemi.ndd <'$today' ";
}
else
{
		$query=" SELECT * FROM loans inner join loanemi on loans.loanId=loanemi.loanId and  loans.deleted='0' and loanemi.emiNo =(SELECT max(emiNO) from loanemi where loans.loanId=loanemi.loanId) and loanemi.ndd <'$today'  and loans.branchCode='$branchId'";
}	
$pageData=fetchData($query);
if (is_array($pageData) || is_object($pageData))
{
$i=1;
foreach($pageData as $tableData)
{
	$pplanId=$tableData['loanPlanId'];
	$plansQuery="SELECT * FROM loanplan where id='$pplanId' ";
	$plansDatas=fetchData($plansQuery);
	if (is_array($plansDatas) || is_object($plansDatas))
	{
		foreach($plansDatas as $branchData)
		{ $totalPlanDuration = $branchData['planDuration']; } 
		$remainLoanEMI = $totalPlanDuration-$tableData['emiNo'];
	}	

		$nexDueDate = "";
		$cdate=explode('-',$tableData['ndd']);
		$date=$cdate[2];
		$month=$cdate[1];
		$year=$cdate[0];
		$counter=$month;
		for($g=1;$g<=$remainLoanEMI;$g++)
		{
			if(strlen($counter)==1)
			{
				if($counter==2 && $date>=29)
				{
					if($year%4==0)
					{
						$nexDueDate =+'29-0'.$counter.'-'.$year;
					}
					else				
					{
						$nexDueDate =+ '28-0'.$counter.'-'.$year;
					}
				}
				elseif($counter==4 && $date>=30 || $counter==6 && $date>=30 || $counter==9 && $date>=30)
				{
					$nexDueDate =+ '30-0'.$counter.'-'.$year;
				}
				else 
				{
					$nexDueDate =+ $date.'-0'.$counter.'-'.$year;
				}			
			}
			elseif( $counter==11 && $date>=30)
			{
				$nexDueDate =+ '30-'.$counter.'-'.$year;
		
			}
			else
			{	
			 $nexDueDate = $date.'-'.$counter.'-'.$year;
			}
			if($counter==12){$counter=0; $year++;}
				$counter++;
		}
		
		
		
		// Set timezone
			//date_default_timezone_set('UTC');

			// Start date
			$date = $tableData['ndd'];
			// End date
			$end_date = $nexDueDate;
			$items = array();	
			while (strtotime($date) <= strtotime($end_date)) {
				$caluculateDate = date("d/m/Y", strtotime($date));
				$date = date ("Y-m-d", strtotime("+1 month", strtotime($date)));
				$items[] = $caluculateDate;
			}
	//var_dump($remainLoanEMI);
	for($j=1; $j<=$remainLoanEMI; $j++)
	{
		
					
?>

  <tr>
	 <td><?php echo  $i++; ?></td>
	 <td><?php echo $tableData['loanId']; ?></td>
	<td><?php $branchCode = $tableData['branchCode']; $queryBranch="SELECT * FROM branchs where branchId='$branchCode' and status='0' and deleted='0' ";
	$menuDatas=fetchData($queryBranch);
	if($menuDatas)
	{
	foreach($menuDatas as $branchData)
	{  echo $branchData['branchName']." - ".$branchData['branchCode']; }  }?> </td>
		<td><?php  echo $tableData['applicantName']; ?> </td>
		<td><?php  echo $tableData['gurdianName']; ?></td>
		<td><?php  echo $tableData['address']; ?></td>
		<td><?php $areaId = $tableData['areaId']; $queryBranch="SELECT * FROM areas where areaId='$areaId' and status='0' and deleted='0' ";$menuDatas=fetchData($queryBranch); if($menuDatas) {foreach($menuDatas as $branchData){  echo $branchData['areaName']; } } ?> </td>
		<td><?php  echo $tableData['memberMobile'];?></td>
		<td><?php $planId=$tableData['loanPlanId'];
	$planQuery="SELECT * FROM loanplan where id='$planId' ";$menuDatas=fetchData($planQuery); if($menuDatas){foreach($menuDatas as $branchData){  echo $branchData['planName']; } } ?></td>
		<td><?php $planId=$tableData['planTypeId'];
	$planQuerys="SELECT * FROM plantypes where id='$planId' ";$menuDatass=fetchData($planQuerys);If($menuDatas){foreach($menuDatass as $branchDataa){  echo $branchDataa['planName']; } } ?></td>
	<td> <?php if($items) { (echo $items[$j-1]; }   ?></td>
	<td><?php  echo $tableData['emiNo']+$j; ?></td> 
	<td><?php echo $tableData['emi']; ?></td>
  </tr>
<?php } } }   ?>