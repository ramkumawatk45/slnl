<?php
include("controller/pages_controller.php");
$menuType ="activeLoans";
$id=$_REQUEST['id'];
$msg='';
$pageHrefLink='';
function dateRange( $first, $step = '+1 day', $format = 'Y-m-d' ) 
{
	$dates = "";
	$current = strtotime( $first );
	$current = strtotime( $step, $current );
	$dates = date( $format, $current );
	return $dates;
}
if(isset($_REQUEST['addStates']))
{
	 $branchId = trim($_REQUEST['branchId']);
	 $loanId = trim($_REQUEST['loanId']);
	 $formNo = trim($_REQUEST['formNo']);
	 $memberId = trim($_REQUEST['memberId']);
	 $cDate = trim($_REQUEST['cDate']);
	 $createdate = explode('/', $cDate);
	 $month = $createdate[1];
	 $day   = $createdate[0];
	 $year  = $createdate[2];
	 $joincDate = $year.'-'.$month.'-'.$day;
	 $applicantName = trim($_REQUEST['applicantName']);
	 $gurdianName = trim($_REQUEST['gurdianName']);
	 $applicantDob = trim($_REQUEST['applicantDob']);
	 $applicantAge = trim($_REQUEST['applicantAge']);
	 $address = trim($_REQUEST['address']);
	 $state = $_REQUEST['state'];
	 $district = $_REQUEST['district'];
	 $area = $_REQUEST['area'];
	 $zipCode = trim($_REQUEST['zipCode']);
	 $gender = $_REQUEST['gender'];
	 $maritalStatus = $_REQUEST['maritalStatus'];
	 $gMemberNo = trim($_REQUEST['gMemberNo']);
	 $gMemberName = trim($_REQUEST['gMemberName']);
	 $gMemberMobile = trim($_REQUEST['gMemberMobile']);
	 $planId = $_REQUEST['planId'];
	 $planType = $_REQUEST['planType'];
	 $loanAmount = trim($_REQUEST['loanAmount']);
	 $rateOfInterest = trim($_REQUEST['rateOfInterest']);
	 $emi = trim($_REQUEST['emi']);
	 $paymentMode = trim($_REQUEST['paymentMode']);
	 $chequeNo = trim($_REQUEST['chequeNo']);
	 $chequeDate = trim($_REQUEST['chequeDate']);
	 $bankAc = trim($_REQUEST['bankAc']);
	 $bankName = trim($_REQUEST['bankName']);
	 $loanPurpose = trim($_REQUEST['loanPurpose']);
	 $memberMobile = trim($_REQUEST['memberMobile']);
	 $memberEmail = trim($_REQUEST['memberEmail']);
	 $status = $_REQUEST['status'];
	 $planTypes ="";
	$planQuery="SELECT * FROM plantypes where id='$planType' and deleted='0' ";
	$menuDatas=fetchData($planQuery);
	if(is_array($menuDatas) || is_object($menuDatas))
	{	
		foreach($menuDatas as $branchData)
		{  
			$planTypes  = $branchData['planName']; 
		}
	}
	$dueDate = "";
	$newDueDate = "";
	if($planTypes == "MONTHLY")
	{
		$dueDate = dateRange($joincDate, '+1 month','d/m/Y');
		$newDueDate = dateRange($joincDate, '+1 month','Y-m-d');
	}
	else if($planTypes =="DAILY")
	{
		$dueDate = dateRange($joincDate,'+1 day','d/m/Y');
		$newDueDate = dateRange($joincDate, '+1 day','Y-m-d');
	}
	 $sql = "select loanId,formId,memberId from loans where loanId='$loanId' and formId='$formNo'and memberId='$memberId'";
	 $res = mysql_query($sql);
		if(mysql_num_rows($res)> 1)
		{
		$msg="Duplicate Entry Note Allowed Please Check the Loan Id, Form Id , MemberId";
		}
		else
		{
				$sql=mysql_query("UPDATE loans SET loanId='$loanId',branchCode='$branchId',formId='$formNo',memberId='$memberId',cDate='$cDate',createDate='$joincDate',applicantName='$applicantName',gurdianName='$gurdianName',dob='$applicantDob', age='$applicantAge', address='$address', stateId='$state', districtId='$district', areaId='$area', zipCode='$zipCode', sex='$gender', maritalStatus='$maritalStatus', gMemberNo='$gMemberNo', gName='$gMemberName', gMobile='$gMemberMobile', loanPlanId='$planId', planTypeId='$planType', loanAmount='$loanAmount', rateOfInterest='$rateOfInterest', emi='$emi', pMode='$paymentMode', chequeNo='$chequeNo', chequeDate='$chequeDate', bankAC='$bankAc', bankName='$bankName', loanPurpose='$loanPurpose',memberMobile='$memberMobile',memberEmail='$memberEmail',status='$status' where id='$id' ");
				$sql=mysql_query("UPDATE loanemi SET branchCode='$branchId',emiAmount='$emi', dueDate='$dueDate',newDueDate='$newDueDate',ndd='$newDueDate' where loanId='$loanId' and emiNo='0'");
				//$msg=updated;
				//$pageHrefLink="loans.php";
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
	if(($("#branchAccess").val() =="VIEW") || ($("#userAccess").val() =="VIEW"))
	{
		$("#editLoan").addClass("readWriteAccess");
	}	
	})
	function updateAb(value){    
var dob = new Date(value);
var today = new Date();
var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));	
alert(age);
}

