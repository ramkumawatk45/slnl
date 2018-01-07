<?php
include("controller/pages_controller.php");
$menuType = "districts";
$msg='';
if(isset($_REQUEST['addStates']))
{
	 $stateId = $_REQUEST['stateId'];
	 $districtName = trim($_REQUEST['districtName']);
	 $status = $_REQUEST['status'];
	 $sql = "select districtName from districts where districtName='$districtName'";
	 $res = mysql_query($sql);
		if(mysql_num_rows($res))
		{
		$msg="District Name Already created.";
		}
		else
		{
		$sql=mysql_query("INSERT INTO districts(stateId,districtName,status) VALUES('$stateId','$districtName','$status')");
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
                  		<h3 class="box-title">District Detail</h3>
                	</div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
                 <div class="box-body">
                       <div class="form-group">
                      <label>Select State</label>
                      <select class="form-control" name="stateId" id="stateId" required>
                     <?php 
                    	$query="SELECT * FROM states where deleted='0' and status='0'";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option value="<?php echo $tableData['stateId']; ?>"><?php  echo $tableData['stateName'] ?></option>	<?php } ?>
                      </select>
						</div>
                        <div class="form-group">
                        <label for="pageTitle">District Name</label>
                        <input type="text" class="form-control" id="districtName" name="districtName" placeholder="District Name" required />                   
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