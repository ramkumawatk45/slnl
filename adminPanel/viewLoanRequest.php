<?php
include("controller/pages_controller.php");
$menuType ="loanRequest";
$id=$_REQUEST['id'];
$msg='';
$pageHrefLink='';
if(isset($_REQUEST['approveLoan']))
{
	 $requestStatus = $_REQUEST['requestStatus'];
	 $approveAmount = $_REQUEST['approveAmount'];
	 $approveDate = $_REQUEST['approveDate'];
	 $approveDate = explode('/', $approveDate);
	 $month = $approveDate[1];
	 $day   = $approveDate[0];
	 $year  = $approveDate[2];
	 $approvedDate = $year.'-'.$month.'-'.$day;
	 $requestReason = $_REQUEST['requestReason'];
	$sql=mysql_query("UPDATE loanrequests SET requestStatus='$requestStatus',approveAmount='$approveAmount', approveDate='$approvedDate',requestReason='$requestReason' where id='$id' ");
	$msg=updated;
	$pageHrefLink="loanPendingRequest.php";
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
					<?php if($loanData['memberPhoto'] !="uploads/loanrequest/images/") { ?>
					<div class="form-group col-md-2">
                      <label for="pageTitle">Member Photo</label>
                      <a href="<?php echo $loanData['memberPhoto']; ?>" title="Member Photo" target="_blank"><img style="height:120px;width:120px" src="<?php echo $loanData['memberPhoto']; ?>" /> </a>             
                    </div>
					<?php } ?>   
					 <?php if($loanData['memberDocument'] !="uploads/loanrequest/idendity/") { ?>
					<div class="form-group col-md-2">
                      <label for="pageTitle">Member Identity</label>
                      <a href="<?php echo $loanData['memberDocument']; ?>" title="Member Photo" target="_blank"><img style="height:120px;width:120px" src="<?php echo $loanData['memberDocument']; ?>" /> </a>    
                    </div>
					 <?php } ?>
					 </div><!-- /.box-body -->
				  <?php
					}
					if($_SESSION['userType']=="ADMIN")
					{
					?>
					 <div class="box-body">
						<div class="form-group col-md-2">
						<label for="pageTitle">Request Status</label>
						<select class="form-control" name="requestStatus" id="requestStatus"> 
						<option value="Pending" <?php if($loanData['requestStatus'] =='Pending') { echo 'selected';} ?>>Pending</option>
						<option value="Approved" <?php if($loanData['requestStatus'] =='Approved') { echo 'selected';} ?>>Approve</option>
						<option value="Rejected" <?php if($loanData['requestStatus'] =='Rejected') { echo 'selected';} ?>>Reject</option>
						</select>	                   
						</div>
						<div class="form-group col-md-2">
                        <label for="pageTitle">Approve Amount</label>
                        <input type="text" class="form-control" id="approveAmount" name="approveAmount" value="<?php  if($loanData['approveAmount']) { echo $loanData['approveAmount']; } else { echo $loanData['loanAmount']; } ?>" maxlength="10" required />                   
                        </div>
						<div class="form-group col-md-2">
                        <label for="pageTitle">Approve Date</label>
                        <input type="text" class="form-control date" id="approveDate" name="approveDate" value="<?php  echo date('d/m/Y'); ?>" required />                   
                        </div>
						
						<div class="form-group col-md-4">
						<label for="pageTitle">Remark</label>
						<textarea class="form-control" id="requestReason" name="requestReason" placeholder="Note" maxlength="200"><?php if($loanData['requestReason']) { echo $loanData['requestReason']; } ?></textarea>
						</div>
						</div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary  pull-left" name="approveLoan">Submit</button>
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