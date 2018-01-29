<?php
include("controller/pages_controller.php");
$menuType = "loanRequest";
?>
<script type="text/javascript">
    $(document).ready(function() {
	var pagePrintTitle = "Loan Customer Requests List"	
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
				'pageLength',
			{
			extend: 'pdf',
			footer: true,
			title: pagePrintTitle,
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
				title:pagePrintTitle,
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
				title: pagePrintTitle,
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
				title: pagePrintTitle,
                exportOptions: {
                columns: ':visible',
				modifier: {
                    page: 'current'
                }
				}
            },
            'colvis'
        ],
		lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 ', '25 ', '50 ', 'Show all' ]
        ]
    });
	if(($("#branchAccess").val() =="VIEW") || ($("#userAccess").val() =="VIEW"))
	{
		$("#addLoan").addClass("readWriteAccess");
	}
});
</script>
<div class="content-wrapper">
	
        <!-- Main content -->		
        <section class="content-header" id="addLoan">
          <h1>&nbsp;          </h1>
          <ol class="breadcrumb">
            <li><b><a href="addLoanRequest.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Loan Request </a></b></li>
          </ol>
        </section>	
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
			   
                <div class="box-header">
                  <h3 class="box-title">Loan Requests</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
                  <table id="example" class="table table-bordered table-striped " cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th class="col-md-1">Sr. no.</th>
						<th class="col-md-1">Member Id</th>
						<th class="col-md-2">Branch</th>
						<th class="col-md-2">Customer Name</th>
						<th class="col-md-2">Gurdian Name</th>
						<th class="col-md-2">Mobile No.</th>
						<th class="col-md-2">Loan Amount</th>
						<th class="col-md-2">EMI</th>
						<th class="col-md-2">Create Date</th>
                        <th class="col-md-1">Status</th>
                        <th class="col-md-1">View</th>
                      </tr>
                    </thead>
					<tbody>
                    <?php
					$branchId = $_SESSION['branchId'];	
					if($_SESSION['userType']=="ADMIN")
					{
						$query="SELECT * FROM loanrequests where deleted='0' order by id Desc  ";
					}
					else
					{
							$query=" SELECT * FROM loanrequests where deleted='0' order by id Desc";
					}	
					$pageData=fetchData($query);
					if (is_array($pageData) || is_object($pageData))
					{
					$i=1;
					foreach($pageData as $tableData)
					{
					?>
                      <tr>
                         <td><?php echo  $i++; ?></td>
						 <td><a Title="Pay EMI"><?php echo $tableData['memberId']; ?></a></td>
						<td><?php $branchCode = $tableData['branchCode']; $queryBranch="SELECT * FROM branchs where branchId='$branchCode' and status='0' and deleted='0' ";
						$menuDatas=fetchData($queryBranch);
						foreach($menuDatas as $branchData)
						{  echo $branchData['branchName']." - ".$branchData['branchCode']; } ?> </td>
						<td><?php echo $tableData['applicantName']; ?> </td>
						<td><?php echo $tableData['gurdianName']; ?> </td>
						<td><?php echo $tableData['memberMobile']; ?> </td>	
						<td><?php echo $tableData['loanAmount']; ?> </td>
						<td><?php echo $tableData['emi']; ?> </td>
						<td><?php echo custumDateFormat($tableData['createDate']); ?> </td>								
                        <td><?php echo $tableData['requestStatus']; ?></td>
                        <td><a href='viewloanRequest.php?id=<?php echo  $tableData['id'];?>'>View </a></td>
                      </tr>
                    <?php } } ?>
					  </tbody>
                  </table>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            
            </div><!-- /.col -->
            
          </div><!-- /.row -->
          
          
        </section><!-- /.content -->
      </div>
	  
<?php include("common/adminFooter.php");?>
