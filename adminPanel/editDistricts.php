<?php
include("controller/pages_controller.php");
$menuType = "districts";
$id=$_REQUEST['id'];
$parentId = $_REQUEST['stateId'];
$msg='';
if(isset($_REQUEST['editStates']))
{
	
	$districtName = trim($_REQUEST['districtName']);
	 $status = $_REQUEST['status'];
	 
		$sql=mysql_query("update districts set districtName='$districtName',status='$status' where districtId='$id'");
		$msg=updated;
		
}
?>
      <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">  
	<section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">District Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"  action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                	<?php $query="SELECT * FROM districts where districtId='$id'";
					$pagesData=fetchData($query);
					foreach($pagesData as $pageData)
					?>
                  <div class="box-body"> 
					<div class="form-group">
                      <label>Select State</label>
                      <select class="form-control" name="stateId" id="stateId" required>
                     <?php 
                    	$query="SELECT * FROM states where deleted='0' and status='0'";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option value="<?php echo $tableData['stateId']; ?>"<?php if($tableData['stateId'] == $parentId)echo "selected"; ?>><?php  echo $tableData['stateName'] ?></option>			<?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="pageTitle">District Name</label>
                      <input type="text" class="form-control" id="districtName" name="districtName"value="<?php echo $pageData['districtName']; ?>"  required />                 
                    </div>
					
                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" name="status">
                      <?php $status=$pageData['status'];
					   ?>
					  <option value="0"<?php if($status ==0) echo 'selected'; ?>>Enabled</option>
    				<option value="1"<?php if( $status == 1) echo 'selected'; ?>>Disabled</option>
                      </select>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="editStates">Update</button>
                  </div>
                </form>
              </div><!-- /.box -->



            </div><!--/.col (left) -->

          </div>   <!-- /.row -->
        </section>      
</div>
      <!-- /.content-wrapper -->
<?php include("common/adminFooter.php");?>

