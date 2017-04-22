<?php
include("controller/pages_controller.php");
$menuType = "gallery";
?>
<script type="text/javascript">
$("#loading").removeClass('hide');
 $.ajax({    //create an ajax request to load_page.php
        type: "GET",
        url: "ajaxDueReport.php",             
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
            $("#tableData").html(response); 
			sortTableData();
            //alert(response);
        }
 });
 function sortTableData()
 {
	$("#loading").addClass('hide');
    $('#emiReport').DataTable({
        dom: 'Bfrtip',
        buttons: [
				'pageLength',
			{
			extend: 'pdf',
			footer: true,
			title: 'EMI Due Report',
			exportOptions: {
			columns: ':visible',
			modifier: {
				page: 'current',
			}
			}
			},
            {
                extend: 'print',
				footer: true,
				title: 'EMI Due Report',
                exportOptions: {
                columns: ':visible',
				modifier: {
                    page: 'current',
                }
				}
            },
			{
                extend: 'copy',
				footer: true,
				title: 'EMI Due Report',
                exportOptions: {
                columns: ':visible',
				modifier: {
                    page: 'current'
                }
				}
            },
			{
                extend: 'excel',
				footer: true,
				title: 'EMI Due Report',
                exportOptions: {
                columns: ':visible',
				modifier: {
                    page: 'current'
                }
				}
            },
            'colvis'
        ],
        columnDefs: [ {
            visible: false
        } ],
		lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 ', '25 ', '50 ', 'Show all' ]
        ],
		"footerCallback": function ( row, data, start, end, display ) 
		{
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
			emiTotal = api
                .column( 10, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );	
			$( api.column( 10 ).footer() ).html(emiTotal);	
		}
    });
	$(".dt-buttons").append("")
}
</script>

<?php
if(isset($_REQUEST['sendMessage']))
{
	$loanId=$_REQUEST['loanId'];
	$applicantName=$_REQUEST['applicantName'];
	$memberMobile=$_REQUEST['memberMobile'];
	$emi=$_REQUEST['emi'];
	$emiDate=$_REQUEST['emiDate'];
	$ndd =  explode('-',$emiDate); 
	$today =  $ndd[2].'/'.$ndd[1].'/'.$ndd[0]; 
	echo sms($memberMobile,"SHLIFE DEAR ".strtoupper($applicantName).",Loan No <".$loanId."> YOUR EMI,Rs-".(round($emi))." Due, on Date-".$today.", Shri Life Nidhi Limited.");
	$msg="Messeage Sended Successfully";
	$pageHrefLink="custDueReport.php?id=".$loanId;

}
?>
<div class="content-wrapper">
        <!-- Main content -->
      
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">EMI Due  Report</h3>
                </div><!-- /.box-header -->
                <div class="box-body ">
				<form method="post">
