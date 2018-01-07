<?php
include("controller/pages_controller.php");
$menuType ="states";
$msg='';
if(isset($_REQUEST['addStates']))
{
	 $stateName = trim($_REQUEST['stateName']);
	 $status = $_REQUEST['status'];
	 $sql = "select stateName from states where stateName='$stateName'";
	 $res = mysql_query($sql);
		if(mysql_num_rows($res))
		{
		$msg="State Name Already created.";
		}
		else
		{
		$sql=mysql_query("INSERT INTO states(stateName,status) VALUES('$stateName','$status')");
		$msg="Data Sucessfully Submited";
		}
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
                <form role="form"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
                 <div class="box-body">
                        
                        <div class="form-group">
                        <label for="pageTitle">State Name</label>
                        <input type="text" class="form-control" id="stateName" name="stateName" placeholder="State Name" required />                   
                        </div>
                        <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                        <option value="0">Enabled </option>
                        <option value="1" >Disabled</option>
                        </select>
                        </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="addStates">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
            </div><!--/.col (left) -->
          </div>   <!-- /.row -->
        </section>   
</div>
      <!-- /.content-wrapper -->
<?php include("common/adminFooter.php");?>