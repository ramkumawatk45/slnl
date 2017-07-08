<?php
include("controller/pages_controller.php");
$menuType = "gallery";
?>
<div class="content-wrapper">
        <!-- Main content -->
        <section class="content-header">
          <h1>&nbsp;          </h1>
          <ol class="breadcrumb">
            <li><b><a href="addArea.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Area</a></b></li>
          </ol>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Area List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="category" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="col-md-1">Sr. no.</th>
                        <th>Areas Name</th>
                        <th class="col-md-1">Status</th>
                        <th class="col-md-1">Edit</th>
                        <th class="col-md-1">Delete</th>
                      </tr>
                    </thead>
					<tbody>
                     <?php
					$query="SELECT * FROM areas where deleted='0' ";
					$pageData=fetchData($query);
					if (is_array($pageData) || is_object($pageData))
					{
					$i=1;
					foreach($pageData as $tableData)
					{
					?>
                    
                      <tr>
                         <td><?php echo  $i++; ?></td>
						 <td><?php echo $tableData['areaName']; ?></td>
                        <td><?php $status=$tableData['status']; if($status==0){ echo "Enabled"; } else{ echo "Disabled"; } ?></td>
                        <td><a href='editArea.php?districtId=<?php echo  $tableData['districtId'];?>&areaId=<?php echo  $tableData['areaId'];?>'>Edit </a></td>
                        <td><a  onClick="javascript: return confirm('Please confirm deletion');" href='deleteArea.php?id=<?php echo  $tableData['areaId']; ?>&url=<?php echo basename($_SERVER['PHP_SELF']) ?>' name="subDelete">Delete</a></td>
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
