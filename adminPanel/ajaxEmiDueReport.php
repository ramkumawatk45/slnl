<?php error_reporting(E_ALL ^ E_DEPRECATED);
//Include database configuration file
include("common/conn.php");
include("class/datalist.php");
$branchId = $_SESSION['branchId'];
$fromdate = explode('/',$_GET["from_date"]);
$fromDates= $fromdate[2].'-'.$fromdate[1].'-'.$fromdate[0];
$todate = explode('/',$_GET["to_date"]);
$toDates= $todate[2].'-'.$todate[1].'-'.$todate[0];
		
		$today=date('Y-m-d');
		if($_SESSION['userType']=="ADMIN")
		{
			$queryBranch="SELECT * FROM branchs where status='0' and deleted='0' ";
		}
		else
		{
			$queryBranch="SELECT * FROM branchs where status='0' and deleted='0' and branchId='$branchId'";
		}	
			$menuDatas=fetchData($queryBranch);
			$branchTableId;
			foreach($menuDatas as $branchData)
			{  
				?>
				<!--<tr style="text-align:center;background-color:grey;color:#fff;" class="brahchName">
						<td colspan="12"style="text-align:center;background-color:grey;color:#fff; border:none;"> 
						<?php echo $branchData['branchName']." - ".$branchData['branchCode'];  ?>
						</td>
					
				</tr> -->
		<?php
		$branchTableId = $branchData['branchId'];
		if($_SESSION['userType']=="ADMIN")
		{
		$query=" SELECT * FROM loans inner join loanemi on loans.loanId=loanemi.loanId and loans.deleted='0' and loans.status='0' and loanemi.emiNo =(SELECT max(emiNO) from loanemi where loans.loanId=loanemi.loanId) and loanemi.ndd between '$fromDates'  and '$toDates' and loanemi.emiStatus !='PRE' and loanemi.branchCode='$branchTableId'";
		}
		else
		{
				$query=" SELECT * FROM loans inner join loanemi on loans.loanId=loanemi.loanId and  loans.deleted='0' and loans.status='0' and loanemi.emiNo =(SELECT max(emiNO) from loanemi where loans.loanId=loanemi.loanId) and loanemi.ndd between '$fromDates'  and '$toDates' and loanemi.emiStatus !='PRE'  and loans.branchCode='$branchId'";
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
					date_default_timezone_set('UTC');

					// Start date
					$date = $tableData['ndd'];
					// End date
					$end_date = $nexDueDate;
					$items = array();	
					while (strtotime($date) <= strtotime($end_date)) {
						$caluculateDate = date("d/m/Y", strtotime($date));
						$date = date ("Y-m-d", strtotime("+1 month", strtotime($date)));
						if($caluculateDate)
						{	
							$items[] = $caluculateDate;
						}	
					}
		$planTypes ="";			
		$planId=$tableData['planTypeId'];
		$planQuerys="SELECT * FROM plantypes where id='$planId' and status='0' and deleted='0' ";
		$menuDatass=fetchData($planQuerys);	
		if(is_array($menuDatass) || is_object($menuDatass)) 
		{
			foreach($menuDatass as $branchData)
			{ 
				$planTypes = $branchData['planName']; 
			}
		}	
$remainingEMIS = 0;			
if($items && $planTypes != "DAILY")
{	
?>
  <tr>
	<td><?php echo $tableData['loanId']; ?></td>
	<td><?php  echo $tableData['applicantName']; ?> </td>
	<td><?php  echo $tableData['gurdianName']; ?></td>
	<td><?php  echo $tableData['address']; ?></td>
	<td><?php $areaId = $tableData['areaId']; 
			$queryBranch="SELECT * FROM areas where areaId='$areaId' and status='0' and deleted='0' ";
			$menuDatas=fetchData($queryBranch); 
			if(is_array($menuDatas) || is_object($menuDatas)) 
			{ 
				foreach($menuDatas as $branchData)
				{ 
					echo $branchData['areaName'];
				} 
			}	?> 
	</td>
	<td><?php  echo $tableData['memberMobile'];?></td>
	<td><?php $planId=$tableData['loanPlanId'];
			$planQuery="SELECT * FROM loanplan where id='$planId' and status='0' and deleted='0' ";
			$menuDatas=fetchData($planQuery);
			if(is_array($menuDatas) || is_object($menuDatas)) 
			{
				foreach($menuDatas as $branchData)
				{ 
					echo $branchData['planName']; 
				}
			}	
			
		?>
	</td>
	<td><?php echo  $planTypes; ?> </td>
	<td> <?php  if(isset($items)) { echo current($items); }    ?></td>
	<td>
		<?php  
			$minEmiNo =$tableData['emiNo']+1;
			$maxEmiNo = $tableData['emiNo'];
			if(isset($items)) 
			{ 
				foreach ($items as $value) 
				{ 
					$cdate=explode('/',$value);
					$date=$cdate[0];
					$month=$cdate[1];
					$year=$cdate[2];
					$caluculateDate = strtotime($year."/".$month.'/'.$date);
					if($caluculateDate <= strtotime($toDates))
					{
						$maxEmiNo = $maxEmiNo+1; 
					}		
				}  
			} 
			echo $minEmiNo." -".$maxEmiNo;
			$remainingEMIS = $maxEmiNo-$tableData['emiNo'];
		?>
	</td> 
	<td><?php echo $tableData['emi']." x ".$remainingEMIS; ?></td>
	<td><?php   if($remainingEMIS){ echo $remainingEMIS*$tableData['emi']; } ?></td>
  </tr>
<?php  
}
} } }  ?>