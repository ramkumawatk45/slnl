<?php
include("controller/pages_controller.php");
$menuType =+"gallery";
$msg='';
$pageHrefLink='';
?>
      <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content">
    	<div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
            	<div class="box box-primary">
                <!-- form start -->
                <div class="box-header with-border ">
						<br><br>
                  		<center><h4 class="box-title ">Thank You Deposit Your EMI</h4></center><br>
						<center><h4 class="box-title ">If do you want to print receipt <a target="_blank" href="print_emireceipt.php?emiNo=<?php echo $_REQUEST['emiNO'];?>&loanId=<?php echo $_REQUEST['id']; ?>">Click Here</a> </h4></center><br>
						<center><h4 class="box-title "><a href="loansEMI.php?id=<?php echo $_REQUEST['id'];?>">Click Here to Back</h4></center>
						<br><br><br><br>
						<br><br><br><br>
                	</div><!-- /.box-header -->
              </div><!-- /.box -->
            </div><!--/.col (left) -->
          </div>   <!-- /.row -->
        </section>   
</div>
      <!-- /.content-wrapper -->
<?php include("common/adminFooter.php");?>