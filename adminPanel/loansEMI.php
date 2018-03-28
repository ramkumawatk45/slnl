<?php
include("controller/pages_controller.php");
$menuType ="loanEMI";
$msg='';
$pageHrefLink='';
$id=$_REQUEST['id'];
$branchId = $_SESSION['branchId'];
function dateRange( $first, $step = '+1 day', $format = 'd/m/Y' ) 
{
	$dates = "";
	$current = strtotime( $first );
	$current = strtotime( $step, $current );
	$dates = date( $format, $current );
	return $dates;
}
function dateRanges( $first, $step = '+1 day', $format = 'Y-m-d' ) 
{
	$dates = "";
	$current = strtotime( $first );
	$current = strtotime( $step, $current );
	$dates = date( $format, $current );
	return $dates;
}
?>
<script src="js/jquery.min.js"></script>   
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
		var paymentValue = parseInt($(this).val());
		var serviceCharge = parseInt($("#serviceCharge").val());
		var noOfEMI = parseInt($("#noOfEMI").val());
		var penaltyDeduct = $("#penaltyDeduct").val();
		var lateFees = parseInt($("#lateFees").val());
		var emi = parseInt($("#emi").val()*noOfEMI);
		var result = parseInt(emi+serviceCharge);
		$("#totalAmount").val(result);
		$("#paymentAmount").val(emi);
		var penaltyresult = 0;
		$('#penaltyDeduct').on('change',function(){
		if($(this).val() == 'Yes')
		{
			var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
			var dueDate = $('#dueDate').val().split('/');
			var currentDate = $('#currentDate').val().split('/');
			var firstDate = new Date(dueDate[2]+'/'+dueDate[1]+'/'+dueDate[0]);
			var secondDate = new Date(currentDate[2]+'/'+currentDate[1]+'/'+currentDate[0]);
			var diffDays  = 0;
			if(firstDate <= secondDate)
			{	
				diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)));
			}	
			if(diffDays > 0 && firstDate <= secondDate )
			{
				$("#penaltyDeductDays").val(diffDays);
				penaltyresult = Math.round((emi*lateFees/100)*diffDays,2);
			}	
				serviceCharge = parseInt($("#serviceCharge").val());
				$("#totalAmount").val(parseInt(penaltyresult+serviceCharge+emi));
				$("#lateFee").val(penaltyresult);
				var branchCode = "<?php echo $_SESSION['branchCode']; ?>";
				if(branchCode == 0)
				{	
					$("#lateFee").removeAttr("readonly");
				}	
		}	
		else
		{
			serviceCharge = parseInt($("#serviceCharge").val());
			penaltyresult = parseInt(emi+serviceCharge);
			$("#lateFee").val('');
			$("#totalAmount").val(penaltyresult);
		}	
		
		});	
		$('#serviceCharge').on('keyup change',function()
		{
			var lateFees =0;
			if($("#lateFee").val())
			{	
				lateFees = parseInt($("#lateFee").val());
			}
			var serviceCharges = parseInt($(this).val());
			var totalAmout = parseInt(serviceCharges+emi+lateFees);
			$("#totalAmount").val(totalAmout);
		});	
		if(($("#branchAccess").val() =="VIEW") || ($("#userAccess").val() =="VIEW"))
		{
			//$("#loanEMI").addClass("readWriteAccess");
			$("#Emi-Details").addClass("readWriteAccess");
		}		
		$('#lateFee').on('keyup change',function()
		{
			var lateFees =0;
			if($("#lateFee").val())
			{	
				lateFees = parseInt($("#lateFee").val());
			}
			var serviceCharges = parseInt($("#serviceCharge").val());
			var totalAmout = parseInt(serviceCharges+emi+lateFees);
			$("#totalAmount").val(totalAmout);
		});	
		
	})
	

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
function explode()
{
  if($("#loanStatus").val() == 1)
  {
	  $("#submitBtn").addClass("hide");
	  $("#Emi-Details").addClass("hide");
  }	
}
setTimeout(explode, 500);  
</script>

      <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content" id="loanEMI">
	
    	<div class="row">
            <!-- left column -->
            <div class="col-md-12">
			<div class="box-header with-border">
                  		<h3 class="box-title">Loan Payment</h3>
                	</div><!-- /.box-header -->
			<div class="col-md-6 ">
              <!-- general form elements -->
            	<div class="box box-primary">
                	
                <!-- form start -->
                <form role="form"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?id=".$id;?>" method="post" enctype="multipart/form-data">
				<?php 
					$query="SELECT * FROM loans where loanId='$id' and deleted='0'";
					$pagesData=fetchData($query);
					foreach($pagesData as $loanData)
					{
					?>
					<input type="hidden" id="stateId" value="<?php echo $loanData['stateId']; ?>">
					<input type="hidden" id="districtId" value="<?php echo $loanData['districtId']; ?>">
					<input type="hidden" id="areaCode" value="<?php echo $loanData['areaId']; ?>">
					<input type="hidden" id="loanStatus" name="loanStatus" value="<?php echo $loanData['status']; ?>">
                 <div class="box-body">
						
						<div class="form-group col-md-4 col-sm-4 col-xs-4 ">
                        <label for="pageTitle">Loan Id</label>
                        <input type="text" class="form-control" disabled id="loanId" name="loanId" value="<?php echo $loanData['loanId']; ?>"  maxlength="15" required />                   
                        </div>
						<div class="form-group col-md-4 col-sm-4 col-xs-4">
                        <label for="pageTitle">Branch</label>
						<select class="form-control" name="branchId" disabled id="branchId" required <?php if($_SESSION['branchCode']){echo "disabled";} ?>>
						<?php 
                    	$query="SELECT * FROM branchs where deleted='0' and status='0' and branchCode!='0' ";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option <?php if($_SESSION['branchCode'] ==$tableData['branchCode']){echo "selected";} ?> value="<?php echo $tableData['branchId']; ?>"><?php  echo $tableData['branchName']." - ".$tableData['branchCode'] ?></option>	<?php } ?>
						</select>
						</div>
						<div class="form-group col-md-4 col-sm-4 col-xs-4">
                        <label for="pageTitle">Form No.</label>
                        <input type="text" class="form-control" disabled id="formNo" name="formNo" value="<?php echo $loanData['formId']; ?>" maxlength="15" required />                   
                        </div>
						<div class="form-group col-md-4 col-sm-4 col-xs-4">
                        <label for="pageTitle">Member Id</label>
                        <input type="text" class="form-control" disabled id="memberId" name="memberId" value="<?php echo $loanData['memberId']; ?>" maxlength="15" required />                   
                        </div><div class="form-group col-md-4 col-sm-4 col-xs-4">
                        <label for="pageTitle" >Date</label>
                        <input type="text" class="form-control " disabled id="cDate" name="cDate" value="<?php echo $loanData['cDate']; ?>" maxlength="15" required />                   
                        </div>
						<div class="form-group col-md-4 col-sm-4 col-xs-4">
                        <label for="pageTitle">Applicant Name</label>
                        <input type="text" class="form-control" disabled id="applicantName" name="applicantName" value="<?php echo $loanData['applicantName']; ?>" maxlength="150" required />                   
                        </div>
						<div class="form-group col-md-4 col-sm-4 col-xs-4">
                        <label for="pageTitle">Gurdian Name</label>
                        <input type="text" class="form-control" disabled id="gurdianName" name="gurdianName" value="<?php echo $loanData['gurdianName']; ?>" maxlength="150" required />                   
                        </div>
						
						<div class="form-group col-md-4 col-sm-4 col-xs-4">
                      <label for="pageTitle">Address</label>
                      <textarea class="form-control" id="address" disabled name="address" placeholder="Address " maxlength="100"><?php echo $loanData['address']; ?></textarea>                  
						</div>
						<div class="form-group col-md-4 col-sm-4 col-xs-4 ">
                      <label>State</label>
                      <select class="form-control" disabled name="state" id="state" required>
                      <option value="0" >Select State</option>
                     <?php 
                    $query="SELECT * FROM states where deleted='0' and status='0'";
					$stateData=fetchData($query);
					foreach($stateData as $tableData)
					{ ?><option <?php if($tableData['stateId'] == $loanData['stateId']) { echo 'selected';} ?> value="<?php echo $tableData['stateId']; ?>"><?php  echo $tableData['stateName'] ?></option> <?php } ?>
                      </select>
                    </div>
					<div class="form-group col-md-4 col-sm-4 col-xs-4">
                      <label>District</label>
                      <select class="form-control" readonly name="district" id="district" required> </select>
                    </div>
					<div class="form-group col-md-4 col-sm-4 col-xs-4">
                      <label for="pageTitle">Area</label>
                      <select class="form-control" disabled name="area" id="area" required>
						</select>
                    </div>
					
					
						 <div class="form-group col-md-4 col-sm-4 col-xs-4">
                        <label for="pageTitle">Loan plan </label>
					<select class="form-control" disabled name="planId" id="planId" required>
                     <?php 
                    	$query="SELECT * FROM loanplan where deleted='0' and status='0'";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option <?php if($tableData['id'] ==$loanData['loanPlanId']) { echo 'selected';} ?> value="<?php echo $tableData['id']; ?>"><?php  echo $tableData['planName'] ?></option>	<?php } ?>
                      </select>                        </div>
                       <div class="form-group col-md-4 col-sm-4 col-xs-4">
                      <label>Plan Type</label>
                      <select class="form-control" disabled name="planType" id="planType" required>
                     <?php 
                    	$query="SELECT * FROM plantypes where deleted='0' and status='0' and planType='LOAN'";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option <?php if($tableData['id'] ==$loanData['planTypeId']) { echo 'selected';} ?> value="<?php echo $tableData['id']; ?>"><?php  echo $tableData['planName'] ?></option>	<?php } ?>
                      </select>
						</div>
                       <div class="form-group col-md-4 col-sm-4 col-xs-4">
                      <label for="pageTitle">Loan Amount  </label>
                      <input type="text" class="form-control" disabled id="loanAmount" name="loanAmount" value="<?php echo $loanData['loanAmount']; ?>" maxlength="10" required />                  
                    </div>
					<div class="form-group col-md-4 col-sm-4 col-xs-4">
                      <label for="pageTitle ">Rate Of Interest(%)  </label>
                      <input type="text" class="form-control" disabled id="rateOfInterest" name="rateOfInterest" value="<?php echo $loanData['rateOfInterest']; ?>" maxlength="5"  required />                  
                    </div>
					<div class="form-group col-md-4 col-sm-4 col-xs-4">
                      <label for="pageTitle">EMI  </label>
                      <input type="text" class="form-control" disabled id="emi" name="emi" value="<?php echo $loanData['emi']; ?>" maxlength="5"  required />                  
                    </div>
					<div class="form-group col-md-4 col-sm-4 col-xs-4">
                      <label for="pageTitle">Member Photo</label>
                      <img style="height:120px;width:120px" src="<?php echo $loanData['memberPhoto']; ?>" />                  
                    </div>
					<div class="form-group col-md-4 col-sm-4 col-xs-4">
                      <label for="pageTitle">Member Mobile Number</label>
                      <input type="text" class="form-control" disabled id="emi" name="emi" value="<?php echo $loanData['memberMobile']; ?>" maxlength="5"  required /> </div>
                        
                  </div><!-- /.box-body -->
				  <?php
						}
					?>
                </form>
              </div><!-- /.box -->
            </div><!--/.col (left) -->
			<div class="col-md-6">
			    	<div class="box box-primary " >
                	
                <!-- form start -->
                <form role="form"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?id=".$id;?>" method="post" enctype="multipart/form-data">
				<?php 
					$planDuration="";
					$totalPaid ="";
					$totalDue="";
					$advanceAmount="";
					$emiNo="";
					$emiNumber="";
					$totalAmount="";
					$query="SELECT * FROM loans where loanId='$id' and deleted='0' ";
					$pagesData=fetchData($query);
					foreach($pagesData as $loanData)
					{
						$planId=$loanData['loanPlanId'];
						$planQuery="SELECT * FROM loanplan where id='$planId' and status='0' and deleted='0' ";
						$planDatas=fetchData($planQuery);
						foreach($planDatas as $planData)
						{
							$planType=$planData['planType'];
							$planTypeQuery="SELECT * FROM plantypes where id='$planType' and status='0' and deleted='0' ";
							$planTypeDatas=fetchData($planTypeQuery);
							foreach($planTypeDatas as $planTypeData)
							{	
								$planTypes = $planTypeData['planName'];
								if($planTypes =="MONTHLY")
								{
									$planDuration = $planData['planDuration'];
								}	
								else if($planTypes =="QUATERLY")
								{
									$planDuration = $planData['planDuration']/3;
								}	
								else if($planTypes =="HALF YEARLY")
								{
									$planDuration = $planData['planDuration']/6;
								}
								else if($planTypes =="YEARLY")
								{
									$planDuration = $planData['planDuration']/12;
								}
								else if($planTypes =="DAILY")
								{
									$planDuration = ($planData['planDuration']/12)*360;
								}
								else if($planTypes =="WEEKLY")
								{
									$planDuration = (($planData['planDuration']/12)*360)/7;
								}
								else if($planTypes =="HALFMONTHLY")
								{
									$planDuration = (($planData['planDuration']/12)*360)/15;
								}	

						if(isset($_REQUEST['addEMI']))
						{	
							$branchId = $_REQUEST['branchId'];
							$loanId = $_REQUEST['loanId'];
							$emiNo = $_REQUEST['emiNo'];
							$lateFee = $_REQUEST['lateFee'];
							$serviceCharge = $_REQUEST['serviceCharge'];
							$transId ="";
							
							
							$penaltyDeduct = $_REQUEST['penaltyDeduct'];
							$emiAmount = $_REQUEST['emi'];

							$dueDate = $_REQUEST['dueDate'];
							$createdateDueDate = explode('/', $dueDate);
							 $month = $createdateDueDate[1];
							 $day   = $createdateDueDate[0];
							 $year  = $createdateDueDate[2];
							 $joinDueDate = $year.'-'.$month.'-'.$day;
							 $cDate = $_REQUEST['cDate'];
							 $createdateCDate = explode('/', $cDate);
							 $month = $createdateCDate[1];
							 $day   = $createdateCDate[0];
							 $year  = $createdateCDate[2];
							 $joinCDate = $year.'-'.$month.'-'.$day;
							//$serviceCharges = $_REQUEST['serviceCharges'];
							$paymentMode = $_REQUEST['paymentMode'];
							$chequeNo = $_REQUEST['chequeNo'];
							$chequeDate = $_REQUEST['chequeDate'];
							$bankName = $_REQUEST['bankName'];
							//Calculate NDD Date 
							$cdate=explode('/',$_REQUEST['dueDate']);
							$date=$cdate[0];
							$month=$cdate[1];
							$year=$cdate[2];
							$counter=$month;
							if($planTypes=='MONTHLY')
							{	
								$g; 
								$counter=$counter+=1;
								if($counter>12)
								{
									$counter=$counter-12; 
									$year++;
								}
								for($g=1;$g<12;$g++)
								{
									if(strlen($counter)==1)
									{
										if($counter==2 && $date>=29)
										{
											if($year%4==0)
											{
												$eminewDuedate=$year.'-0'.$counter.'-29';
											}
											else
											{
												$eminewDuedate=$year.'-0'.$counter.'-28';
											}
										}
										elseif($counter==4 && $date>=30 || $counter==6 && $date>=30 || $counter==9 && $date>=30)
										{
											$eminewDuedate=$year.'-0'.$counter.'-30';
										}
										else
										{
											$eminewDuedate=$year.'-0'.$counter.'-'.$date;
										}					
									}
									elseif( $counter==11 && $date>=30)
									{
										$eminewDuedate=$year.'-'.$counter.'-'.'30';
											
									}
									else
									{	 
										$eminewDuedate=$year.'-'.$counter.'-'.$date;
									}
								}
							}
							else if($planTypes=='DAILY')
							{	
								$date=$cdate[0];
								$month=$cdate[1];
								$year=$cdate[2];
								$loanCreateDate = $year.'-'.$month.'-'.$date;
								$eminewDuedate = dateRanges($loanCreateDate);
								var_dump($eminewDuedate);
							}	
							if($_REQUEST['totalPaid']< $_REQUEST['totalPayable'])
							{	
								 $emiStatus = "";
								 if($joinDueDate >= date('Y-m-d'))
								 {
									$emiStatus = "PRE";
								 }	
								 else
								 {
									 $emiStatus = "POST";
								 }	
							$transmaxId ='';	 
							$sqll = mysql_query("update loanemi set emiStatus='$emiStatus' where loanId=$loanId and deleted=0 and status=0");		
							$query="SELECT MAX(id) FROM loanemi";
							$loanEmiData=mysql_query($query);
							if (is_array($loanEmiData) || is_object($loanEmiData))
							{
									$data = mysql_fetch_array($loanEmiData);
									$transmaxId = $data[0];
							}
								$loanStatus =0;
								if($planDuration == $emiNo)
								{
									$loanStatus =1;
									$dateTime = date('Y-m-d H:i:s');
									mysql_query("update loans set status='$loanStatus',datetime='$dateTime' where loanId='$loanId'");	
								}	
								$transmaxId = $transmaxId+1;
								$transId = $transmaxId;
								$sql=mysql_query("INSERT INTO loanemi(loanId, branchCode, emiNo, lateFee, serviceCharge, transId, emiAmount, dueDate,newDueDate,ndd,paymentDate, newPaymentDate, paymentMode, chequeNo, chequeDate, bankName,status) VALUES ('$loanId','$branchId','$emiNo','$lateFee','$serviceCharge','$transId','$emiAmount','$dueDate','$joinDueDate','$eminewDuedate','$cDate','$joinCDate','$paymentMode','$chequeNo','$chequeDate','$bankName','$loanStatus')");
								echo sms($loanData['memberMobile'],"SHLIFE DEAR ".strtoupper($loanData['applicantName']).",Thank you for deposit your Loan EMI, Loan No <".$loanId.">,Rs-".(round($emiAmount+$lateFee+$serviceCharge)).",Date-".$cDate.", Shri Life Nidhi Limited.");
								if($sqll){ header("location:sucessEMI.php?id=".$id."&emiNO=".$emiNo); }
							}
							else
							{
								$msg="All EMI Paid.";
							}	
						}
						$dueDate="";
						$query="SELECT * FROM loanemi where loanId='$id' and deleted='0' and emiNo !='0'   order by emiNo";
						$loanEmiData=fetchData($query);
						if (is_array($loanEmiData) || is_object($loanEmiData))
						{
						foreach($loanEmiData as $emiData)
						{	
							$totalLoanAmount=$planDuration*$loanData['emi'];
							$totalPaid=$emiData['emiAmount']*$emiData['emiNo'];
							$totalDue =$totalLoanAmount-$totalPaid;
							$emiNo = $emiData['emiNo']+1;
							$dueDate = $emiData['dueDate'];
						}	
						}
					?>	
					<?php
					date_default_timezone_set('Asia/Kolkata');
					$today=date('d/m/Y');
					$date=explode('/',$today);
					$day=$date[0];
					$month=$date[1];
					$year=$date[2];
					if($dueDate)
					{	
						$loanCreateDate = $dueDate;
					}
					else
					{
						$loanCreateDate = $loanData['cDate'];
					}	
						$cdateDate=explode('/',$loanData['cDate']);
						$cdate=$loanCreateDate;
						$pdura;
						$cdate=explode('/',$cdate);
						$date=$cdateDate[0];
						$month=$cdate[1];
						$year=$cdate[2];
						$counter=$month;
					if($planTypes=='MONTHLY')
					{	
						$g; 
						$counter=$counter+=1;
						if($counter>12)
						{
							$counter=$counter-12; 
							$year++;
						}
						for($g=1;$g<$planDuration;$g++)
						{
							if(strlen($counter)==1)
							{
								if($counter==2 && $date>=29)
								{
									if($year%4==0)
									{
										$emidate='29/0'.$counter.'/'.$year;
									}
									else
									{
										$emidate='28/0'.$counter.'/'.$year;
									}
								}
								elseif($counter==4 && $date>=30 || $counter==6 && $date>=30 || $counter==9 && $date>=30)
								{
									$emidate='30/0'.$counter.'/'.$year;
								}
								else
								{
									$emidate=$date.'/0'.$counter.'/'.$year;
								}					
							}
							elseif( $counter==11 && $date>=30)
							{
								$emidate='30/'.$counter.'/'.$year;
									
							}
							else
							{	 
								$emidate=$date.'/'.$counter.'/'.$year;
							}
						}
					}	
					else if($planTypes=='DAILY')
					{	
						$date=$cdate[0];
						$month=$cdate[1];
						$year=$cdate[2];
						$loanCreateDate = $year.'-'.$month.'-'.$date;
						$emidate = dateRange($loanCreateDate);
					}
					?>
					<input type="hidden" id="loanId" name="loanId" value="<?php echo $loanData['loanId']; ?>">
					<input type="hidden" id="emi" name="emi" value="<?php echo $loanData['emi']; ?>">
	                 <div class="box-body">					
						<div class="form-group col-md-4  col-sm-4 col-xs-4 ">
                        <label for="pageTitle">Total Payable(Rs.)</label>
                        <input type="text" class="form-control" name="totalPayable" readonly value="<?php echo $planDuration*$loanData['emi']; ?>"  maxlength="15" required />                   
                        </div>
						<div class="form-group col-md-4  col-sm-4 col-xs-4 ">
                        <label for="pageTitle">Total Paid</label>
						<input type="text" class="form-control" readonly name="totalPaid"  value="<?php echo $totalPaid; ?>" maxlength="15" required />                   
						</div>
						<div class="form-group col-md-4  col-sm-4 col-xs-4 ">
                        <label for="pageTitle">Due Amount</label>
                        <input type="text" class="form-control" readonly  value="<?php echo $totalDue; ?>" maxlength="15" required />                   
                        </div>
						<div id="Emi-Details">
						<div class="form-group col-md-4  col-sm-4 col-xs-4 ">
                        <label for="pageTitle">No.Of EMI</label>
                        <input type="number" class="form-control" readonly id="noOfEMI" name="noOfEMI" value="1" maxlength="2" required />                   
                        </div>
						<div class="form-group col-md-4  col-sm-4 col-xs-4 ">
                        <label for="pageTitle">EMI Paid</label>
                        <input type="text" class="form-control" readonly name="emiNo"  value="<?php if($emiNo){echo $emiNo; } else{ echo "1";} ?>" maxlength="15" required />                   
                        </div>
						<div class="form-group col-md-4  col-sm-4 col-xs-4 ">
                        <label for="pageTitle">Payment Amount</label>
                        <input type="text" class="form-control" id="paymentAmount" readonly name="paymentAmount" maxlength="15" required />                   
                        </div>
						<div class="form-group col-md-3  col-sm-3 col-xs-3 ">
                        <label for="pageTitle">Total Amount</label>
                        <input type="text" class="form-control" readonly name="totalAmount" id="totalAmount" maxlength="15" />                   
                        </div>
						<div class="form-group col-md-3  col-sm-3 col-xs-3 ">
                        <label for="pageTitle" >Date</label>
                        <input type="text" class="form-control  <?php if($_SESSION['branchCode'] =='0' && ($_SESSION['moduleRole']) =="NORMAL"){echo "disabled";} else{ echo 'date';} ?>"  readonly name="cDate" id='currentDate' value="<?php echo date('d/m/Y')?>" maxlength="15" required />                   
                        </div>
						<div class="form-group col-md-3  col-sm-3 col-xs-3 ">
                        <label for="pageTitle" >Due Date</label>
                        <input type="text" class="form-control "  readonly name="dueDate" id='dueDate' value="<?php if($emidate) { echo $emidate; }?>" maxlength="15" required />                   
                        </div>						
						<div class="form-group col-md-3  col-sm-3 col-xs-3 ">
                        <label for="pageTitle">Branch</label>
						<select class="form-control" name="branchId" id="branchId" required <?php if($_SESSION['branchCode']){echo "style=' pointer-events: none;'";} ?>>
						<?php 
                    	$query="SELECT * FROM branchs where deleted='0' and status='0' and branchCode!='0' ";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option <?php if($_SESSION['branchCode'] ==$tableData['branchCode']){echo "selected";} ?> value="<?php echo $tableData['branchId']; ?>"><?php  echo $tableData['branchName']." - ".$tableData['branchCode'] ?></option>	<?php } ?>
						</select>
						</div>
						<?php 
						$query="SELECT * FROM defaults where type ='LATEFEES'";
						$defaultData=fetchData($query);
						foreach($defaultData as $defaults)
						{
							?>
						<div class="form-group col-md-3  col-sm-3 col-xs-3 ">
                        <label for="pageTitle">Penalty Deduct </label>
                        <input type="hidden" class="form-control"  id="lateFees" name="lateFees" value="<?php  echo $defaults['defaultVal']; ?>"  maxlength="15" />                   
						 <select class="form-control" name="penaltyDeduct" id="penaltyDeduct" >
							<option <?php if($defaults['status']=="1") { echo 'selected';} ?>value="0">No</option>
							<option <?php if($defaults['status']=="0") { echo 'selected';} ?>value="1">Yes</option>
						</select>
						</div>
						<div class="form-group col-md-3  col-sm-3 col-xs-3 ">
                        <label for="pageTitle" >Penalty Days</label>
                        <input type="text" class="form-control "  readonly name="penaltyDeductDays" id='penaltyDeductDays' value="0" maxlength="15" />                   
                        </div>	
						<div class="form-group col-md-3  col-sm-3 col-xs-3 ">
                        <label for="pageTitle" >Penalty Rs</label>
                        <input type="text" class="form-control "  readonly name="lateFee" id='lateFee' value="0" maxlength="15" />                   
                        </div>	
						<?php 
						}
						$query="SELECT * FROM defaults where type ='SERVICECHARGE' ";
						$defaultData=fetchData($query);
						foreach($defaultData as $defaults)
						{
							?>
						<div class="form-group col-md-3  col-sm-3 col-xs-3 ">
                        <label for="pageTitle">Service Charges</label>
						<select class="form-control " name="serviceCharge" id="serviceCharge" >
							<option value="0">None</option>
							<option value="150">150</option>
							<option value="250">250</option>
							<option value="350">350</option>
							<option value="450">450</option>
						</select>                  
						</div>
						<?php } ?>
						<div class="form-group col-md-3  col-sm-3 col-xs-3 ">
				  <label for="pageTitle">Payment Mode</label>
				  <select class="form-control" name="paymentMode" id="paymentMode"> 
					<option value="cash">Cash</option>
					<option value="cheque">Cheque</option>
					</select>
                    </div>
					<div class="form-group col-md-3  col-sm-3 col-xs-3 ">
                      <label for="pageTitle">Cheque No</label>
                      <input type="text" class="form-control" id="chequeNo" name="chequeNo" placeholder="Cheque No" maxlength="10"  />                  
                    </div>
					<div class="form-group col-md-3  col-sm-3 col-xs-3 ">
                      <label for="pageTitle">Cheque Date</label>
                      <input type="text" class="form-control date" id="chequeDate" name="chequeDate" placeholder="Cheque Date " />                  
                    </div>
					<div class="form-group col-md-3  col-sm-3 col-xs-3 ">
                      <label for="pageTitle">Bank Name</label>
                      <input type="text" class="form-control" id="bankName" name="bankName" placeholder="Bank Name" />                  
                    </div>
					<div class="form-group col-md-4  col-sm-4 col-xs-4 ">
					<label for="pageTitle">&nbsp;</label>
					<button type="submit" class="btn btn-primary  pull-down" name="addEMI" id="submitBtn">Submit</button>
                    </div>
					</div>
					<div class="box-header col-md-12 with-border  col-sm-12 col-xs-12 ">
                  		<h3 class="box-title">Paid EMI's</h3>
                	</div>
					<div class="box-body col-md-12  col-sm-12 col-xs-12 " style="overflow-y:auto; height:150px; border:1px solid #f4f4f4;" >
                  <table id="category" class="table table-bordered table-striped" >
                    <thead>
                      <tr>
                        <th class="col-md-1">EMINo.</th>
                        <th class="col-md-1">DueDate</th>
						<th class="col-md-1">PayDate</th>
						<th class="col-md-1">EMIAmt</th>
						<th class="col-md-1">LateAmt</th>
						<th class="col-md-1">ServiceCh.</th>
						<th class="col-md-1">Print MR</th>
                      </tr>
                    </thead>
					<tbody>
					
					<?php 
					if (is_array($loanEmiData) || is_object($loanEmiData))
					{
					foreach($loanEmiData as $emiData)
						{
					?>		
					<tr>
						<td><?php echo $emiData['emiNo']; ?></td>
						<td><?php echo $emiData['dueDate'] ?></td>
						<td><?php echo $emiData['paymentDate'];?></td>
						<td><?php echo $emiData['emiAmount']; ?></td>
						<td><?php echo $emiData['lateFee'];?></td>
						<td><?php echo $emiData['serviceCharge'];?></td>
						<td><a target="_blank" href="print_emireceipt.php?emiNo=<?php echo $emiData['emiNo'];?>&loanId=<?php echo $loanData['loanId']; ?>">Print MR</a></td>
					</tr>
						<?php 
						} 
					}
						?>
					</tbody>
					</table>
					</div>
				  <?php
					}}}
					?>
                </form>
              </div><!-- /.box -->
            </div><!--/.col (left) -->
			</div>
          </div>   <!-- /.row -->
		  </div>
        </section>   
</div>
      <!-- /.content-wrapper -->
<?php include("common/adminFooter.php");?>