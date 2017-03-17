<?php
include("controller/pages_controller.php");
$menuType =+"viewPages";
$id=$_REQUEST['id'];
$msg='';
if(isset($_REQUEST['editStates']))
{
	
	$stateName = trim($_REQUEST['stateName']);
	 $status = $_REQUEST['status'];
		$sql=mysql_query("update states set stateName='$stateName',status='$status' where stateId='$id'");
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
                  <h3 class="box-title">State Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"  action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                	<?php $query="SELECT * FROM states where stateId='$id'";
					$pagesData=fetchData($query);
					foreach($pagesData as $pageData)
					?>
                  <div class="box-body"> 
                    <div class="form-group">
                      <label for="pageTitle">State Name</label>
                      <input type="text" class="form-control" id="stateName" name="stateName"value="<?php echo $pageData['stateName']; ?>"  required />                 
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

