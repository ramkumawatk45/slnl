<?php
include("controller/pages_controller.php");
$menuType =+"gallery";
$msg='';
$pageHrefLink='';
if(isset($_REQUEST['addStates']))
{
	 $districtId = $_REQUEST['districtId'];
	 $areaName = trim($_REQUEST['areaName']);
	 $status = $_REQUEST['status'];
	 $sql = "select areaName from areas where deleted='0' and areaName='$areaName'";
	 $res = mysql_query($sql);
		if(mysql_num_rows($res))
		{
		$msg="Area Name Already created.";
		}
		else
		{
		$sql=mysql_query("INSERT INTO areas(districtId,areaName,status) VALUES('$districtId','$areaName','$status')");
		$msg="Data Sucessfully Submited";
		$pageHrefLink="areas.php";

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
                  		<h3 class="box-title">Area Detail</h3>
                	</div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
                 <div class="box-body">
                       <div class="form-group">
                      <label>Select District</label>
                      <select class="form-control" name="districtId" id="districtId" required>
                     <?php 
                    	$query="SELECT * FROM districts where deleted='0' and status='0'";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option value="<?php echo $tableData['districtId']; ?>"><?php  echo $tableData['districtName'] ?></option>	<?php } ?>
                      </select>
						</div>
                        <div class="form-group">
                        <label for="pageTitle">Area Name</label>
                        <input type="text" class="form-control" id="areaName" name="areaName" placeholder="Area Name" required />                   
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