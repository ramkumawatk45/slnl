<?php
include("controller/web_pages_controller.php");
$menuType ="loans";
$msg='';
$pageHrefLink='';
if(isset($_REQUEST['addAccounting']))
{
	 $branchId = $_REQUEST['branchId'];
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
	$sql=mysql_query("INSERT INTO `shrilife_loansoft`.`accountings` (`branchId`, `createDate`, `shriLife`, `loan`, `MF`, `totalPayment`, `receivePayment`, `pendingCollection`) VALUES ('$branchId', '$joincDate', '$shriLifeAmt', '$loanAmt', '$mFAmt', '$totAmt', '$receiveAmt', '$pendingAmt')");
	$msg="Data Sucessfully Submited";
	$pageHrefLink="accounting.php";
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
                  		<h3 class="box-title">Accounting information</h3>
                	</div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
                 <div class="box-body">
						<div class ="row">	
							<div class="form-group col-md-3">
							<label for="pageTitle">Branch</label>
							<select class="form-control" name="branchId" id="branchId" required <?php if($_SESSION['branchCode']){echo "disabled";} ?>>
							<?php 
							$query="SELECT * FROM branchs where deleted='0' and status='0' and branchCode !='0'";
							$menuData=fetchData($query);
							foreach($menuData as $tableData)
							{ ?><option <?php if($_SESSION['branchCode'] ==$tableData['branchCode']){echo "selected";} ?> value="<?php echo $tableData['branchId']; ?>"><?php  echo $tableData['branchName']." - ".$tableData['branchCode'] ?></option>	<?php } ?>
							</select>
							</div> 
							<div class="form-group col-md-3">
							<label for="pageTitle" >Date</label>
							<input type="text" class="form-control date" id="cDate" name="cDate" placeholder="Date" maxlength="15" required value="<?php echo date('d/m/Y'); ?>" />                   
							</div>
						</div>
						<div class ="row">	
							<div class="form-group col-md-2">
							<label for="pageTitle" >Shri life</label>
							<input type="text" class="form-control " id="shriLifeAmt" name="shriLifeAmt" placeholder="Shri Life" maxlength="10" required />                   
							</div>
							<div class="form-group col-md-2">
							<label for="pageTitle" >Loan</label>
							<input type="text" class="form-control " id="loanAmt" name="loanAmt" placeholder="Loan" maxlength="10" required />                   
							</div>
							<div class="form-group col-md-2">
							<label for="pageTitle" >MF</label>
							<input type="text" class="form-control " id="MFAmt" name="MFAmt" placeholder="MF" maxlength="10" required />                   
							</div>
							<div class="form-group col-md-2">
							<label for="pageTitle" >Total Payment</label>
							<input type="text" class="form-control " id="totAmt" name="totAmt" placeholder="Total Payment" maxlength="10" required />                   
							</div>
							<div class="form-group col-md-2">
							<label for="pageTitle" >Receive Payment</label>
							<input type="text" class="form-control " id="receiveAmt" name="receiveAmt" placeholder="Receive Payment" maxlength="10" required />                   
							</div>
							<div class="form-group col-md-2">
							<label for="pageTitle" >Pending Collection</label>
							<input type="text" class="form-control " id="pendingAmt" name="pendingAmt" placeholder="Pending Collection" maxlength="10" required />                   
							</div>
						</div>	
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary  pull-left" name="addAccounting">Submit</button>
                  </div>
				  
                </form>
              </div><!-- /.box -->
            </div><!--/.col (left) -->
          </div>   <!-- /.row -->
        </section>   
</div>
      <!-- /.content-wrapper -->
<?php include("common/webAdminFooter.php");?>