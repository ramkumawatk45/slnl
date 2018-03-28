<?php
include("controller/pages_controller.php");
$menuType = "states";
?>
<script src="js/jquery.min.js"></script>   
<script type="text/javascript">
$(document).ready(function() 	
{
	if(($("#branchAccess").val() =="VIEW") || ($("#userAccess").val() =="VIEW"))
	{
		$("#states").addClass("readWriteAccess");
	}
});	
</script>
<div class="content-wrapper" id="states">
        <!-- Main content -->
        <section class="content-header">
          <h1>&nbsp;          </h1>
          <ol class="breadcrumb">
            <li><b><a href="addState.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add State</a></b></li>
          </ol>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">States List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="category" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr. no.</th>
                        <th>State Name</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <!--<th>Delete</th> -->
                      </tr>
                    </thead>
					<tbody>
                     <?php
					$query="SELECT * FROM states where deleted='0' ";
					$pageData=fetchData($query);
					if (is_array($pageData) || is_object($pageData))
					{
					$i=1;
					foreach($pageData as $tableData)
					{
					?>
                    
                      <tr>
                         <td><?php echo  $i++; ?></td>
                        <td><?php echo $tableData['stateName']; ?></td>
                        <td><?php $status=$tableData['status']; if($status==0){ echo "Enabled"; } else{ echo "Disabled"; } ?></td>
                        <td><a href='editStates.php?id=<?php echo  $tableData['stateId'];?>'>Edit </a></td>
                        <!--<td><a  onClick="javascript: return confirm('Please confirm deletion');" href='deleteGallery.php?id=<?php echo  $tableData['galleryId']; ?>&url=<?php echo basename($_SERVER['PHP_SELF']) ?>' name="subDelete">Delete</a></td> -->
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
