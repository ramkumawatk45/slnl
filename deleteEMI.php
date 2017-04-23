<?php
include("controller/pages_controller.php");
$menuType = "gallery";
?>
<script type="text/javascript">
$(document).ready(function() {
    $('#emiReport').DataTable({
        dom: 'Bfrtip',
        buttons: [
				'pageLength',
			{
			extend: 'pdf',
			footer: true,
			title: 'EMI Paid List',
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
				title: 'EMI Paid List',
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
				title: 'EMI Paid List',
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
				title: 'EMI Paid List',
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
});	
</script>


<div class="content-wrapper">
        <!-- Main content -->
      
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">EMI Paid Status</h3>
                </div><!-- /.box-header -->
                <div class="box-body ">
                  <table id="emiReport" class="table table-bordered table-striped">
                   <thead>
                      <tr>
                        <th>Sr. no.</th>
                        <th>Loan Id</th>
						<th>Branch</th>
						<th>Applicant Name</th>
						<th>Gurdian Name</th>					
						<th>Phone No</th>
						<th>EMI No.</th>
						<th>EMI Date</th>
						<th>Payment Date</th>
                        <th>EMI(RS.)</th>
						<th>Delete</th>
                      </tr>
                    </thead>
					
					<tbody >
					<?php
						$branchId = $_SESSION['branchId'];
						$loanId	= $_REQUEST['id'];
						$today=date('Y-m-d');
						if($_SESSION['userType']=="ADMIN")
						{
							$query=" SELECT * FROM loans inner join loanemi on loans.loanId=loanemi.loanId and loanemi.deleted='0'and loans.deleted='0'where loans.loanId='$loanId' ";
						}
						else
						{
							$query="  SELECT * FROM loans inner join loanemi on loans.loanId=loanemi.loanId and loanemi.deleted='0'and loans.deleted='0'where loans.loanId='$loanId'  and loans.branchCode='$branchId'";
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
						?>
						<tr>
							 <td><?php echo  $i++; ?> </td>
							 <td><?php echo $tableData['loanId']; ?> </td>
							<td><?php $branchCode = $tableData['branchCode']; $queryBranch="SELECT * FROM branchs where branchId='$branchCode' and status='0' and deleted='0' ";
							$menuDatas=fetchData($queryBranch);
							foreach($menuDatas as $branchData)
							{  echo $branchData['branchName']." - ".$branchData['branchCode']; } ?> </td>
								<td class="col-md-3" ><?php  echo $tableData['applicantName']; ?> </td>
								<td class="col-md-3"><?php  echo $tableData['gurdianName']; ?></td>
								<td><?php  echo $tableData['memberMobile'];?> </td>
								<td><?php  echo $tableData['emiNo']; ?></td> 
								<td> <?php echo $tableData['dueDate'];   ?></td>
								<td> <?php echo $tableData['paymentDate'];   ?></td>
								<td><?php echo $tableData['emi']; ?> </td>
								<td><a  onClick="javascript: return confirm('Please confirm deletion');" href='deleteLoanEMI.php?id=<?php echo  $tableData['loanId']; ?>&emiNo=<?php echo  $tableData['emiNo']; ?>&url=<?php echo basename($_SERVER['PHP_SELF']); ?>' name="subDelete">Delete</a></td>
						  </tr>
						  
						<?php  }} ?>
						
						
					  </tbody>
                  </table>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            
            </div><!-- /.col -->
            
          </div><!-- /.row -->
          
          
        </section><!-- /.content -->
      </div>
	

<?php include("common/adminFooter.php");?>
