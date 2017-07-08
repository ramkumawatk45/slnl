<?php
include("controller/pages_controller.php");
$menuType =+"viewPages";
$areaId=$_REQUEST['areaId'];
$districtId = $_REQUEST['districtId'];
$msg='';
$pageHrefLink='';
if(isset($_REQUEST['editStates']))
{
	
	$areaName = trim($_REQUEST['areaName']);
	 $status = $_REQUEST['status'];
	 
		$sql=mysql_query("update areas set areaName='$areaName',status='$status' where areaId='$areaId' and districtId='$districtId'");
		$msg=updated;
		$pageHrefLink="areas.php";
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
                  <h3 class="box-title">Area Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"  action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                	<?php $query="SELECT * FROM areas where areaId='$areaId' and districtId='$districtId'";
					$pagesData=fetchData($query);
					foreach($pagesData as $pageData)
					?>
                  <div class="box-body"> 
					<div class="form-group">
                      <label>Select District</label>
                      <select class="form-control" name="districtId" id="districtId" required>
                     <?php 
                    	$query="SELECT * FROM districts where deleted='0' and status='0'";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option value="<?php echo $tableData['districtId']; ?>"<?php if($tableData['districtId'] == $districtId)echo "selected"; ?>><?php  echo $tableData['districtName'] ?></option>			<?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="pageTitle">Area Name</label>
                      <input type="text" class="form-control" id="areaName" name="areaName"value="<?php echo $pageData['areaName']; ?>"  required />                 
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