$(document).ready(function(){
	var stateID = $('#stateId').val();
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
	<section class="content" id="editLoan">
    	<div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
            	<div class="box box-primary">
                	<div class="box-header with-border">
                  		<h3 class="box-title">Loan Details information</h3>
                	</div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"   method="post">
                <input type="hidden" id="id" value="<?php echo $id; ?>">    
				<?php $query="SELECT * FROM loans where id='$id'";
					$pagesData=fetchData($query);
					foreach($pagesData as $loanData)
					{
					?>
					<input type="hidden" id="stateId" value="<?php echo $loanData['stateId']; ?>">
					<input type="hidden" id="districtId" value="<?php echo $loanData['districtId']; ?>">
					<input type="hidden" id="areaCode" value="<?php echo $loanData['areaId']; ?>">
                 <div class="box-body">
					<div class="col-md-6 ">
						<div class="form-group col-md-4">
                        <label for="pageTitle">Branch <span class="requiredField">*</span></label>
						<select class="form-control" name="branchId" id="branchId" required <?php if($_SESSION['branchCode']){echo "disabled";} ?>>
						<?php 
                    	$query="SELECT * FROM branchs where deleted='0' and status='0' and branchCode!='0' ";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option <?php if($_SESSION['branchCode'] ==$tableData['branchCode']){echo "selected";} ?> value="<?php echo $tableData['branchId']; ?>"><?php  echo $tableData['branchName']." - ".$tableData['branchCode'] ?></option>	<?php } ?>
						</select>
						</div>
						<div class="form-group col-md-4">
                        <label for="pageTitle">Loan Id <span class="requiredField">*</span></label>
                        <input type="text" class="form-control" id="loanId" name="loanId" value="<?php echo $loanData['loanId']; ?>"  maxlength="15" required />                   
                        </div>
						<div class="form-group col-md-4">
                        <label for="pageTitle">Form No. <span class="requiredField">*</span></label>
                        <input type="text" class="form-control" id="formNo" name="formNo" value="<?php echo $loanData['formId']; ?>" maxlength="15" required />                   
                        </div>
						<div class="form-group col-md-4">
                        <label for="pageTitle">Member Id <span class="requiredField">*</span></label>
                        <input type="text" class="form-control" id="memberId" name="memberId" value="<?php echo $loanData['memberId']; ?>" maxlength="15" required />                   
                        </div><div class="form-group col-md-4">
                        <label for="pageTitle" >Date <span class="requiredField">*</span></label>
                        <input type="text" class="form-control date" id="cDate" name="cDate" value="<?php echo $loanData['cDate']; ?>" maxlength="15" required />                   
                        </div>
						<div class="form-group col-md-4">
                        <label for="pageTitle">Loan plan <span class="requiredField">*</span></label>
						<select class="form-control" name="planId" id="planId" required>
						 <?php 
							$query="SELECT * FROM loanplan where deleted='0' and status='0'";
							$menuData=fetchData($query);
							foreach($menuData as $tableData)
							{ ?><option <?php if($tableData['id'] ==$loanData['loanPlanId']) { echo 'selected';} ?> value="<?php echo $tableData['id']; ?>"><?php  echo $tableData['planName'] ?></option>	<?php } ?>
						</select>
						</div>
                    <div class="form-group col-md-4">
                      <label>Plan Type <span class="requiredField">*</span></label>
                      <select class="form-control" name="planType" id="planType" required>
                     <?php 
                    	$query="SELECT * FROM plantypes where deleted='0' and status='0' and planType='LOAN'";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option <?php if($tableData['id'] ==$loanData['planTypeId']) { echo 'selected';} ?> value="<?php echo $tableData['id']; ?>"><?php  echo $tableData['planName'] ?></option>	<?php } ?>
                      </select>
					</div>
                    <div class="form-group col-md-4">
                      <label for="pageTitle">Loan Amount  <span class="requiredField">*</span></label>
                      <input type="text" class="form-control" id="loanAmount" name="loanAmount" value="<?php echo $loanData['loanAmount']; ?>" maxlength="10" required />                  
                    </div>
					<div class="form-group col-md-4">
                      <label for="pageTitle">Rate Of Interest(%)  <span class="requiredField">*</span></label>
                      <input type="text" class="form-control" id="rateOfInterest" name="rateOfInterest" value="<?php echo $loanData['rateOfInterest']; ?>" maxlength="5"  required />                  
                    </div>
					<div class="form-group col-md-4">
                      <label for="pageTitle">EMI  <span class="requiredField">*</span></label>
                      <input type="text" class="form-control" id="emi" name="emi" value="<?php echo $loanData['emi']; ?>" maxlength="5"  required />                  
                    </div>
					<div class="form-group col-md-4">
				  <label for="pageTitle">Payment Mode</label>
				  <select class="form-control" name="paymentMode" id="paymentMode"> 
					<option value="cash" <?php if($loanData['pMode'] =="cash") { echo 'selected';} ?>>Cash</option>
					<option value="cheque" <?php if($loanData['pMode'] =="cheque") { echo 'selected';} ?>>Cheque</option>
					</select>
                    </div>
					<div class="form-group col-md-4">
                      <label for="pageTitle">Cheque No</label>
                      <input type="text" class="form-control" id="chequeNo" name="chequeNo" value="<?php echo $loanData['chequeNo']; ?>" maxlength="10"  />                  
                    </div>
					<div class="form-group col-md-4">
                      <label for="pageTitle">Cheque Date</label>
                      <input type="text" class="form-control date" id="chequeDate" name="chequeDate" value="<?php echo $loanData['chequeDate']; ?>" />                  
                    </div>
					<div class="form-group col-md-4">
                      <label for="pageTitle">Bank A/C</label>
                      <input type="text" class="form-control" id="bankAc" name="bankAc" value="<?php echo $loanData['bankAC']; ?>" />                  
                    </div>
					<div class="form-group col-md-4">
                      <label for="pageTitle">Bank Name</label>
                      <input type="text" class="form-control" id="bankName" name="bankName" value="<?php echo $loanData['bankName']; ?>" />                  
                    </div>
					<div class="form-group col-md-4">
                      <label for="pageTitle">Loan Purpose</label>
                      <input type="text" class="form-control" id="loanPurpose" name="loanPurpose" value="<?php echo $loanData['loanPurpose']; ?>" />                  
                    </div>
				</div>
				<div class="col-md-6 ">	
						<div class="form-group col-md-4">
                        <label for="pageTitle">Applicant Name <span class="requiredField">*</span></label>
                        <input type="text" class="form-control" id="applicantName" name="applicantName" value="<?php echo $loanData['applicantName']; ?>" maxlength="150" required /> </div>
						
						<div class="form-group col-md-4">
                        <label for="pageTitle">Gurdian Name <span class="requiredField">*</span></label>
                        <input type="text" class="form-control" id="gurdianName" name="gurdianName" value="<?php echo $loanData['gurdianName']; ?>" maxlength="150" required />     </div>
						
						<div class="form-group col-md-4">
                        <label for="pageTitle">Holders's DOB <span class="requiredField">*</span></label>
                        <input type="text" class="form-control date" id="applicantDob" name="applicantDob" value="<?php echo $loanData['dob']; ?>" maxlength="150" required />       </div>
						
						<div class="form-group col-md-4">
                        <label for="pageTitle">Holders's Age <span class="requiredField">*</span></label>
                        <input type="text" class="form-control" id="applicantAge" name="applicantAge" value="<?php echo $loanData['age']; ?>" maxlength="150" required />          </div>
						<div class="form-group col-md-4">
						<label for="pageTitle">Address <span class="requiredField">*</span></label>
						<textarea class="form-control" id="address" name="address" placeholder="Address " maxlength="100" required><?php echo $loanData['address']; ?></textarea>   </div>
						<div class="form-group col-md-4">
						<label>State <span class="requiredField">*</span></label>
						<select class="form-control" name="state" id="state" required>
						  <option value="0" >Select State</option>
						 <?php 
						$query="SELECT * FROM states where deleted='0' and status='0'";
						$stateData=fetchData($query);
						foreach($stateData as $tableData)
						{ ?><option <?php if($tableData['stateId'] == $loanData['stateId']) { echo 'selected';} ?> value="<?php echo $tableData['stateId']; ?>"><?php  echo $tableData['stateName'] ?></option> <?php } ?>
						  </select>
						</div>
						<div class="form-group col-md-4">
						  <label>District <span class="requiredField">*</span></label>
						  <select class="form-control" name="district" id="district" required> </select>
						</div>
						<div class="form-group col-md-4">
						  <label for="pageTitle">Area <span class="requiredField">*</span></label>
						  <select class="form-control" name="area" id="area" required>
							</select>
						</div>
						<div class="form-group col-md-4">
						  <label for="pageTitle"> Zip Code <span class="requiredField">*</span></label>
						  <input type="text" class="form-control" id="zipCode" name="zipCode" value="<?php echo $loanData['zipCode']; ?>" maxlength="6"  required />                  
						</div>
						<div class="form-group col-md-4">
						<label for="pageTitle">Gender <span class="requiredField">*</span></label>
						<select class="form-control" name="gender" id="gender" required> 
						<option value=""></option>
						<option value="male"<?php if($loanData['sex'] =='male') { echo 'selected';} ?>>Male</option>
						<option value="female" <?php if($loanData['sex'] =='female') { echo 'selected'; } ?>>Female</option>
						</select>                    
						</div>
						<div class="form-group col-md-4">
						<label for="pageTitle">Marital Status <span class="requiredField">*</span></label>
						<select class="form-control" name="maritalStatus" id="maritalStatus" required> 
						<option value=""></option>
						<option value="married" <?php if($loanData['maritalStatus'] =='married') { echo 'selected';} ?>>Married</option>
						<option value="single" <?php if($loanData['maritalStatus'] =='single') { echo 'selected';} ?>>Single</option>
						<option value="others" <?php if($loanData['maritalStatus'] =='others') { echo 'selected';} ?>>Others</option>
						</select>	                   
						</div>
						 <div class="form-group col-md-4">
                        <label>Status</label>
                        <select class="form-control" name="status">
                        <option value="0" <?php if($loanData['status'] =="0") { echo 'selected';} ?>>Active </option>
                        <option value="1" <?php if($loanData['status'] =="1") { echo 'selected';} ?> >Inactive</option>
                        </select>
                        </div>
						<div class="form-group col-md-4">
						<label for="pageTitle">Member Mobile No <span class="requiredField">*</span></label>
						<input type="text" class="form-control" id="memberMobile" name="memberMobile" value="<?php echo $loanData['memberMobile']; ?>" required />                  
						</div>
						<div class="form-group col-md-4">
						<label for="pageTitle">Member Email</label>
						<input type="text" class="form-control" id="memberEmail" name="memberEmail" value="<?php echo $loanData['memberEmail']; ?>" />                  
						</div>
						<div class="form-group col-md-4">
						<label for="pageTitle">Member Photo</label>
						<input type="File" class="form-control" id="memberPhoto" name="memberPhoto" value="<?php echo $loanData['loanId']; ?>" />                  
						</div>
						<div class="form-group col-md-4">
						<label for="pageTitle"> Guarantor Member No <span class="requiredField">*</span></label>
						<input type="text" class="form-control" id="gMemberNo" name="gMemberNo" value="<?php echo $loanData['gMemberNo']; ?>" maxlength="15"  required />           </div>
						<div class="form-group col-md-4">
						<label for="pageTitle"> Guarantor Name <span class="requiredField">*</span></label>
						<input type="text" class="form-control" id="gMemberName" name="gMemberName" value="<?php echo $loanData['gName']; ?>" maxlength="100"  required />          </div>
						<div class="form-group col-md-4">
						<label for="pageTitle">Guarantor Mobile No. <span class="requiredField">*</span></label>
						<input type="text" class="form-control" id="gMemberMobile" name="gMemberMobile" value="<?php echo $loanData['gMobile']; ?>" maxlength="13"  required />   
						</div>   
					</div>	
                  </div><!-- /.box-body -->
				  <?php
					}
					if($_SESSION['userType']=="ADMIN")
					{
					?>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary  pull-left" name="addStates">Submit</button>
                  </div>
				  <?php 
						}
					?>
                </form>
              </div><!-- /.box -->
            </div><!--/.col (left) -->
          </div>   <!-- /.row -->
        </section>   
</div>
      <!-- /.content-wrapper -->
<?php include("common/adminFooter.php");?>