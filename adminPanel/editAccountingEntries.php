<?php
include("controller/pages_controller.php");

$menuType ="loans";
$id=$_REQUEST['id'];
$msg='';
$pageHrefLink='';
if(isset($_REQUEST['editAccounting']))
{
	 $branchId = $_REQUEST['branchId'];
	if($_SESSION['branchId'])
	{
		$branchId = $_SESSION['branchId'];	
	}
	 $cDate = $_REQUEST['cDate'];
	 $createdate = explode('/', $cDate);
	 $month = $createdate[1];
	 $day   = $createdate[0];
	 $year  = $createdate[2];
	 $joincDate = $year.'-'.$month.'-'.$day;
	 $shriLifeAmt = $_REQUEST['shriLifeAmt'];
	 $loanAmt = $_REQUEST['loanAmt'];
	 $mFAmt = $_REQUEST['MFAmt'];
	 $totAmt = $_REQUEST['totAmt'];
	 $receiveAmt = $_REQUEST['receiveAmt'];
	 $pendingAmt = $_REQUEST['pendingAmt'];  
	$sql=mysql_query("UPDATE accountings SET branchId='$branchId',createDate='$joincDate', shriLife='$shriLifeAmt', loan='$loanAmt', MF='$mFAmt', totalPayment='$totAmt', receivePayment='$receiveAmt', pendingCollection='$pendingAmt' WHERE accountingId='$id'");
	$msg="Data Sucessfully Updated";
	$pageHrefLink="accounting.php";
}
function dateRange( $first, $step = '+0 day', $format = 'd/m/Y' ) 
{
	$dates = "";
	$current = strtotime( $first );
	$current = strtotime( $step, $current );
	$dates = date( $format, $current );
	return $dates;
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
		});
	$(".digitsOnly").keypress(function (e) 
	{
     //if the letter is not digit then display error and don't type anything
    if (e.which != 8 && e.which != 0 && (e.which < 46 || e.which > 57)) 
	{
       alert("Please use only numeric values.");
        return false;
	}
	});	
})
function totalPayment()
{
	var shriLife = parseFloat($("#shriLifeAmt").val());
	var loanAmt = parseFloat($("#loanAmt").val());
	var MFAmt = parseFloat($("#MFAmt").val());
	var totalPayments = 0;
	if(shriLife  || loanAmt  || MFAmt)
	{
		totalPayments = parseFloat(shriLife+loanAmt+MFAmt);
		$("#totAmt").val(totalPayments);
	}	
}
function receivedPayment()
{
	var totAmt = parseFloat($("#totAmt").val()); 
	var receiveAmt = parseFloat($("#receiveAmt").val()); 
	var diff = parseFloat(totAmt-receiveAmt);
	$("#pendingAmt").val(diff);
}
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
                  		<h3 class="box-title">Accounting information</h3>
                	</div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"  method="post" >
				<?php $query = "SELECT * FROM accountings where accountingId='$id'";
					$pagesData=fetchData($query);
					foreach($pagesData as $loanData)
					{
					?>
                 <div class="box-body">
						<div class ="row">	
							<div class="form-group col-md-3">
							<label for="pageTitle">Branch</label>
							<select class="form-control" name="branchId" id="branchId" required <?php if($_SESSION['branchCode']){echo "disabled";} ?>>
							<?php 
							$query="SELECT * FROM branchs where deleted='0' and status='0' and branchCode !='0'";
							$menuData=fetchData($query);
							foreach($menuData as $tableData)
							{ ?><option <?php if($loanData['branchId'] ==$tableData['branchId']){echo "selected";} ?> value="<?php echo $tableData['branchId']; ?>"><?php  echo $tableData['branchName']." - ".$tableData['branchCode'] ?></option>	<?php } ?>
							</select>
							</div> 
							<div class="form-group col-md-3">
							<label for="pageTitle" >Date</label>
							<input type="text" class="form-control date" id="cDate" name="cDate" placeholder="Date" maxlength="15" required  value="<?php echo dateRange($loanData['createDate']); ?>" />                   
							</div>
						</div>
						<div class ="row">	
							<div class="form-group col-md-2">
							<label for="pageTitle" >Shri life</label>
							<input type="number" class="form-control " onkeyup="totalPayment()" id="shriLifeAmt" name="shriLifeAmt" placeholder="Shri Life" value="<?php echo $loanData['shriLife']; ?>" maxlength="10" required />                   
							</div>
							<div class="form-group col-md-2">
							<label for="pageTitle" >Loan</label>
							<input type="number" class="form-control " onkeyup="totalPayment()" id="loanAmt"  name="loanAmt" placeholder="Loan" value="<?php echo $loanData['loan']; ?>"  maxlength="10" required />                   
							</div>
							<div class="form-group col-md-2">
							<label for="pageTitle" >MF</label>
							<input type="number" class="form-control " onkeyup="totalPayment()" id="MFAmt" name="MFAmt" placeholder="MF" value="<?php echo $loanData['MF']; ?>"  maxlength="10" required />                   
							</div>
							<div class="form-group col-md-2">
							<label for="pageTitle" >Total Payment</label>
							<input type="number" class="form-control " readonly id="totAmt" name="totAmt" placeholder="Total Payment" value="<?php echo $loanData['totalPayment']; ?>"  maxlength="10" required />                   
							</div>
							<div class="form-group col-md-2">
							<label for="pageTitle" >Receive Payment</label>
							<input type="number" class="form-control " id="receiveAmt" name="receiveAmt" onkeyup="receivedPayment()"  placeholder="Receive Payment" value="<?php echo $loanData['receivePayment']; ?>"  maxlength="10" required />                   
							</div>
							<div class="form-group col-md-2">
							<label for="pageTitle" >Pending Collection</label>
							<input type="number" class="form-control " readonly id="pendingAmt" name="pendingAmt" placeholder="Pending Collection" value="<?php echo $loanData['pendingCollection']; ?>" maxlength="10" required />                   
							</div>
						</div>	
                  </div><!-- /.box-body -->
				  <?php 
					}
					?>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary  pull-left" name="editAccounting">Submit</button>
                  </div>
				  
                </form>
              </div><!-- /.box -->
            </div><!--/.col (left) -->
          </div>   <!-- /.row -->
        </section>   
</div>
      <!-- /.content-wrapper -->
<?php include("common/webAdminFooter.php");?>