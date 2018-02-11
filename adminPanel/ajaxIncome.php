<?php
//Include database configuration file
include("common/conn.php");
include("class/datalist.php");	
if(($_GET["from_date"]) !="Invalid Date" && ($_GET["from_date"]) !="")
{
	$fromdate = explode('/',$_GET["from_date"]);	
	$fromDates= $fromdate[2].'-'.$fromdate[1].'-'.$fromdate[0];
}
if(($_GET["to_date"]) !="Invalid Date" && ($_GET["to_date"]) !="")
{	
	$todate = explode('/',$_GET["to_date"]);
	$toDates= $todate[2].'-'.$todate[1].'-'.$todate[0];
}
	$query="SELECT * FROM income_expenses where createDate between '$fromDates'  and '$toDates' and deleted='0' and type='Income' order by id Desc  ";			
	$pageData=fetchData($query);
	$i = 1;
	if(is_array($pageData) || is_object($pageData))
	{
	foreach($pageData as $tableData)
	{
	?> 
	 <tr>
		<td><?php echo  $i++; ?></td>
		<td><?php echo $tableData['name']; ?> </td>
		<td><?php echo $tableData['penaltyAmount']; ?> </td>
		<td><?php echo $tableData['serviceCharges']; ?> </td>
		<td><?php echo $tableData['insuranceCharges']; ?> </td>
		<td><?php echo $tableData['loanSavings']; ?> </td>
		<td><?php echo $tableData['remarks']; ?> </td>
		<td><?php echo custumDateFormat($tableData['createDate']); ?> </td>								
		<td><a href='editIncome.php?id=<?php echo  $tableData['id'];?>'>Edit</a></td>
	 </tr>
	<?php } } ?> 