<?php
include("controller/pages_controller.php");
$menuType =+"viewPages";
$id=$_REQUEST['id'];
$msg='';
if(isset($_REQUEST['addCenter']))
{	
	$branchName = $_REQUEST['branchName'];
	$branchCode = $_REQUEST['branchCode'];
	$branchAddress = $_REQUEST['branchAddress'];
	$stateId = $_REQUEST['state'];
	$districtId = $_REQUEST['district'];
	$areaCode = $_REQUEST['area'];
	$zipCode = $_REQUEST['zipCode'];
	$phoneNo = $_REQUEST['phoneNo'];
	$status = $_REQUEST['status'];
	$userName = $_REQUEST['userName'];
	$password = md5($_REQUEST['password']);
	$sql = "select branchName ,branchCode from branchs where branchName='$branchName' or branchCode='$branchCode'";
	 $res = mysql_query($sql);
		if(mysql_num_rows($res) > 1)
		{
			$msg="Provided Detail Already exits.";
		}
		else
		{
				// $sql1 = "select username from user where username='$userName'";
				// $res1 = mysql_query($sql1);
				// if(mysql_num_rows($res1))
				// {
					// $msg="Username Already have taken.";
				// }
				// else
				// {
				$sql=mysql_query("update branchs set branchName='$branchName',branchCode='$branchCode',branchAddress='$branchAddress',zipCode='$zipCode',phoneNo='$phoneNo',areaCode='$areaCode',stateId='$stateId',districtId='$districtId',status='$status' where branchId='$id'");
				//$sql1=mysql_query("update user set username='$userName',password='$password',status='$status' where branchId='$id'");
				$msg=updated;
				$pageHrefLink ="trainingcenter.php";
				//}
		}
}
?>
<script src="js/jquery.min.js"></script>   
<script type="text/javascript">
$(document).ready(function(){
	var stateID = $('#state').val();
	var districtId = $('#districtId').val();
	var areaCode = $("#areaCode").val();
	if(stateID){
            $.ajax({
                type:'POST',
                url:'ajaxUpdateData.php',
                data:'state_id='+stateID+'&district_id='+districtId,
                success:function(html){
					var returnData= '<option value="0">Select District</option>'+html;
                    $('#district').html(returnData);
					$('#district').focus();
                }
            }); 
        }else{
            $('#district').html('<option value="">Select State first</option>'); 
        }
	
    $('#state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'state_id='+stateID,
                success:function(html){
					var returnData= '<option value="0">Select District</option>'+html;
                    $('#district').html(returnData);
					$('#district').focus();
                }
            }); 
        }else{
            $('#district').html('<option value="">Select State first</option>'); 
        }
    });
	 $('#district').on('change focus',function(){
        var districtID = $(this).val();
        if(districtID){
            $.ajax({
                type:'POST',
                url:'ajaxUpdataArea.php',
                data:'districtID='+districtID+'&areaCode='+areaCode,
                success:function(html){
					var returnData= '<option value="0">Select Area</option>'+html;
                    $('#area').html(returnData);
                }
            }); 
        }else{
            $('#area').html('<option value="">Select Area</option>'); 
        }
    });
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
                  <h3 class="box-title">Branch Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"  action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
				<input type="hidden" id="districtId" value="<?php echo $_REQUEST['districtId']; ?>">
				<input type="hidden" id="areaCode" value="<?php echo $_REQUEST['areacode']; ?>">

                	<?php $query="SELECT * FROM branchs where branchId='$id' ";
					$pagesData=fetchData($query);
					foreach($pagesData as $imagesData)
					{
					?>
                  <div class="box-body">
					<div class="form-group col-md-6">
                      <label for="pageTitle">Branch Name </label>
                      <input type="text" class="form-control" id="branchName" name="branchName" placeholder="Branch Name " maxlength="100" value="<?php echo $imagesData['branchName'] ?>"  required />                  
                    </div>
					<div class="form-group col-md-6">
                      <label for="pageTitle">Branch Code </label>
                      <input type="text" class="form-control" id="branchCode" name="branchCode" placeholder="Branch Code " maxlength="100"  value="<?php echo $imagesData['branchCode'] ?>" required />                  
                    </div>
					<div class="form-group col-md-12">
                      <label for="pageTitle">Address </label>
                      <textarea class="form-control" id="branchAddress" name="branchAddress" placeholder="Branch Address " maxlength="100"  required><?php echo $imagesData['branchAddress'] ?></textarea>                  
                    </div>
					
					<div class="form-group col-md-6">
                      <label>State</label>
                      <select class="form-control" name="state" id="state" required>
                      <option value="0" >Select State</option>
                     <?php 
					  $stateId=$imagesData['stateId'];
                    $query="SELECT * FROM states where deleted='0' and status='0'";
					$stateData=fetchData($query);
					foreach($stateData as $tableData)
					{ ?><option value="<?php echo $tableData['stateId']; ?>" <?php if($imagesData['stateId'] ==$tableData['stateId']) echo 'selected'; ?>><?php  echo $tableData['stateName'] ?></option> <?php } ?>
                      </select>
                    </div>
					<div class="form-group col-md-6">
                      <label>District</label>
                      <select class="form-control" name="district" id="district" required> </select>
                    </div>
					<div class="form-group col-md-6">
                      <label for="pageTitle">Area</label>
                      <select class="form-control" name="area" id="area" required>
						</select>
                    </div>
					<div class="form-group col-md-6">
                      <label for="pageTitle"> Zip Code </label>
                      <input type="text" class="form-control" id="centerZipCode" name="zipCode" placeholder="Zip Code " maxlength="6" value="<?php echo $imagesData['zipCode'] ?>"  required />                  
                    </div>
					<div class="form-group col-md-6">
                      <label for="pageTitle"> Phone No. </label>
                      <input type="text" class="form-control" id="centerPhoneNo" name="phoneNo" placeholder="Phone No." maxlength="13" value="<?php echo $imagesData['phoneNo'] ?>"  required />                  
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
					<?php 
					$branchCode =$imagesData['branchCode'];
					$query="select * from user where branchCode='$branchCode'";
					$pagessData=fetchData($query);
					foreach($pagessData as $loginData)
					{
					?>
					<h3 class="box-title hide">Branch Login Detail</h3>
					</div>
					<div class="form-group col-md-6 hide">
                      <label for="pageTitle">User Name </label>
                      <input type="text" class="form-control" id="userName" name="userName" value="<?php echo $loginData['username'] ?>" maxlength="100" />                  
                    </div>
					<div class="form-group col-md-6 hide">
                      <label for="pageTitle">Password </label>
                      <input type="text" class="form-control" id="password" name="password" value="<?php echo $loginData['password'] ?>"maxlength="15"  />                  
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
					<?php }} ?>
              </div><!-- /.box -->



            </div><!--/.col (left) -->

          </div>   <!-- /.row -->
        </section>      
</div>
      <!-- /.content-wrapper -->
<?php include("common/adminFooter.php");?>

