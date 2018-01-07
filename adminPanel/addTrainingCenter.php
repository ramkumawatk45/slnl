<?php
include("controller/pages_controller.php");
$menuType ="trainingcenter";
$msg='';
$pageHrefLink='';
if(isset($_REQUEST['addCenter']))
{
	$branchName = $_REQUEST['branchName'];
	$branchCode = $_REQUEST['branchCode'];
	$branchAddress = $_REQUEST['branchAddress'];
	$branchAccess = $_REQUEST['branchAccess'];
	$stateId = $_REQUEST['state'];
	$districtId = $_REQUEST['district'];
	$areaCode = $_REQUEST['area'];
	$zipCode = $_REQUEST['zipCode'];
	$phoneNo = $_REQUEST['phoneNo'];
	$status = $_REQUEST['status'];
	//$userName = $_REQUEST['userName'];
	//$password = trim($_REQUEST['password']);
	$sql = "select branchName ,branchCode from branchs where branchName='$branchName' or branchCode='$branchCode'";
	 $res = mysql_query($sql);
		if(mysql_num_rows($res))
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
				$sql=mysql_query("INSERT INTO branchs(branchName,branchCode,branchAddress,zipCode,phoneNo,areaCode,stateId,districtId,status,branchAccess) VALUES('$branchName','$branchCode','$branchAddress','$zipCode','$phoneNo','$areaCode','$stateId','$districtId','$status','$branchAccess')");
				//$sql1=mysql_query("INSERT INTO user(branchCode,usertype,username,password,status,userAccess) VALUES('$branchCode','BRANCH','$userName','$password','$status','$branchAccess')");
				$msg=inserted;
				$pageHrefLink ="trainingCenter.php";
				//}
		}
}
?>
<script src="js/jquery.min.js"></script>   
<script type="text/javascript">
$(document).ready(function(){
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
                url:'ajaxArea.php',
                data:'districtID='+districtID,
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
                  <div class="box-body">
					<div class="form-group col-md-6">
                      <label for="pageTitle">Branch Name </label>
                      <input type="text" class="form-control" id="branchName" name="branchName" placeholder="Branch Name " maxlength="100"  required />                  
                    </div>
					<div class="form-group col-md-6">
                      <label for="pageTitle">Branch Code </label>
                      <input type="text" class="form-control" id="branchCode" name="branchCode" placeholder="Branch Code " maxlength="100"  required />                  
                    </div>
					<div class="form-group col-md-6">
                      <label for="pageTitle">Address </label>
                      <textarea class="form-control" id="branchAddress" name="branchAddress" placeholder="Branch Address " maxlength="100"  required></textarea>                  
                    </div>
					<div class="form-group col-md-6">
                      <label>Branch Access</label>
                      <select class="form-control" name="branchAccess">
                      <option value="EDIT">EDIT</option>
                      <option value="VIEW">VIEW</option>
                      </select>
                    </div>
					<div class="form-group col-md-6">
                      <label>State</label>
                      <select class="form-control" name="state" id="state" required>
                      <option value="0" >Select State</option>
                     <?php 
                    $query="SELECT * FROM states where deleted='0' and status='0'";
					$stateData=fetchData($query);
					foreach($stateData as $tableData)
					{ ?><option value="<?php echo $tableData['stateId']; ?>"><?php  echo $tableData['stateName'] ?></option> <?php } ?>
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
                      <input type="text" class="form-control" id="centerZipCode" name="zipCode" placeholder="Zip Code " maxlength="6"  required />                  
                    </div>
					<div class="form-group col-md-6">
                      <label for="pageTitle"> Phone No. </label>
                      <input type="text" class="form-control" id="centerPhoneNo" name="phoneNo" placeholder="Phone No." maxlength="13"  required />                  
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

