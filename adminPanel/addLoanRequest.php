<?php
include("controller/pages_controller.php");
$menuType ="loanRequest";
$msg='';
$pageHrefLink='';
function dateRange( $first, $step = '+1 day', $format = 'd/m/Y' ) 
{
	$dates = "";
	$current = strtotime( $first );
	$current = strtotime( $step, $current );
	$dates = date( $format, $current );
	return $dates;
}
if(isset($_REQUEST['addLoanRequest']))
{
	 $branchId = $_REQUEST['branchId'];
	 $planId = $_REQUEST['planId'];
	 $planType = $_REQUEST['planType'];
	 $loanAmount = $_REQUEST['loanAmount'];
	 $rateOfInterest = $_REQUEST['rateOfInterest'];
	 $emi = $_REQUEST['emi'];
	 $loanPurpose = $_REQUEST['loanPurpose'];
	 $memberId = $_REQUEST['memberId'];
	 $cDate = $_REQUEST['cDate'];
	 $createdate = explode('/', $cDate);
	 $month = $createdate[1];
	 $day   = $createdate[0];
	 $year  = $createdate[2];
	 $joincDate = $year.'-'.$month.'-'.$day;
	 $aDate = $_REQUEST['aDate'];
	 $aDate = explode('/', $aDate);
	 $aDatemonth = $aDate[1];
	 $aDateday   = $aDate[0];
	 $aDateyear  = $aDate[2];
	 $joinADate = $aDateyear.'-'.$aDatemonth.'-'.$aDateday;
	 $applicantName = $_REQUEST['applicantName'];
	 $gurdianName = $_REQUEST['gurdianName'];
	 $applicantDob = $_REQUEST['applicantDob'];
	 $applicantDob = explode('/', $applicantDob);
	 $applicantDobmonth = $applicantDob[1];
	 $applicantDobday   = $applicantDob[0];
	 $applicantDobyear  = $applicantDob[2];
	 $applicantDob = $applicantDobyear.'-'.$applicantDobmonth.'-'.$applicantDobday;
	 $address = $_REQUEST['address'];
	 $memberMobile = $_REQUEST['memberMobile'];
	 $gender = $_REQUEST['gender'];
	 $maritalStatus = $_REQUEST['maritalStatus'];
	 $gMemberNo = $_REQUEST['gMemberNo'];
	 $gMemberName = $_REQUEST['gMemberName'];
	 $gMemberMobile = $_REQUEST['gMemberMobile'];
	 $paymentMode = $_REQUEST['paymentMode'];
	 $chequeNo = $_REQUEST['chequeNo'];
	 $chequeDate = $_REQUEST['chequeDate'];
	 $bankAc = $_REQUEST['bankAc'];
	 $bankName = $_REQUEST['bankName'];
	 $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // valid extensions
	 $valid_extensions_id = array('doc', 'docx', 'pdf','jpeg', 'jpg', 'png', 'gif', 'bmp'); // valid extensions
	$imagepath ="uploads/loanrequest/images/"; // upload directory
	$identitypath ="uploads/loanrequest/idendity/"; // upload directory
	$img = $_FILES['memberPhoto']['name'];
	$tmp = $_FILES['memberPhoto']['tmp_name'];
	$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
	$final_image = rand(1000,1000000).$img;
	$idimg = $_FILES['memberIdentiy']['name'];
	$idtmp = $_FILES['memberIdentiy']['tmp_name'];
	$idext = strtolower(pathinfo($idimg, PATHINFO_EXTENSION));
	$final_image_id = rand(1000,1000000).$idimg;
	 $sql = "select memberId from loanrequests where memberId='$memberId' and requestStatus='Pending'";
	 $res = mysql_query($sql);
		if(mysql_num_rows($res))
		{
			$msg="Duplicate Entry Note Allowed Please Check  MemberId";
		}
		else
		{
			if(in_array($ext, $valid_extensions)) 
			{					
				$imagepath = $imagepath.strtolower($final_image);	
			}
			if(in_array($idext, $valid_extensions_id)) 
			{					
				$identitypath = $identitypath.strtolower($final_image_id);	
			}
			$sql=mysql_query("INSERT INTO loanrequests(branchCode,memberId,createDate,approvalDate,applicantName,gurdianName,dob,address,sex,maritalStatus,gMemberNo,gName,gMobile,loanPlanId, planTypeId, loanAmount, rateOfInterest, emi, pMode, chequeNo, chequeDate, bankAC, bankName, loanPurpose, memberPhoto, memberDocument,memberMobile) VALUES ('$branchId','$memberId','$joincDate','$joinADate','$applicantName','$gurdianName','$applicantDob','$address','$gender','$maritalStatus','$gMemberNo','$gMemberName','$gMemberMobile','$planId','$planType','$loanAmount','$rateOfInterest','$emi','$paymentMode','$chequeNo','$chequeDate','$bankAc','$bankName','$loanPurpose','$imagepath','$identitypath','$memberMobile')");
				move_uploaded_file($tmp,$imagepath); 
				move_uploaded_file($idtmp,$identitypath); 
				$msg="Data Sucessfully Submited";
				$pageHrefLink="loanRequest.php";
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
                  		<h3 class="box-title">Loan Request Details </h3>
                	</div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
                 <div class="box-body">
						<div class="form-group col-md-2">
							<label for="pageTitle">Branch <span class="requiredField">*</span> </label>
							<select class="form-control" name="branchId" id="branchId" required <?php if($_SESSION['branchCode']){ ?> style='pointer-events: none;' <?php } ?> >
							<?php 
							$query="SELECT * FROM branchs where deleted='0' and status='0' and branchCode!='0'";
							$menuData=fetchData($query);
							foreach($menuData as $tableData)
							{ ?><option <?php if($_SESSION['branchCode'] ==$tableData['branchCode']){echo "selected";} ?> value="<?php echo $tableData['branchId']; ?>"><?php  echo $tableData['branchName']." - ".$tableData['branchCode'] ?></option>	<?php } ?>
							</select>
						</div>
						<div class="form-group col-md-3">
							<label for="pageTitle">Loan plan <span class="requiredField">*</span>  </label>
							<select class="form-control" required name="planId" id="planId" required>
							<?php 
							$query="SELECT * FROM loanplan where deleted='0' and status='0'";
							$menuData=fetchData($query);
							foreach($menuData as $tableData)
							{ ?><option value="<?php echo $tableData['id']; ?>"><?php  echo $tableData['planName'] ?></option>	<?php } ?>
							</select>
						</div>
                       <div class="form-group col-md-2">
						<label>Plan Type <span class="requiredField">*</span> </label>
						<select class="form-control"  name="planType" id="planType"  required>
						<?php 
                    	$query="SELECT * FROM plantypes where deleted='0' and status='0' and planType='LOAN'";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option value="<?php echo $tableData['id']; ?>"><?php  echo $tableData['planName'] ?></option>	<?php } ?>
                      </select>
						</div>
						 <div class="form-group col-md-2">
                      <label for="pageTitle">Loan Amount <span class="requiredField">*</span>  </label>
                      <input type="text" class="form-control" id="loanAmount" name="loanAmount" placeholder="Loan Amount " maxlength="10" required />                  
                    </div>
					<div class="form-group col-md-3">
                      <label for="pageTitle">Rate Of Interest(%) <span class="requiredField">*</span>  </label>
                      <input type="text" class="form-control" id="rateOfInterest" name="rateOfInterest" placeholder="Rate Of Interest " maxlength="5"  required />                  
                    </div>
					<div class="form-group col-md-2">
                      <label for="pageTitle">EMI  <span class="requiredField">*</span> </label>
                      <input type="text" class="form-control" id="emi" name="emi" placeholder="EMI " maxlength="5"  required />                  
                    </div>
					<div class="form-group col-md-3">
                      <label for="pageTitle">Loan Purpose</label>
                      <input type="text" class="form-control" id="loanPurpose" name="loanPurpose" placeholder="Loan Purpose" />                  
                    </div>
					 
						<div class="form-group col-md-2">
                        <label for="pageTitle">Member Id <span class="requiredField">*</span> </label>
                        <input type="text" class="form-control" id="memberId" name="memberId" placeholder="Member Id" maxlength="15" required />                   
                        </div>
						<div class="form-group col-md-2">
                        <label for="pageTitle" >Loan Create Date <span class="requiredField">*</span> </label>
                        <input type="text" class="form-control date" id="cDate" name="cDate" placeholder="Date" maxlength="15" required />                   
                        </div>
						<div class="form-group col-md-2">
                        <label for="pageTitle" >Loan Approval Date <span class="requiredField">*</span> </label>
                        <input type="text" class="form-control date" id="aDate" name="aDate" placeholder="Approval Date" maxlength="15" required />                   
                        </div>
						<div class="form-group col-md-3">
                        <label for="pageTitle">Applicant Name <span class="requiredField">*</span> </label>
                        <input type="text" class="form-control" id="applicantName" name="applicantName" placeholder="Applicant Name" maxlength="150" required />                   
                        </div>
						<div class="form-group col-md-3">
                        <label for="pageTitle">Gurdian Name <span class="requiredField">*</span> </label>
                        <input type="text" class="form-control" id="gurdianName" name="gurdianName" placeholder="Gurdian Name" maxlength="150" required />                   
                        </div>
						<div class="form-group col-md-3">
                        <label for="pageTitle">Holders's DOB <span class="requiredField">*</span> </label>
                        <input type="text" class="form-control date" id="applicantDob" name="applicantDob" placeholder="Holders's DOB" maxlength="150" required />                   
                        </div>
						<div class="form-group col-md-3">
						<label for="pageTitle">Address <span class="requiredField">*</span> </label>
						<textarea class="form-control" id="address" name="address" placeholder="Address " maxlength="100" required></textarea>                  
						</div>
						<div class="form-group col-md-2">
						<label for="pageTitle">Member Mobile No <span class="requiredField">*</span> </label>
						<input type="text" class="form-control" id="memberMobile" name="memberMobile" placeholder="Member Mobile No" required />                  
						</div>
						<div class="form-group col-md-3">
						<label for="pageTitle">Member Photo</label>
						<input type="File" class="form-control" id="memberPhoto" name="memberPhoto" placeholder="Member Photo" />                  
						</div>
						<div class="form-group col-md-3">
						<label for="pageTitle">Member Identity</label>
						<input type="File" class="form-control" id="memberIdentiy" name="memberIdentiy" placeholder="Member Identity" />                  
						</div>
						<div class="form-group col-md-2">
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
					<div class="form-group col-md-3">
                      <label for="pageTitle">Bank A/C</label>
                      <input type="text" class="form-control" id="bankAc" name="bankAc" placeholder="Bank Account" />                  
                    </div>
					<div class="form-group col-md-3">
                      <label for="pageTitle">Bank Name</label>
                      <input type="text" class="form-control" id="bankName" name="bankName" placeholder="Bank Name" />                  
                    </div>
						<div class="form-group col-md-2">
						  <label for="pageTitle"> Guarantor Member No <span class="requiredField">*</span> </label>
						  <input type="text" class="form-control" id="gMemberNo" name="gMemberNo" placeholder="Guarantor Member No" maxlength="15"  required />                  
						</div>
						<div class="form-group col-md-3">
						  <label for="pageTitle"> Guarantor Name <span class="requiredField">*</span> </label>
						  <input type="text" class="form-control" id="gMemberName" name="gMemberName" placeholder=" Guarantor Name " maxlength="100"  required />                  
						</div>
						<div class="form-group col-md-2">
						  <label for="pageTitle">Guarantor Mobile No. <span class="requiredField">*</span> </label>
						  <input type="text" class="form-control" id="gMemberMobile" name="gMemberMobile" placeholder="Guarantor Mobile No." maxlength="13"  required />              
						</div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary  pull-left" name="addLoanRequest">Submit</button>
                  </div>
				  
                </form>
              </div><!-- /.box -->
            </div><!--/.col (left) -->
          </div>   <!-- /.row -->
        </section>   
		
</div>
      <!-- /.content-wrapper -->
<?php include("common/adminFooter.php");?>