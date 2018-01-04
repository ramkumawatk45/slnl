<?php
include("controller/pages_controller.php");
$menuType =+"gallery";
$msg='';
$pageHrefLink='';
$id="";
if(isset($_REQUEST['loanSearch']))
{
	$branchId = $_SESSION['branchId'];
	$loanSearchId =$_REQUEST['loanSearchId'];
	if($_SESSION['userType']=="ADMIN")
	{
		$sql = "select loanId from loans where loanId='$loanSearchId'";
	}
	else
	{
		$sql = "select loanId from loans where loanId='$loanSearchId'";
	}	
	 $res = mysql_query($sql);
		if(mysql_num_rows($res)< 1)
		{
		$msg="Invalid Loan Id. Please check the loan Id";
		}
		else
		{	
			header("location:loansEMI.php?id=".$loanSearchId);
		}	
}
?>
      <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content">
    	<div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
            	<div class="box box-primary">
                	<div class="box-header with-border">
                  		<h3 class="box-title">Loan Payment</h3>
						
                	</div><!-- /.box-header -->
                <!-- form start -->
				 <div class="box-body">
				<form role="form"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
						 <div class="form-group col-md-2  col-sm-2 col-xs-2 ">
                        <label for="pageTitle">Loan Id</label>
                        <input type="text" class="form-control" id="loanSearchId" name="loanSearchId" placeholder="Loan Id" maxlength="15" required />                   
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