<?php
include("controller/pages_controller.php");
$menuType ="users";
$msg='';
$pageHrefLink='';
if(isset($_REQUEST['addCenter']))
{
	$userAccess = $_REQUEST['userAccess'];
	$userRole = $_REQUEST['userRole'];
	$branchCode = $_REQUEST['branchCode'];
	$status = $_REQUEST['status'];
	$userName = $_REQUEST['userName'];
	$password = trim($_REQUEST['password']);
	$userType = "";
	if($branchCode == 0 )
	{
		$userType = "ADMIN";
	}
	else
	{
		$userType = "BRANCH";
	}	
	$sql1 = "select username from user where username='$userName'";
	$res1 = mysql_query($sql1);
	if(mysql_num_rows($res1))
	{
		$msg="Username Already have taken.";
	}
	else
	{
		$sql1=mysql_query("INSERT INTO user(branchCode,usertype,username,password,status,userAccess,userRole) VALUES('$branchCode','$userType','$userName','$password','$status','$userAccess','$userRole')");
		$msg=inserted;
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
                  <div class="box-body">
					<div class="form-group col-md-6">
                      <label>User Access</label>
                      <select class="form-control" name="userAccess">
                      <option value="EDIT">EDIT</option>
                      <option value="VIEW">VIEW</option>
                      </select>
                    </div>
					<div class="form-group col-md-6">
                        <label for="pageTitle">Branchs</label>
						<select class="form-control" name="branchCode" id="branchCode" required <?php if($_SESSION['branchCode']){echo "disabled";} ?>>
						<?php 
                    	$query="SELECT * FROM branchs where deleted='0' and status='0'";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option <?php if($_SESSION['branchCode'] ==$tableData['branchCode']){echo "selected";} ?> value="<?php echo $tableData['branchCode']; ?>"><?php  echo $tableData['branchName']." - ".$tableData['branchCode'] ?></option>	<?php } ?>
						</select>
					</div>
					<div class="form-group col-md-6">
                      <label>User Role</label>
                      <select class="form-control" name="userRole">
                      <option value="ADMIN">Admin</option>
                      <option value="BRANCH">Branch</option>
					  <option value="FIELDWORKER">Field Worker</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Status</label>
                      <select class="form-control" name="status">
                      <option value="0">Enabled </option>
                      <option value="1" >Disabled</option>
                      </select>
                    </div>
                  </div><!-- /.box-body -->
					<div class="box-header with-border">
					<h3 class="box-title">Login Detail</h3>
					</div>
					<div class="box-body">
					<div class="form-group col-md-6">
                      <label for="pageTitle">User Name </label>
                      <input type="text" class="form-control" id="userName" name="userName" placeholder="User Name " maxlength="100"  required />                  
                    </div>
					<div class="form-group col-md-6">
                      <label for="pageTitle">Password </label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password " maxlength="15"  required />                  
                    </div>
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
              </div><!-- /.box -->



            </div><!--/.col (left) -->

          </div>   <!-- /.row -->
        </section>      
</div>
      <!-- /.content-wrapper -->
<?php include("common/adminFooter.php");?>

