<?php
include("controller/pages_controller.php");
$menuType =+"gallery";
$msg='';
$pageHrefLink='';
if(isset($_REQUEST['addStates']))
{
	 $branchId = $_REQUEST['branchId'];
	 $loanId = $_REQUEST['loanId'];
	 $formNo = $_REQUEST['formNo'];
	 $memberId = $_REQUEST['memberId'];
	 $cDate = $_REQUEST['cDate'];
	 $createdate = explode('/', $cDate);
	 $month = $createdate[1];
	 $day   = $createdate[0];
	 $year  = $createdate[2];
	 $joincDate = $year.'-'.$month.'-'.$day;
	 $applicantName = $_REQUEST['applicantName'];
	 $gurdianName = $_REQUEST['gurdianName'];
	 $applicantDob = $_REQUEST['applicantDob'];
	 $applicantAge = $_REQUEST['applicantAge'];
	 $address = $_REQUEST['address'];
	 $state = $_REQUEST['state'];
	 $district = $_REQUEST['district'];
	 $area = $_REQUEST['area'];
	 $zipCode = $_REQUEST['zipCode'];
	 $gender = $_REQUEST['gender'];
	 $maritalStatus = $_REQUEST['maritalStatus'];
	 $gMemberNo = $_REQUEST['gMemberNo'];
	 $gMemberName = $_REQUEST['gMemberName'];
	 $gMemberMobile = $_REQUEST['gMemberMobile'];
	 $planId = $_REQUEST['planId'];
	 $planType = $_REQUEST['planType'];
	 $loanAmount = $_REQUEST['loanAmount'];
	 $rateOfInterest = $_REQUEST['rateOfInterest'];
	 $emi = $_REQUEST['emi'];
	 $paymentMode = $_REQUEST['paymentMode'];
	 $chequeNo = $_REQUEST['chequeNo'];
	 $chequeDate = $_REQUEST['chequeDate'];
	 $bankAc = $_REQUEST['bankAc'];
	 $bankName = $_REQUEST['bankName'];
	 $loanPurpose = $_REQUEST['loanPurpose'];
	 $memberMobile = $_REQUEST['memberMobile'];
	 $memberEmail = $_REQUEST['memberEmail'];
	 $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // valid extensions
	$path ="uploads/"; // upload directory
	$img = $_FILES['memberPhoto']['name'];
	$tmp = $_FILES['memberPhoto']['tmp_name'];
	$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
	$final_image = rand(1000,1000000).$img;
	 $status = $_REQUEST['status'];
	 $sql = "select loanId,formId,memberId from loans where loanId='$loanId' and formId='$formNo'and memberId='$memberId'";
	 $res = mysql_query($sql);
		if(mysql_num_rows($res))
		{
		$msg="Duplicate Entry Note Allowed Please Check the Loan Id, Form Id , MemberId";
		}
		else
		{
			if(in_array($ext, $valid_extensions)) 
			{					
				$path = $path.strtolower($final_image);	
			}
			$sql=mysql_query("INSERT INTO loans(loanId,branchCode,formId,memberId,cDate,createDate,applicantName,gurdianName,dob, age, address, stateId, districtId, areaId, zipCode, sex, maritalStatus, gMemberNo, gName, gMobile, loanPlanId, planTypeId, loanAmount, rateOfInterest, emi, pMode, chequeNo, chequeDate, bankAC, bankName, loanPurpose, memberPhoto,memberMobile,memberEmail,status) VALUES ('$loanId','$branchId','$formNo','$memberId','$cDate','$joincDate','$applicantName','$gurdianName','$applicantDob','$applicantAge','$address','$state','$district','$area','$zipCode','$gender','$maritalStatus','$gMemberNo','$gMemberName','$gMemberMobile','$planId','$planType','$loanAmount','$rateOfInterest','$emi','$paymentMode','$chequeNo','$chequeDate','$bankAc','$bankName','$loanPurpose','$path','$memberMobile','$memberEmail','$status')");
				move_uploaded_file($tmp,$path); 
				$msg="Data Sucessfully Submited";
				$pageHrefLink="loans.php";
		}
}

