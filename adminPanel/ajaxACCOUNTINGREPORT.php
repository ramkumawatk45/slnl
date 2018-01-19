<?php
//Include database configuration file
include("common/conn.php");
include("class/datalist.php");
function dateRange( $first, $step = '+0 day', $format = 'd/m/Y' ) 
{
	$dates = "";
	$current = strtotime( $first );
	$current = strtotime( $step, $current );
	$dates = date( $format, $current );
	return $dates;
}
$branchId = $_GET['branchId'];
if($_SESSION['branchId'])
{
	$branchId = $_SESSION['branchId'];
}	
if($_GET["from_date"])
{
	$fromdate = explode('/',$_GET["from_date"]);	
	$fromDates= $fromdate[2].'-'.$fromdate[1].'-'.$fromdate[0];
}
if($_GET["to_date"])
{	
	$todate = explode('/',$_GET["to_date"]);
	$toDates= $todate[2].'-'.$todate[1].'-'.$todate[0];
}
if($branchId && ($_GET["from_date"] =="") && ($_GET["to_date"] ==""))
{
	if($_SESSION['userType']=="ADMIN" && $branchId =="All")
	{
		$query="SELECT * FROM accountings  order by accountingId Desc  ";	
	}
	else
	{
		$query="SELECT * FROM accountings where branchId ='$branchId' order by accountingId Desc  ";		
	}	
}
else if($branchId  && ($_GET["from_date"] !="") && ($_GET["to_date"] !=""))
{
	if($_SESSION['userType']=="ADMIN" && $branchId =="All")
	{
		if(($_GET["from_date"] == "Invalid Date") && ($_GET["from_date"] == "Invalid Date" ))
		{
			$query="SELECT * FROM accountings  where  createDate >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)   order by accountingId Desc  ";
		}
		else
		{
			$query="SELECT * FROM accountings where createDate between '$fromDates'  and '$toDates' order by accountingId Desc  ";
		}	
	}	
	else
	{
		if(($_GET["from_date"] == "Invalid Date") && ($_GET["from_date"] == "Invalid Date" ))
		{
			$query="SELECT * FROM accountings  where  createDate >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)   order by accountingId Desc  ";
		}
		else
		{
			$query="SELECT * FROM accountings where branchId ='$branchId' and createDate between '$fromDates'  and '$toDates' order by accountingId Desc  ";	
		}	
	}
}
else
{
		
}	
$pageData=fetchData($query);
	$i = 1;
	if(is_array($pageData) || is_object($pageData))
	{
	foreach($pageData as $tableData)
	{
	?> <tr>
                         <td><?php echo  $i++; ?></td>
						 <td><?php echo dateRange($tableData['createDate']); ?></td>
						 <?php 
						 $branchId = $tableData['branchId'];
						$query="SELECT * FROM branchs where deleted='0' and status='0' and branchCode !='0' and branchId ='$branchId'";
						$menuData=fetchData($query);
						if(is_array($menuData) || is_object($menuData))
						{
						foreach($menuData as $branchData)
						{ ?>
						<td><?php  echo $branchData['branchName']." - ".$branchData['branchCode']; ?></td>
						<?php 
						}}
						?>
						<td><?php echo $tableData['shriLife']; ?></td>
						<td><?php echo $tableData['loan']; ?> </td>
						<td><?php echo $tableData['MF']; ?></td>
						<td><?php echo $tableData['totalPayment']; ?></td>
						<td><?php echo $tableData['receivePayment']; ?></td>
						<td><?php echo $tableData['pendingCollection']; ?></td>
						<?php if($_SESSION['userType']=="ADMIN") { ?>
						<td><a href='editAccountingEntries.php?id=<?php echo  $tableData['accountingId'];?>'>Edit </a></td>
						<?php } ?> 
                      </tr>
	<?php } ?> 
					
	<?php }?>