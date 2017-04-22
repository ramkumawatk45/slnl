<?php
include("controller/pages_controller.php");
$menuType = "gallery";
?>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
				'pageLength',
			{
			extend: 'pdf',
			footer: true,
			title: 'Loan Customer List',
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
				title: 'Loan Customer List',
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
				title: 'Loan Customer List',
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
				title: 'Loan Customer List',
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
    } );
} );
</script>
<div class="content-wrapper">
	
        <!-- Main content -->
		<?php if($_SESSION['userType']=="ADMIN")
				{
		?>			
        <section class="content-header">
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
                  <h3 class="box-title">Loans</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
                  <table id="example" class=" table table-bordered table-striped">
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
						$query="SELECT * FROM loans where deleted='0'  ";
					}
					else
					{
							$query=" SELECT * FROM loans where branchCode='$branchId'";
					}	
					$pageData=fetchData($query);
					if (is_array($pageData) || is_object($pageData))
					{
					$i=1;
					foreach($pageData as $tableData)
					{
						$cdate=explode('/',$tableData['cDate']);
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
							$loanId = $tableData['loanId'];
							//$sql=mysql_query("update loans set createDate='$emidate' where loanId='$loanId'");
					?>
                      <tr>
                         <td><?php echo  $i++; ?></td>
						 <td><a href="LoansEMI.php?id=<?php echo $tableData['loanId']; ?>" Title="Pay EMI"><?php echo $tableData['loanId']; ?> </a></td>
						 <td><a href="custDueReport.php?id=<?php echo $tableData['loanId']; ?>" Title="Pay EMI"><?php echo $tableData['memberId']; ?></a></td>
						<td><?php $branchCode = $tableData['branchCode']; $queryBranch="SELECT * FROM branchs where branchId='$branchCode' and status='0' and deleted='0' ";
						$menuDatas=fetchData($queryBranch);
						foreach($menuDatas as $branchData)
						{  echo $branchData['branchName']." - ".$branchData['branchCode']; } ?> </td>
						<td><?php $areaId = $tableData['areaId']; $queryBranch="SELECT * FROM areas where areaId='$areaId' and status='0' and deleted='0' ";
						$menuDatas=fetchData($queryBranch);
						foreach($menuDatas as $branchData)
						{  echo $branchData['areaName']; } ?> </td>
						<td><?php echo $tableData['applicantName']; ?> </td>
						<td><?php echo $tableData['gurdianName']; ?> </td>
						<td><?php echo $tableData['memberMobile']; ?> </td>	
						<td><?php echo $tableData['cDate']; ?> </td>								
                        <td><?php $status=$tableData['status']; if($status==0){ echo "Enabled"; } else{ echo "Disabled"; } ?></td>
                        <td><a href='editLoan.php?id=<?php echo  $tableData['id'];?>'>Edit </a></td>
                       <!-- <td><a  onClick="javascript: return confirm('Please confirm deletion');" href='deleteArea.php?id=<?php echo  $tableData['id']; ?>&url=<?php echo basename($_SERVER['PHP_SELF']) ?>' name="subDelete">Delete</a></td>-->
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
