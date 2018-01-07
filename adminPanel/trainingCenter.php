<?php
include("controller/pages_controller.php");
$menuType = "trainingcenter";
?>
<script src="js/jquery.min.js"></script>   
<script type="text/javascript">
$(document).ready(function() 	
{
	if(($("#branchAccess").val() =="VIEW") || ($("#userAccess").val() =="VIEW"))
	{
		$("#branches").addClass("readWriteAccess");
	}
});	
</script>
<div class="content-wrapper" id="branches">
        <!-- Main content -->
        <section class="content-header">
          <h1>&nbsp;          </h1>
          <ol class="breadcrumb">
            <li><b><a href="addTrainingCenter.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Branch</a></b></li>
          </ol>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Branchs Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="category" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="col-md-1">Sr. no.</th>
                        <th>Branch Name </th>
                        <th class="col-md-2">Contact No</th>
                        
                        <th class="col-md-1">Status</th>
                        <th class="col-md-1">Edit</th>
						<th class="col-md-1">Delete</th>
                      </tr>
                    </thead>
					<tbody>
                     <?php
					$query="SELECT * FROM branchs where deleted='0' ";
					$pageData=fetchData($query);
					if (is_array($pageData) || is_object($pageData))
					{
					$i=1;
					foreach($pageData as $tableData)
					{
					?>
                      <tr>
                        <td><?php echo  $i++; ?></td>
                        <td><?php echo $tableData['branchName']; ?></td>
                        <td><?php echo $tableData['phoneNo']; ?> </td>
                        <td><?php $status=$tableData['status']; if($status==0){ echo "Enabled"; } else{ echo "Disabled"; } ?></td>
						<td><a href='editTrainingCenter.php?id=<?php echo  $tableData['branchId'];?>&districtId=<?php echo  $tableData['districtId'];?>&areacode=<?php echo  $tableData['areacode'];?> '>Edit </a></td>
                        <td><a  onClick="javascript: return confirm('Please confirm deletion');" href='deleteTrainingCenter.php?id=<?php echo  $tableData['branchId']; ?>&branchCode=<?php echo  $tableData['branchCode']; ?>&url=<?php echo basename($_SERVER['PHP_SELF']) ?>' name="subDelete">Delete</a></td> 
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
