<?php
include("controller/pages_controller.php");
$menuType ="loanRequest";
$msg='';
$pageHrefLink='';
if(isset($_REQUEST['addLoanRequest']))
{
	 $expensesName = $_REQUEST['expensesName'];
	 $expensesAmount = $_REQUEST['expensesAmount'];
	 $remarks = $_REQUEST['remarks'];
	 $cDate = $_REQUEST['cDate'];
	 $createdate = explode('/', $cDate);
	 $month = $createdate[1];
	 $day   = $createdate[0];
	 $year  = $createdate[2];
	 $joincDate = $year.'-'.$month.'-'.$day;
		$sql=mysql_query("INSERT INTO income_expenses(type,createDate,name,remarks,expensesAmount) VALUES ('Expenses','$joincDate','$expensesName','$remarks','$expensesAmount')");	$msg="Data Sucessfully Submited";
		$pageHrefLink="expenses.php";
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
                  		<h3 class="box-title">Expenses Details </h3>
                	</div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
                 <div class="box-body">
						
						<div class="form-group col-md-3">
						<label for="pageTitle">Name <span class="requiredField">*</span>  </label>
						<input type="text" class="form-control" id="expensesName" name="expensesName" placeholder="Expenses Name" maxlength="50"  required />                  
						</div>
						 <div class="form-group col-md-2">
						<label for="pageTitle">Amount <span class="requiredField">*</span>  </label>
						<input type="text" class="form-control" id="expensesAmount" name="expensesAmount" placeholder="Expenses Amount " maxlength="10" required />                  
						</div>					
						<div class="form-group col-md-2">
                        <label for="pageTitle" >Create Date <span class="requiredField">*</span> </label>
                        <input type="text" class="form-control date" id="cDate" name="cDate" placeholder="Date" maxlength="15" required />                   
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