<?php
//Include database configuration file
include("common/conn.php");
include("class/datalist.php");
$branchId = $_SESSION['branchId'];
$fromdate = explode('/',$_GET["from_date"]);
$fromDates= $fromdate[2].'-'.$fromdate[1].'-'.$fromdate[0];
$todate = explode('/',$_GET["to_date"]);
$toDates= $todate[2].'-'.$todate[1].'-'.$todate[0];
if($_SESSION['userType']=="ADMIN")
{
	$query="SELECT * FROM loans inner join loanemi on loans.loanId=loanemi.loanId and loans.deleted='0' and loanemi.deleted='0' and loans.status='0'  where loanemi.ndd between '$fromDates'  and '$toDates' and loanemi.emiStatus !='PRE' order by loanemi.emiNo,loanemi.newPaymentDate Desc  ";
	
}
else
{
		$query="SELECT * FROM loans inner join loanemi on loans.loanId=loanemi.loanId and where loans.deleted='0' and loanemi.deleted='0' loan.status='0' and  loanemi.ndd between '$fromDates'  and '$toDates' and loanemi.emiStatus !='PRE' and loanemi.branchCode='$branchId' order by loanemi.emiNo,loanemi.newPaymentDate Desc";
}	


$pageData=fetchData($query);
					if (is_array($pageData) || is_object($pageData))
					{
					$i=1;
					foreach($pageData as $tableData)
					{
					
						$cdate=explode('/',$tableData['dueDate']);
								$date=$cdate[0];
								$month=$cdate[1];
								$year=$cdate[2];
								$counter=$month;
						$g; 
						$counter=$counter;
						if($counter>12)
						{
							$counter=$counter-12; 
							$year++;
						}
						for($g=1;$g<12;$g++)
						{
							if(strlen($counter)==1)
							{
								if($counter==2 && $date>=29)
								{
									if($year%4==0)
									{
										$emidate=$year.'-0'.$counter.'-29';
									}
									else
									{
										$emidate=$year.'-0'.$counter.'-28';
									}
								}
								elseif($counter==4 && $date>=30 || $counter==6 && $date>=30 || $counter==9 && $date>=30)
								{
									$emidate=$year.'-0'.$counter.'-30';
								}
								else
								{
									$emidate=$year.'-0'.$counter.'-'.$date;
								}					
							}
						elseif( $counter==11 && $date>=30)
						{
							$emidate=$year.'-'.$counter.'-'.'30';
								
						}
						else
						{	 
							$emidate=$year.'-'.$counter.'-'.$date;
						}
					}	
							$loanId = $tableData['id'];
							//$sql=mysql_query("update loanemi set newDueDate='$emidate' where id='$loanId'");
							//var_dump($sql);
					?>
					
                      <tr>
                         <td><?php echo  $i; ?></td>
						 <td>
						 <input type='checkbox' id="checkBoxMessage" name="checkBoxMessage[]" value="<?php  echo $i++; ?>"    class="checkBoxMessage"> 
						 <input type="hidden" name="loanId[]" value="<?php  echo $tableData['loanId']; ?>" />
						<input type="hidden" name="applicantName[]" value="<?php  echo $tableData['applicantName']; ?>" />
						<input type="hidden" name="memberMobile[]" value="<?php  echo $tableData['memberMobile']; ?>" />
						<input type="hidden" name="emi[]" value="<?php  echo $tableData['emi']; ?>" />
						<input type="hidden" name="emiDate[]" value="<?php  echo $tableData['ndd']; ?>" />
						 </td>
						 <td><?php echo $tableData['loanId']; ?></td>
						<td><?php $branchCode = $tableData['branchCode']; $queryBranch="SELECT * FROM branchs where branchId='$branchCode' and status='0' and deleted='0' ";
						$menuDatas=fetchData($queryBranch);
						if($menuDatas)
						{
						foreach($menuDatas as $branchData)
						{  echo $branchData['branchName']." - ".$branchData['branchCode']; } } ?> </td>
							<td><?php  echo $tableData['applicantName']; ?> </td>
							<td><?php  echo $tableData['gurdianName']; ?></td>
							<td><?php  echo $tableData['address']; ?></td>
							<td><?php $areaId = $tableData['areaId']; $queryBranch="SELECT * FROM areas where areaId='$areaId' and status='0' and deleted='0' ";$menuDatas=fetchData($queryBranch); if($menuDatas) { foreach($menuDatas as $branchData){  echo $branchData['areaName']; } } ?> </td>
							<td><?php  echo $tableData['memberMobile'];?></td>
							<td><?php $planId=$tableData['loanPlanId'];
						$planQuery="SELECT * FROM loanplan where id='$planId' ";$menuDatas=fetchData($planQuery); if($menuDatas) { foreach($menuDatas as $branchData){  echo $branchData['planName']; } } ?></td>
							<td><?php $planId=$tableData['planTypeId'];
						$planQuery="SELECT * FROM plantypes where id='$planId' ";$menuDatas=fetchData($planQuery); if($menuDatas) { foreach($menuDatas as $branchData){  echo $branchData['planName']; } } ?></td>
						<td><?php  $ndd =  explode('-',$tableData['ndd']); echo $ndd[2].'/'.$ndd[1].'/'.$ndd[0]; ?></td>
						<td><?php  echo $tableData['emiNo']+1; ?></td> 
						<td><?php echo $tableData['emiAmount']; ?></td>
                      </tr>
                    <?php } } ?>
