<?php
include("controller/pages_controller.php");
$menuType = "gallery";
$branchId = $_SESSION['branchId'];
if(isset($_POST['sendMessage']))
{
	if(!empty($_POST['checkBoxMessage']))
	{
	// Loop to store and display values of individual checked checkbox.
		for($i=0;$i<count($_POST['checkBoxMessage']);$i++)
		{
				$applicantName=$_POST['applicantName'][$i];
				$memberMobile=$_POST['memberMobile'][$i];	
				$loanId=$_POST['loanId'][$i];
				$emi=$_POST['emi'][$i];
				$emiDate=$_POST['emiDate'][$i];	
				sms($memberMobile,"SHLIFE DEAR ".strtoupper($applicantName).",Loan No <".$loanId."> YOUR EMI,Rs-".(round($emi))." Due, on Date-".$emiDate.", Shri Life Nidhi Limited.");
	$msg="Messeage Sended Successfully";
	$pageHrefLink="custDueReport.php?id=".$loanId;
		}
	}
	
}
?>
<script type="text/javascript">
$(document).on('change','#checkBoxAll',function (){
	if(this.checked)
	{	
		$(".checkBoxMessage").attr("checked",true);
	}
	else
	{
		$(".checkBoxMessage").removeAttr("checked");
	}
});	
$(document).ready(function() {
    $('#category').DataTable( {
        dom: 'Bfrtip',
        buttons: [
				'pageLength',
            'colvis'
        ],
        columnDefs: [ {
            targets: -1,
            visible: true
        } ],
		lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 ', '25 ', '50 ', 'Show all' ]
        ]
    } );
		

} );
</script>
<div class="content-wrapper">
        <!-- Main content -->
      
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">EMI Due Report</h3>
                </div><!-- /.box-header -->
                <div class="box-body ">
				<form method="post" action="#">
				
					<input type="submit" class="btn btn-primary  pull-left"  name="sendMessage" value="Send Message">
				
                  <table id="category" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr. no.</th>
						<th>All <input type='checkbox' id="checkBoxAll" class="checkBoxall"> </th>
                        <th>Loan Id</th>
						<th>Branch</th>
						<th>Applicant Name</th>
						<th>Gurdian Name</th>
						<th>Address</th>						
						<th>Area Name</th>
						<th>Phone No</th>
						<th>Term</th>
						<th>Mode</th>
						<th>EMI Date</th>
						<th>EMI No.</th>
                        <th>EMI(RS.)</th>
                      </tr>
                    </thead>
					<tbody>
                     <?php
					 $currentDate = date('Y-m-d');
					 if($_SESSION['userType']=="ADMIN")
					{
					$query=" SELECT * FROM loans inner join loanemi on loans.loanId=loanemi.loanId and loans.deleted='0'  where loanemi.ndd='2017-04-01'";
					}
					else
					{
							$query=" SELECT * FROM loans inner join loanemi on loans.loanId=loanemi.loanId and where loans.deleted='0' and  loanemi.ndd='$currentDate'  and branchCode='$branchId'";
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
                         <td><?php echo  $i++; ?></td>
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
						$planQuery="SELECT * FROM plantypes where id='$planId' ";$menuDatas=fetchData($planQuery);foreach($menuDatas as $branchData){  echo $branchData['planName']; } ?></td>
						<td><?php  $ndd =  explode('-',$tableData['ndd']); echo $ndd[2].'/'.$ndd[1].'/'.$ndd[0]; ?></td>
						<td><?php  echo $tableData['emiNo']+1; ?></td> 
						<td><?php echo $tableData['emiAmount']; ?></td>
                      </tr>
                    <?php } } ?>
					  </tbody>
                  </table>
                </div><!-- /.box-body -->
                </form>
              </div><!-- /.box -->
            
            </div><!-- /.col -->
            
          </div><!-- /.row -->
          
          
        </section><!-- /.content -->
      </div>
<?php include("common/adminFooter.php");?>
