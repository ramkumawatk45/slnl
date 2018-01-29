<?php
include("controller/pages_controller.php");
$menuType ="loanRequest";
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
                  		<h3 class="box-title">Loan Request Details</h3>
                	</div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"   method="post">
                <input type="hidden" id="id" value="<?php echo $id; ?>">    
				<?php $query="SELECT * FROM loanrequests where id='$id' and deleted='0'";
					$pagesData=fetchData($query);
					foreach($pagesData as $loanData)
					{
					?>
                 <div class="box-body">
						<div class="form-group col-md-2">
                        <label for="pageTitle">Branch</label>
						<select class="form-control" name="branchId" id="branchId" required <?php if($_SESSION['branchCode']){echo "disabled";} ?>>
						<?php 
                    	$query="SELECT * FROM branchs where deleted='0' and status='0' and branchCode!='0' ";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option <?php if($_SESSION['branchCode'] ==$tableData['branchCode']){echo "selected";} ?> value="<?php echo $tableData['branchId']; ?>"><?php  echo $tableData['branchName']." - ".$tableData['branchCode'] ?></option>	<?php } ?>
						</select>
						</div>
						<div class="form-group col-md-3">
                        <label for="pageTitle">Loan plan </label>
					<select class="form-control" name="planId" id="planId" required>
                     <?php 
                    	$query="SELECT * FROM loanplan where deleted='0' and status='0'";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option <?php if($tableData['id'] ==$loanData['loanPlanId']) { echo 'selected';} ?> value="<?php echo $tableData['id']; ?>"><?php  echo $tableData['planName'] ?></option>	<?php } ?>
                      </select>                        </div>
                       <div class="form-group col-md-2">
                      <label>Plan Type</label>
                      <select class="form-control" name="planType" id="planType" required>
                     <?php 
                    	$query="SELECT * FROM plantypes where deleted='0' and status='0' and planType='LOAN'";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option <?php if($tableData['id'] ==$loanData['planTypeId']) { echo 'selected';} ?> value="<?php echo $tableData['id']; ?>"><?php  echo $tableData['planName'] ?></option>	<?php } ?>
                      </select>
						</div>
                       <div class="form-group col-md-2">
                      <label for="pageTitle">Loan Amount  </label>
                      <input type="text" class="form-control" id="loanAmount" name="loanAmount" value="<?php echo $loanData['loanAmount']; ?>" maxlength="10" required />                  
                    </div>
					<div class="form-group col-md-3">
                      <label for="pageTitle">Rate Of Interest(%)  </label>
                      <input type="text" class="form-control" id="rateOfInterest" name="rateOfInterest" value="<?php echo $loanData['rateOfInterest']; ?>" maxlength="5"  required />                  
                    </div>
					<div class="form-group col-md-2">
                      <label for="pageTitle">EMI  </label>
                      <input type="text" class="form-control" id="emi" name="emi" value="<?php echo $loanData['emi']; ?>" maxlength="5"  required />                  
                    </div>
					<div class="form-group col-md-3">
                      <label for="pageTitle">Loan Purpose</label>
                      <input type="text" class="form-control" id="loanPurpose" name="loanPurpose" value="<?php echo $loanData['loanPurpose']; ?>" />                  
                    </div>
						<div class="form-group col-md-2">
                        <label for="pageTitle">Member Id</label>
                        <input type="text" class="form-control" id="memberId" name="memberId" value="<?php echo $loanData['memberId']; ?>" maxlength="15" required />                   
                        </div>
						<div class="form-group col-md-2">
                        <label for="pageTitle" >Loan Create Date</label>
                        <input type="text" class="form-control date" id="cDate" name="cDate" value="<?php echo custumDateFormat($loanData['createDate']); ?>" maxlength="15" required />                   
                        </div>
						<div class="form-group col-md-2">
                        <label for="pageTitle" >Loan Approval Date</label>
                        <input type="text" class="form-control date" id="cDate" name="cDate" value="<?php echo custumDateFormat($loanData['approvalDate']); ?>" maxlength="15" required />                   
                        </div>
						<div class="form-group col-md-3">
                        <label for="pageTitle">Applicant Name</label>
                        <input type="text" class="form-control" id="applicantName" name="applicantName" value="<?php echo $loanData['applicantName']; ?>" maxlength="150" required />                   
                        </div>
						<div class="form-group col-md-3">
                        <label for="pageTitle">Gurdian Name</label>
                        <input type="text" class="form-control" id="gurdianName" name="gurdianName" value="<?php echo $loanData['gurdianName']; ?>" maxlength="150" required />                   
                        </div>
						<div class="form-group col-md-3">
                        <label for="pageTitle">Holders's DOB</label>
                        <input type="text" class="form-control date" id="applicantDob" name="applicantDob" value="<?php echo custumDateFormat($loanData['dob']); ?>" maxlength="150" required />                   
                        </div>
						
						<div class="form-group col-md-3">
						<label for="pageTitle">Address</label>
						<textarea class="form-control" id="address" name="address" placeholder="Address " maxlength="100"><?php echo $loanData['address']; ?></textarea>          </div>
						<div class="form-group col-md-2">
						<label for="pageTitle">Member Mobile No</label>
						<input type="text" class="form-control" id="memberMobile" name="memberMobile" value="<?php echo $loanData['memberMobile']; ?>" />                  
						</div>
				
					<div class="form-group col-md-2">
                    <label for="pageTitle">Gender </label>
					<select class="form-control" name="gender" id="gender"> 
					<option value=""></option>
					<option value="male"<?php if($loanData['sex'] =='male') { echo 'selected';} ?>>Male</option>
					<option value="female" <?php if($loanData['sex'] =='female') { echo 'selected'; } ?>>Female</option>
					</select>                    
					</div>
					<div class="form-group col-md-2">
                    <label for="pageTitle">Marital Status</label>
					<select class="form-control" name="maritalStatus" id="maritalStatus"> 
					<option value=""></option>
					<option value="married" <?php if($loanData['maritalStatus'] =='married') { echo 'selected';} ?>>Married</option>
					<option value="single" <?php if($loanData['maritalStatus'] =='single') { echo 'selected';} ?>>Single</option>
					<option value="others" <?php if($loanData['maritalStatus'] =='others') { echo 'selected';} ?>>Others</option>
					</select>	                   
					</div>
					
						 
					<div class="form-group col-md-2">
				  <label for="pageTitle">Payment Mode</label>
				  <select class="form-control" name="paymentMode" id="paymentMode"> 
					<option value="cash" <?php if($loanData['pMode'] =="cash") { echo 'selected';} ?>>Cash</option>
					<option value="cheque" <?php if($loanData['pMode'] =="cheque") { echo 'selected';} ?>>Cheque</option>
					</select>
                    </div>
					<div class="form-group col-md-2">
                      <label for="pageTitle">Cheque No</label>
                      <input type="text" class="form-control" id="chequeNo" name="chequeNo" value="<?php echo $loanData['chequeNo']; ?>" maxlength="10"  />                  
                    </div>
					<div class="form-group col-md-2">
                      <label for="pageTitle">Cheque Date</label>
                      <input type="text" class="form-control date" id="chequeDate" name="chequeDate" value="<?php echo $loanData['chequeDate']; ?>" />                  
                    </div>
					<div class="form-group col-md-2">
                      <label for="pageTitle">Bank A/C</label>
                      <input type="text" class="form-control" id="bankAc" name="bankAc" value="<?php echo $loanData['bankAC']; ?>" />                  
                    </div>
					<div class="form-group col-md-2">
                      <label for="pageTitle">Bank Name</label>
                      <input type="text" class="form-control" id="bankName" name="bankName" value="<?php echo $loanData['bankName']; ?>" />                  
                    </div>
					
					<div class="form-group col-md-2">
                      <label for="pageTitle"> Guarantor Member No </label>
                      <input type="text" class="form-control" id="gMemberNo" name="gMemberNo" value="<?php echo $loanData['gMemberNo']; ?>" maxlength="15"  required />                  
                    </div>
					<div class="form-group col-md-3">
                      <label for="pageTitle"> Guarantor Name</label>
                      <input type="text" class="form-control" id="gMemberName" name="gMemberName" value="<?php echo $loanData['gName']; ?>" maxlength="100"  required />                  
                    </div>
					<div class="form-group col-md-2">
                      <label for="pageTitle">Guarantor Mobile No.</label>
                      <input type="text" class="form-control" id="gMemberMobile" name="gMemberMobile" value="<?php echo $loanData['gMobile']; ?>" maxlength="13"  required />                  
                    </div>
					<div class="form-group col-md-2">
                      <label for="pageTitle">Member Photo</label>
                      <a href="<?php echo $loanData['memberPhoto']; ?>" title="Member Photo" target="_blank"><img style="height:120px;width:120px" src="<?php echo $loanData['memberPhoto']; ?>" /> </a>                
                    </div>
					<div class="form-group col-md-2">
                      <label for="pageTitle">Member Identity</label>
                      <a href="<?php echo $loanData['memberDocument']; ?>" title="Member Photo" target="_blank"><img style="height:120px;width:120px" src="<?php echo $loanData['memberDocument']; ?>" /> </a>                
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