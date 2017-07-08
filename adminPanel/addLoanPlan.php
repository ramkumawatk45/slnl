<?php
include("controller/pages_controller.php");
$menuType =+"gallery";
$msg='';
$pageHrefLink='';
if(isset($_REQUEST['addStates']))
{
	 $planName = $_REQUEST['planName'];
	 $planType = $_REQUEST['planType'];
	 $rateOfInterest = $_REQUEST['rateOfInterest'];
	 $planDuration = $_REQUEST['planDuration'];
	 $installmentType = $_REQUEST['installmentType'];
	 $penaltyInterest = $_REQUEST['penaltyInterest'];
	 $processingFee = $_REQUEST['processingFee'];
	 $taxRate = $_REQUEST['taxRate'];
	 $planDescription = $_REQUEST['planDescription'];
	 $status = $_REQUEST['status'];
	 $sql = "select planName from loanplan where planName='$planName'";
	 $res = mysql_query($sql);
		if(mysql_num_rows($res))
		{
		$msg="Plan Name Already created.";
		}
		else
		{
		$sql=mysql_query("INSERT INTO loanplan(planName,planType,rateOfInterest,planDuration,installmentType,penaltyInterest,processingFee,	taxRate,planDescription,status) VALUES('$planName','$planType','$rateOfInterest','$planDuration','$installmentType','$penaltyInterest','$processingFee','$taxRate','$planDescription','$status')");
		$msg="Data Sucessfully Submited";
		$pageHrefLink="loanPlans.php";

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
                  		<h3 class="box-title">Loan Plan Detail</h3>
                	</div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
                 <div class="box-body">
						 <div class="form-group col-md-6">
                        <label for="pageTitle">Plan Name</label>
                        <input type="text" class="form-control" id="planName" name="planName" placeholder="Plan Name" required />                   
                        </div>
                       <div class="form-group col-md-6">
                      <label>Plan Type</label>
                      <select class="form-control" name="planType" id="planType" required>
                     <?php 
                    	$query="SELECT * FROM plantypes where deleted='0' and status='0' and planType='LOAN'";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option value="<?php echo $tableData['id']; ?>"><?php  echo $tableData['planName'] ?></option>	<?php } ?>
                      </select>
						</div>
                       <div class="form-group col-md-6">
                      <label for="pageTitle">Plan Duration(Months)  </label>
                      <input type="text" class="form-control" id="planDuration" name="planDuration" placeholder="Plan Duration " maxlength="3" required />                  
                    </div>
					<div class="form-group col-md-6">
                      <label for="pageTitle">Rate Of Interest(%)  </label>
                      <input type="text" class="form-control" id="rateOfInterest" name="rateOfInterest" placeholder="Rate Of Interest " maxlength="5"  required />                  
                    </div>
					 <div class="form-group col-md-6">
                      <label for="pageTitle">Installment Type  </label>
					<select class="form-control" name="installmentType" id="installmentType" required > 
					<option value="InterestPrinciple">Interest + Principle</option>
					<option value="Interest">Interest</option>
					</select>	
					</div>
					<div class="form-group col-md-6">
                      <label for="pageTitle">Penalty Interest(%)  </label>
                      <input type="text" class="form-control" id="penaltyInterest" name="penaltyInterest" placeholder="Penalty Interest " maxlength="5" />                  
                    </div>
					 <div class="form-group col-md-6">
                      <label for="pageTitle">Processing Fee  </label>
                      <input type="text" class="form-control" id="processingFee" name="processingFee" placeholder="Processing Fee" maxlength="4"/>                  
                    </div>
					<div class="form-group col-md-6">
                      <label for="pageTitle">Tax Rate(%)  </label>
                      <input type="text" class="form-control" id="taxRate" name="taxRate" placeholder="Tax Rate(%)" maxlength="5"/>                  
                    </div>
					<div class="form-group col-md-12">
                      <label for="pageTitle">Description</label>
                      <textarea class="form-control" id="planDescription" name="planDescription" placeholder="Description " maxlength="100"  required></textarea>                  
                    </div>
                        <div class="form-group col-md-12">
                        <label>Status</label>
                        <select class="form-control" name="status">
                        <option value="0">Enabled </option>
                        <option value="1" >Disabled</option>
                        </select>
                        </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="addStates">Submit</button>
                  </div>
				  
                </form>
              </div><!-- /.box -->
            </div><!--/.col (left) -->
          </div>   <!-- /.row -->
        </section>   
</div>
      <!-- /.content-wrapper -->
<?php include("common/adminFooter.php");?>