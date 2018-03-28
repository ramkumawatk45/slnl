<?php
include("controller/pages_controller.php");
$menuType = "disabledLoans";
?>
<script type="text/javascript">
    $(document).ready(function() {
	var fileTitle = "Inactive Loan customers";	
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
				'pageLength',
			{
			extend: 'pdf',
			footer: true,
			title: fileTitle,
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
				title: fileTitle,
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
				title: fileTitle,
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
				title: fileTitle,
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
		<?php if($_SESSION['userType']=="ADMIN")
				{
		?>			
        <section class="content-header" id="addLoan">
          <h1>&nbsp;          </h1>
          <ol class="breadcrumb">
            <li><b><a href="addLoan.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Loan </a></b></li>
          </ol>
        </section>
		<?php 
				}
		?>		
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
			   
                <div class="box-header">
                  <h3 class="box-title">Inactive Loan customers</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
                  <table id="example" class="table table-bordered table-striped " cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th class="col-md-1">Sr. no.</th>
                        <th class="col-md-1">Loan Id</th>
						<th class="col-md-1">Member Id</th>
						<th class="col-md-2">Branch</th>
						<th class="col-md-1">Area</th>
						<th class="col-md-2">Customer Name</th>
						<th class="col-md-2">Gurdian Name</th>
						<th class="col-md-2">Mobile No.</th>
						<th class="col-md-2">Loan Amount</th>
						<th class="col-md-2">No.Of EMI</th>
						<th class="col-md-2">EMI</th>
						<th class="col-md-2">Create Date</th>
                        <th class="col-md-1">Status</th>
                        <th class="col-md-1">Edit</th>
                        <!--<th class="col-md-1">Delete</th> -->
                      </tr>
                    </thead>
					<tbody>
                    <?php
					$branchId = $_SESSION['branchId'];	
					if($_SESSION['userType']=="ADMIN")
					{
						$query="select loantable.* , loanplantable.planDuration , max(emitable.emiNO) AS maxEmiNO , plantypestable.planName AS loanPlanType   from loans loantable inner join loanemi emitable on loantable.loanId=emitable.loanId inner join loanplan loanplantable on loantable.loanPlanId=loanplantable.id inner join plantypes plantypestable on loanplantable.planType=plantypestable.id where loantable.status='1'  group by loantable.loanId order by loantable.id ";
					}
					else
					{
							$query=" select loantable.* , loanplantable.planDuration , max(emitable.emiNO) AS maxEmiNO , plantypestable.planName AS loanPlanType   from loans loantable inner join loanemi emitable on loantable.loanId=emitable.loanId inner join loanplan loanplantable on loantable.loanPlanId=loanplantable.id inner join plantypes plantypestable on loanplantable.planType=plantypestable.id where loantable.status='1'  and loantable.branchCode='$branchId'   group by loantable.loanId order by loantable.id";
					}	
					$pageData=fetchData($query);
					if (is_array($pageData) || is_object($pageData))
					{
					$i=1;
					foreach($pageData as $tableData)
					{
						$planDuration = $tableData['planDuration'];
						if($tableData['loanPlanType'] == "DAILY")
						{
							$planDuration = $planDuration * 30; 
						}	
						if($planDuration  != $tableData['maxEmiNO'])
						{	
					?>
                      <tr>
                         <td><?php echo  $i++; ?></td>
						 <td><a href="loansEMI.php?id=<?php echo $tableData['loanId']; ?>" Title="Pay EMI"><?php echo $tableData['loanId']; ?> </a></td>
						 <td><a href="custDueReport.php?id=<?php echo $tableData['loanId']; ?>" Title="Pay EMI"><?php echo $tableData['memberId']; ?></a></td>
						<td><?php $branchCode = $tableData['branchCode']; $queryBranch="SELECT * FROM branchs where branchId='$branchCode' and status='0' and deleted='0' ";
						$menuDatas=fetchData($queryBranch);
						foreach($menuDatas as $branchData)
						{  echo $branchData['branchName']." - ".$branchData['branchCode']; } ?> </td>
						<td><?php $areaId = $tableData['areaId']; $queryBranch="SELECT * FROM areas where areaId='$areaId' and status='0' and deleted='0' ";
						$menuDatas=fetchData($queryBranch);
						if($menuDatas)
						{
						foreach($menuDatas as $branchData)
						{  echo $branchData['areaName']; } } ?> </td>
						<td><?php echo $tableData['applicantName']; ?> </td>
						<td><?php echo $tableData['gurdianName']; ?> </td>
						<td><?php echo $tableData['memberMobile']; ?> </td>	
						<td><?php echo $tableData['loanAmount']; ?> </td>
						<td><?php echo $planDuration; ?> </td>
						<td><?php echo $tableData['emi']; ?> </td>
						<td><?php echo $tableData['cDate']; ?> </td>								
                        <td><?php $status=$tableData['status']; if($status==0){ echo "Active"; } else{ echo "Inactive"; } ?></td>
                        <td><a href='editloan.php?id=<?php echo  $tableData['id'];?>'>Edit </a></td>
                       <!-- <td><a  onClick="javascript: return confirm('Please confirm deletion');" href='deleteArea.php?id=<?php echo  $tableData['id']; ?>&url=<?php echo basename($_SERVER['PHP_SELF']) ?>' name="subDelete">Delete</a></td>-->
                      </tr>
						<?php }} } ?>
					  </tbody>
                  </table>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            
            </div><!-- /.col -->
            
          </div><!-- /.row -->
          
          
        </section><!-- /.content -->
      </div>
<?php include("common/adminFooter.php");?>
