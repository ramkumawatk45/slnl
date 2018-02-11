<?php
include("controller/pages_controller.php");
$menuType ="loans";
$id=$_REQUEST['id'];
$msg='';
$pageHrefLink='';
if(isset($_REQUEST['editAccounting']))
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
	$sql=mysql_query("UPDATE income_expenses SET createDate='$joincDate', name='$expensesName', remarks='$remarks', expensesAmount='$expensesAmount' WHERE id='$id'");
	$msg="Data Sucessfully Updated";
	$pageHrefLink="expenses.php";
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
                  		<h3 class="box-title">Expenses Details</h3>
                	</div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"  method="post" >
				<?php $query = "SELECT * FROM income_expenses where id='$id'";
					$pagesData=fetchData($query);
					foreach($pagesData as $loanData)
					{
					?>
                 <div class="box-body">
						
						<div class="form-group col-md-3">
						<label for="pageTitle">Name <span class="requiredField">*</span>  </label>
						<input type="text" class="form-control" id="expensesName" name="expensesName" placeholder="Expenses Name" value="<?php echo $loanData['name']; ?>" maxlength="50"  required />                  
						</div>
						 <div class="form-group col-md-2">
						<label for="pageTitle">Amount <span class="requiredField">*</span>  </label>
						<input type="text" class="form-control" id="expensesAmount" name="expensesAmount" placeholder="Expenses Amount " value="<?php echo $loanData['expensesAmount']; ?>" maxlength="10" required />                  
						</div>					
						<div class="form-group col-md-2">
                        <label for="pageTitle" >Create Date <span class="requiredField">*</span> </label>
                        <input type="text" class="form-control date" id="cDate" name="cDate" placeholder="Date" maxlength="15" value="<?php echo dateRange($loanData['createDate']); ?>" required />                   
                        </div>
						<div class="form-group col-md-4">
						  <label for="pageTitle">Remarks </label>
						  <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks" value="<?php echo $loanData['remarks']; ?>" maxlength="100" />              
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