?>
<script type="text/javascript">
 $(document).ready(function(){
		var date_input=$('.date'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			maxDate: 0
		})
	})
	function updateAb(value){    
var dob = new Date(value);
var today = new Date();
var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));	
alert(age);
}

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
                  		<h3 class="box-title">Loan Details information</h3>
                	</div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
                 <div class="box-body">
						<div class="form-group col-md-2">
                        <label for="pageTitle">Branch</label>
						<select class="form-control" name="branchId" id="branchId" required <?php if($_SESSION['branchCode']){echo "disabled";} ?>>
						<?php 
                    	$query="SELECT * FROM branchs where deleted='0' and status='0'";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option <?php if($_SESSION['branchCode'] ==$tableData['branchCode']){echo "selected";} ?> value="<?php echo $tableData['branchId']; ?>"><?php  echo $tableData['branchName']." - ".$tableData['branchCode'] ?></option>	<?php } ?>
						</select>
						</div>
						<div class="form-group col-md-2">
                        <label for="pageTitle">Loan Id</label>
                        <input type="text" class="form-control" id="loanId" name="loanId" placeholder="Loan Id" maxlength="15" required />                   
                        </div>
						<div class="form-group col-md-2">
                        <label for="pageTitle">Form No.</label>
                        <input type="text" class="form-control" id="formNo" name="formNo" placeholder="Form  No" maxlength="15" required />                   
                        </div>
						<div class="form-group col-md-3">
                        <label for="pageTitle">Member Id</label>
                        <input type="text" class="form-control" id="memberId" name="memberId" placeholder="Member Id" maxlength="15" required />                   
                        </div><div class="form-group col-md-3">
                        <label for="pageTitle" >Date</label>
                        <input type="text" class="form-control date" id="cDate" name="cDate" placeholder="Date" maxlength="15" required />                   
                        </div>
						<div class="form-group col-md-3">
                        <label for="pageTitle">Applicant Name</label>
                        <input type="text" class="form-control" id="applicantName" name="applicantName" placeholder="Applicant Name" maxlength="150" required />                   
                        </div>
						<div class="form-group col-md-3">
                        <label for="pageTitle">Gurdian Name</label>
                        <input type="text" class="form-control" id="gurdianName" name="gurdianName" placeholder="Gurdian Name" maxlength="150" required />                   
                        </div>
						<div class="form-group col-md-3">
                        <label for="pageTitle">Holders's DOB</label>
                        <input type="text" class="form-control date" id="applicantDob" name="applicantDob" placeholder="Holders's DOB" maxlength="150" required />                   
                        </div>
						<div class="form-group col-md-3">
                        <label for="pageTitle">Holders's Age</label>
                        <input type="text" class="form-control" id="applicantAge" name="applicantAge" placeholder="Holders's Age" maxlength="150" required />                   
                        </div>
						<div class="form-group col-md-3">
                      <label for="pageTitle">Address</label>
                      <textarea class="form-control" id="address" name="address" placeholder="Address " maxlength="100"></textarea>                  
						</div>
						<div class="form-group col-md-2">
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
					<div class="form-group col-md-2">
                      <label>District</label>
                      <select class="form-control" name="district" id="district" required> </select>
                    </div>
					<div class="form-group col-md-3">
                      <label for="pageTitle">Area</label>
                      <select class="form-control" name="area" id="area" required>
						</select>
                    </div>
					<div class="form-group col-md-2">
                      <label for="pageTitle"> Zip Code </label>
                      <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="Zip Code " maxlength="6"  required />                  
                    </div>
					<div class="form-group col-md-3">
                    <label for="pageTitle">Gender </label>
					<select class="form-control" name="gender" id="gender"> 
					<option value=""></option>
					<option value="male">Male</option>
					<option value="female">Female</option>
					</select>                    
					</div>
					<div class="form-group col-md-2">
                    <label for="pageTitle">Marital Status</label>
					<select class="form-control" name="maritalStatus" id="maritalStatus"> 
					<option value=""></option>
					<option value="married">Married</option>
					<option value="single">Single</option>
					<option value="single">Others</option>
					</select>	                   
					</div>
					<div class="form-group col-md-2">
                      <label for="pageTitle"> Guarantor Member No </label>
                      <input type="text" class="form-control" id="gMemberNo" name="gMemberNo" placeholder="Guarantor Member No" maxlength="15"  required />                  
                    </div>
					<div class="form-group col-md-3">
                      <label for="pageTitle"> Guarantor Name</label>
                      <input type="text" class="form-control" id="gMemberName" name="gMemberName" placeholder=" Guarantor Name " maxlength="100"  required />                  
                    </div>
					<div class="form-group col-md-2">
                      <label for="pageTitle">Guarantor Mobile No.</label>
                      <input type="text" class="form-control" id="gMemberMobile" name="gMemberMobile" placeholder="Guarantor Mobile No." maxlength="13"  required />                  
                    </div>
						 <div class="form-group col-md-3">
                        <label for="pageTitle">Loan plan </label>
					<select class="form-control" required name="planId" id="planId" required>
                     <?php 
                    	$query="SELECT * FROM loanplan where deleted='0' and status='0'";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option value="<?php echo $tableData['id']; ?>"><?php  echo $tableData['planName'] ?></option>	<?php } ?>
                      </select>                        </div>
                       <div class="form-group col-md-2">
                      <label>Plan Type</label>
                      <select class="form-control"  name="planType" id="planType" required>
                     <?php 
                    	$query="SELECT * FROM plantypes where deleted='0' and status='0' and planType='LOAN'";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option value="<?php echo $tableData['id']; ?>"><?php  echo $tableData['planName'] ?></option>	<?php } ?>
                      </select>
						</div>
                       <div class="form-group col-md-2">
                      <label for="pageTitle">Loan Amount  </label>
                      <input type="text" class="form-control" id="loanAmount" name="loanAmount" placeholder="Loan Amount " maxlength="10" required />                  
                    </div>
					<div class="form-group col-md-3">
                      <label for="pageTitle">Rate Of Interest(%)  </label>
                      <input type="text" class="form-control" id="rateOfInterest" name="rateOfInterest" placeholder="Rate Of Interest " maxlength="5"  required />                  
                    </div>
					<div class="form-group col-md-2">
                      <label for="pageTitle">EMI  </label>
                      <input type="text" class="form-control" id="emi" name="emi" placeholder="EMI " maxlength="5"  required />                  
                    </div>
					<div class="form-group col-md-2">
				  <label for="pageTitle">Payment Mode</label>
				  <select class="form-control" name="paymentMode" id="paymentMode"> 
					<option value="cash">Cash</option>
					<option value="cheque">Cheque</option>
					</select>
                    </div>
					<div class="form-group col-md-2">
                      <label for="pageTitle">Cheque No</label>
                      <input type="text" class="form-control" id="chequeNo" name="chequeNo" placeholder="Cheque No" maxlength="10"  />                  
                    </div>
					<div class="form-group col-md-2">
                      <label for="pageTitle">Cheque Date</label>
                      <input type="text" class="form-control date" id="chequeDate" name="chequeDate" placeholder="Cheque Date " />                  
                    </div>
					<div class="form-group col-md-2">
                      <label for="pageTitle">Bank A/C</label>
                      <input type="text" class="form-control" id="bankAc" name="bankAc" placeholder="Bank Account" />                  
                    </div>
					<div class="form-group col-md-2">
                      <label for="pageTitle">Bank Name</label>
                      <input type="text" class="form-control" id="bankName" name="bankName" placeholder="Bank Name" />                  
                    </div>
					<div class="form-group col-md-2">
                      <label for="pageTitle">Loan Purpose</label>
                      <input type="text" class="form-control" id="loanPurpose" name="loanPurpose" placeholder="Loan Purpose" />                  
                    </div>
					<div class="form-group col-md-3">
                      <label for="pageTitle">Member Mobile No</label>
                      <input type="text" class="form-control" id="memberMobile" name="memberMobile" placeholder="Member Mobile No" />                  
                    </div>
					<div class="form-group col-md-3">
                      <label for="pageTitle">Member Email</label>
                      <input type="text" class="form-control" id="memberEmail" name="memberEmail" placeholder="Member Email" />                  
                    </div>
					<div class="form-group col-md-3">
                      <label for="pageTitle">Member Photo</label>
                      <input type="File" class="form-control" id="memberPhoto" name="memberPhoto" placeholder="Member Photo" />                  
                    </div>
                        <div class="form-group col-md-3">
                        <label>Status</label>
                        <select class="form-control" name="status">
                        <option value="0">Enabled </option>
                        <option value="1" >Disabled</option>
                        </select>
                        </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary  pull-left" name="addStates">Submit</button>
                  </div>
				  
                </form>
              </div><!-- /.box -->
            </div><!--/.col (left) -->
          </div>   <!-- /.row -->
        </section>   
</div>
      <!-- /.content-wrapper -->
<?php include("common/adminFooter.php");?>