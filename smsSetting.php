<?php
include("controller/pages_controller.php");
$menuType =+"viewPages";
$msg='';
if(isset($_REQUEST['editStates']))
{
	$smsApiKey = trim($_REQUEST['smsApiKey']);
	$status = $_REQUEST['status'];
	$sql=mysql_query("update defaults set defaultVal='$smsApiKey',status='$status' where type='SMSAPIKEY'");
	$msg=updated;
	header("location:smsSetting.php");	
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
                  <h3 class="box-title">SMS API Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"  action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                	<?php $query="SELECT * FROM defaults where type='SMSAPIKEY'";
					$pagesData=fetchData($query);
					foreach($pagesData as $pageData)
					?>
                  <div class="box-body"> 
                    <div class="form-group">
                      <label for="pageTitle">SMS API Key</label>
                      <input type="text" class="form-control" id="smsApiKey" name="smsApiKey"value="<?php echo $pageData['defaultVal']; ?>" readonly />                 
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

