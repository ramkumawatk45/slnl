<?php
include("controller/pages_controller.php");
$menuType ="loanRequest";
$msg='';
$pageHrefLink='';
if(isset($_REQUEST['addLoanRequest']))
{
	 $incomeName = $_REQUEST['incomeName'];
	 $penaltyAmount = $_REQUEST['penaltyAmount'];
	 $serviceCharges = $_REQUEST['serviceCharges'];
	 $insuranceCharges = $_REQUEST['insuranceCharges'];
	 $loanSavings = $_REQUEST['loanSavings'];
	 $remarks = $_REQUEST['remarks'];
	 $cDate = $_REQUEST['cDate'];
	 $createdate = explode('/', $cDate);
	 $month = $createdate[1];
	 $day   = $createdate[0];
	 $year  = $createdate[2];
	 $joincDate = $year.'-'.$month.'-'.$day;
		$sql=mysql_query("INSERT INTO income_expenses(type,createDate,name,remarks,penaltyAmount,serviceCharges,insuranceCharges,loanSavings) VALUES ('Income','$joincDate','$incomeName','$remarks','$penaltyAmount' ,'$serviceCharges' ,'$insuranceCharges' ,'$loanSavings')");	
		$msg="Data Sucessfully Submited";
		$pageHrefLink="incomes.php";
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
                  		<h3 class="box-title">Income Details </h3>
                	</div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
                 <div class="box-body">				
						<div class="form-group col-md-2">
                        <label for="pageTitle" >Create Date <span class="requiredField">*</span> </label>
                        <input type="text" class="form-control date" id="cDate" name="cDate" placeholder="Date" maxlength="15" required />                   
                        </div>
						<div class="form-group col-md-2">
						<label for="pageTitle">Name <span class="requiredField">*</span>  </label>
						<input type="text" class="form-control" id="incomeName" name="incomeName" placeholder="Income Name" maxlength="50"  required />                  
						</div>
						<div class="form-group col-md-2">
						<label for="pageTitle">Penalty Amount <span class="requiredField">*</span>  </label>
						<input type="text" class="form-control digitsOnly" id="penaltyAmount" name="penaltyAmount" placeholder="Penalty Amount" maxlength="10" required />                  
						</div>
						<div class="form-group col-md-2">
						<label for="pageTitle">Insurance Charges <span class="requiredField">*</span>  </label>
						<input type="text" class="form-control digitsOnly" id="insuranceCharges" name="insuranceCharges" placeholder="Insurance Charges" maxlength="10" required />          </div>
						<div class="form-group col-md-2">
						<label for="pageTitle">Loan Savings <span class="requiredField">*</span>  </label>
						<input type="text" class="form-control digitsOnly" id="loanSavings" name="loanSavings" placeholder="Loan Savings" maxlength="10" required />                  
						</div>
						<div class="form-group col-md-4">
						  <label for="pageTitle">Remarks </label>
						  <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks" maxlength="100" />              
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