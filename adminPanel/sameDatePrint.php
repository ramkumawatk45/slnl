<?php
include("controller/pages_controller.php");
$menuType =+"gallery";
$msg='';
$pageHrefLink='';
$id="";
if(isset($_REQUEST['loanSearch']))
{
	$printDate = $_REQUEST['printDate'];
	if($printDate)
	{	
		if($printDate <= date('d/m/Y'))
		{
			header("location:sameDateReceipt.php?rDate=".$printDate);
		}
		else
		{
			$msg="Future Date Not Allowed";
		}	
	}	
	else
	{
		$msg="Please Select A Date";
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
                  		<h3 class="box-title">Day wise receipt print</h3>
						
                	</div><!-- /.box-header -->
                <!-- form start -->
				 <div class="box-body">
				<form role="form"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
						 <div class="form-group col-md-2">
                        <label for="pageTitle">Select Date</label>
                        <input type="text" class="form-control date" id="printDate" name="printDate" readonly placeholder="Select Date" maxlength="15" required />                   
                        </div>
						 </div><!-- /.box -->
						 <div class="box-footer">
                    <button type="submit" class="btn btn-primary  pull-left" name="loanSearch">Submit</button>
                  </div>
						 </form>
                
             
            </div><!--/.col (left) -->
          </div>   <!-- /.row -->
        </section>   
</div>
      <!-- /.content-wrapper -->
<?php include("common/adminFooter.php");?>