<?php 
$branchId = $_SESSION['branchId'];
$loanId	= $_REQUEST['id'];
if($_SESSION['userType']=="ADMIN")
{
	$query=" SELECT * FROM loans inner join loanemi on loans.loanId=loanemi.loanId and loanemi.deleted='0'and loans.deleted='0'where loans.loanId='$loanId' and loanemi.emiNo = (SELECT max(emiNO) from loanemi where loanemi.loanId ='$loanId')";
}
else
{
	$query="  SELECT * FROM loans inner join loanemi on loans.loanId=loanemi.loanId and loanemi.deleted='0'and loans.deleted='0'where loans.loanId='$loanId' and loanemi.emiNo = (SELECT max(emiNO) from loanemi where loanemi.loanId ='$loanId') and loans.branchCode='$branchId'";
}	
$pageData=fetchData($query);
if (is_array($pageData) || is_object($pageData))
{
foreach($pageData as $tableData)
{
?>	
<input type="hidden" name="loanId" value="<?php  echo $tableData['loanId']; ?>" />
<input type="hidden" name="applicantName" value="<?php  echo $tableData['applicantName']; ?>" />
<input type="hidden" name="memberMobile" value="<?php  echo $tableData['memberMobile']; ?>" />
<input type="hidden" name="emi" value="<?php  echo $tableData['emi']; ?>" />
<input type="hidden" name="emiDate" value="<?php  echo $tableData['ndd']; ?>" />
<input type="submit" class="btn btn-primary  pull-left"  name="sendMessage" value="Send Message">
<?php
}} 
?>
</form>

                  <table id="emiReport" class="table table-bordered table-striped">
                   <thead>
                      <tr>
                        <th>Sr. no.</th>
                        <th>Loan Id</th>
						<th>Branch</th>
						<th>Applicant Name</th>
						<th>Gurdian Name</th>
						<th class="col-md-2">Address</th>						
						<th>Phone No</th>
						<th>Term</th>
						<th>EMI Date</th>
						<th>EMI No.</th>
                        <th>EMI(RS.)</th>
                      </tr>
                    </thead>
					
					<tbody>
					<?php
						$branchId = $_SESSION['branchId'];
						$loanId	= $_REQUEST['id'];
						$today=date('Y-m-d');
						if($_SESSION['userType']=="ADMIN")
						{
							$query=" SELECT * FROM loans inner join loanemi on loans.loanId=loanemi.loanId and loanemi.deleted='0'and loans.deleted='0'where loans.loanId='$loanId' and loanemi.emiNo = (SELECT max(emiNO) from loanemi where loanemi.loanId ='$loanId')";
						}
						else
						{
							$query="  SELECT * FROM loans inner join loanemi on loans.loanId=loanemi.loanId and loanemi.deleted='0'and loans.deleted='0'where loans.loanId='$loanId' and loanemi.emiNo = (SELECT max(emiNO) from loanemi where loanemi.loanId ='$loanId') and loans.branchCode='$branchId'";
						}	
						$pageData=fetchData($query);
						if (is_array($pageData) || is_object($pageData))
						{
						$i=1;
						foreach($pageData as $tableData)
						{
							$planId=$tableData['loanPlanId'];
							$planQuery="SELECT * FROM loanplan where id='$planId' ";$menuDatas=fetchData($planQuery);foreach($menuDatas as $branchData)
							{ $totalPlanDuration = $branchData['planDuration']; } 
							$remainLoanEMI = $totalPlanDuration-$tableData['emiNo'];
							
						}
						?>
						
						<?php
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
										$items[] = $caluculateDate;
									}
							//var_dump($remainLoanEMI);
							//var_dump($items);	
							for($j=1; $j<=$remainLoanEMI; $j++)
							{	
							
						?>
						
						  <tr>
							 <td><?php echo  $j; ?> </td>
							 <td><?php echo $tableData['loanId']; ?> </td>
							<td><?php $branchCode = $tableData['branchCode']; $queryBranch="SELECT * FROM branchs where branchId='$branchCode' and status='0' and deleted='0' ";
							$menuDatas=fetchData($queryBranch);
							foreach($menuDatas as $branchData)
							{  echo $branchData['branchName']." - ".$branchData['branchCode']; } ?> </td>
								<td class="col-md-3" ><?php  echo $tableData['applicantName']; ?> </td>
								<td class="col-md-3"><?php  echo $tableData['gurdianName']; ?></td>
								<td class="col-md-3"><?php  echo $tableData['address']; ?></td>
								<td><?php  echo $tableData['memberMobile'];?> </td>
								<td><?php $planId=$tableData['loanPlanId'];
							$planQuery="SELECT * FROM loanplan where id='$planId' ";$menuDatas=fetchData($planQuery);foreach($menuDatas as $branchData){  echo $branchData['planName']; } ?></td>
								<td> <?php echo $items[$j-1];   ?></td>
							<td><?php  echo $tableData['emiNo']+$j; ?></td> 
							<td><?php echo $tableData['emi']; ?> </td>
						  </tr>
						  
						<?php  }} ?>
						
						<tfoot>
						<tr>
                        <td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-2">Sub Total</td>
                        <td></td>
                       <td></td>
                      </tr>
					  </tbody>
                  </table>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            
            </div><!-- /.col -->
            
          </div><!-- /.row -->
          
          
        </section><!-- /.content -->
      </div>
	

<?php include("common/adminFooter.php");?>
