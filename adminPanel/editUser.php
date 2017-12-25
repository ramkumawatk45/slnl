<?php
include("controller/pages_controller.php");
$menuType =+"viewPages";
$id=$_REQUEST['id'];
$msg='';
if(isset($_REQUEST['addCenter']))
{	
	$userAccess = $_REQUEST['userAccess'];
	$status = $_REQUEST['status'];
	$userName = trim($_REQUEST['userName']);
	$password = trim($_REQUEST['password']);
	$sql = "select username from user where username='$userName' ";
	 $res = mysql_query($sql);
		if(mysql_num_rows($res) > 1)
		{
			$msg="Provided Detail Already exits.";
			?>
				<script>alert("Provided Detail Already exits")</script>
			<?php
		}
		else
		{
			$sql1=mysql_query("update user set username='$userName',password='$password',status='$status' , userAccess='$userAccess' where id='$id'");
			$msg=updated;
			$pageHrefLink ="users.php";
		}
}
?>
<script src="js/jquery.min.js"></script>   
<script type="text/javascript">
$(document).ready(function(){
	
});
</script>
      <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">  
	<section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">User Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"  action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                	<?php $query="SELECT * FROM  user where id='$id' and deleted='0'";
					$pagesData=fetchData($query);
					foreach($pagesData as $imagesData)
					{
					?>
                  <div class="box-body">
					  <div class="form-group col-md-6">
                      <label>User Access</label>
                      <select class="form-control" name="userAccess">
                       <?php $userAccess=$imagesData['userAccess'];
					   ?>
					  <option value="EDIT"<?php if($userAccess =="EDIT") echo 'selected'; ?>>EDIT</option>
    				<option value="VIEW"<?php if( $userAccess =="VIEW") echo 'selected'; ?>>VIEW</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Status</label>
                      <select class="form-control" name="status">
                       <?php $status=$imagesData['status'];
					   ?>
					  <option value="0"<?php if($status ==0) echo 'selected'; ?>>Enabled</option>
    				<option value="1"<?php if( $status == 1) echo 'selected'; ?>>Disabled</option>
                      </select>
                    </div>
                  </div><!-- /.box-body -->
					<div class="box-header with-border">
					<h3 class="box-title ">User Login Detail</h3>
					</div>
					 <div class="box-body">
					<div class="form-group col-md-6 ">
                      <label for="pageTitle">User Name </label>
                      <input type="text" class="form-control" id="userName" name="userName" value="<?php echo $imagesData['username']; ?>" maxlength="100" />                  
                    </div>
					<div class="form-group col-md-6 ">
                      <label for="pageTitle">Password </label>
                      <input type="text" class="form-control" id="password" name="password" value="<?php echo utf8_decode($imagesData['password']); ?>"maxlength="15"  />          </div>
					</div>  
                  <div class="box-footer">
					<div class="col-md-6">
					<button type="reset" class="btn btn-primary pull-right">Reset</button>
					</div>
					<div class="col-md-6">
					<button type="submit" class="btn btn-primary pull-left " name="addCenter">Submit</button>
					</div>

                  </div>
                </form>
					<?php } ?>
              </div><!-- /.box -->



            </div><!--/.col (left) -->

          </div>   <!-- /.row -->
        </section>      
</div>
      <!-- /.content-wrapper -->
<?php include("common/adminFooter.php");?>

