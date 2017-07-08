<?php
include("controller/pages_controller.php");
$menuType =+"viewPages";
$id=$_REQUEST['id'];
$msg='';
$pageHrefLink='';
if(isset($_REQUEST['editStates']))
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
		if(mysql_num_rows($res) > 1)
		{
		$msg="Plan Name Already created.";
		}
		else
		{
		$sql=mysql_query("update loanplan set planName='$planName',planType='$planType',rateOfInterest='$rateOfInterest',planDuration='$planDuration',installmentType='$installmentType',penaltyInterest='$penaltyInterest',processingFee='$processingFee',taxRate='$taxRate',planDescription='$planDescription',status='$status' where id='$id'");
		$msg=updated;
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
                  <h3 class="box-title">Loan Plan  Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"  action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                	<?php $query="SELECT * FROM loanplan where 	id='$id'";
					$pagesData=fetchData($query);
					foreach($pagesData as $pageData)
					?>
                  <div class="box-body"> 
					<div class="form-group col-md-6">
                        <label for="pageTitle">Plan Name</label>
                        <input type="text" class="form-control" id="planName" name="planName" value="<?php echo $pageData['planName'] ?>" required />                   
                        </div>
                       <div class="form-group col-md-6">
                      <label>Plan Type</label>
                      <select class="form-control" name="planType" id="planType" required>
                     <?php 
                    	$query="SELECT * FROM plantypes where deleted='0' and status='0' and planType='LOAN'";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option  <?php if($tableData['id'] ==$pageData['planType']) echo 'selected'; ?> value="<?php echo $tableData['id']; ?>"><?php  echo $tableData['planName'] ?></option>	<?php } ?>
                      </select>
						</div>
                       <div class="form-group col-md-6">
                      <label for="pageTitle">Plan Duration(Months)  </label>
                      <input type="text" class="form-control" id="planDuration" name="planDuration" value="<?php echo $pageData['planDuration'] ?>" maxlength="3" required />                  
                    </div>
					<div class="form-group col-md-6">
                      <label for="pageTitle">Rate Of Interest(%)  </label>
                      <input type="text" class="form-control" id="rateOfInterest" name="rateOfInterest" value="<?php echo $pageData['rateOfInterest'] ?>" maxlength="5"  required />                  
                    </div>
					<div class="form-group col-md-6">
                      <label for="pageTitle">Installment Type  </label>
					<select class="form-control" name="installmentType" id="installmentType" required > 
					<option <?php if($pageData['installmentType'] =='InterestPrinciple'){ echo 'selected';} ?> value="InterestPrinciple">Interest + Principle</option>
					<option <?php if($pageData['installmentType'] =='Interest'){ echo 'selected';} ?> value="Interest">Interest</option>
					</select>	
					</div>
					<div class="form-group col-md-6">
                      <label for="pageTitle">Penalty Interest(%)  </label>
                      <input type="text" class="form-control" id="penaltyInterest" name="penaltyInterest" value="<?php echo $pageData['penaltyInterest'] ?>" maxlength="5" />                  
                    </div>
					 <div class="form-group col-md-6">
                      <label for="pageTitle">Processing Fee  </label>
                      <input type="text" class="form-control" id="processingFee" name="processingFee" value="<?php echo $pageData['processingFee'] ?>" maxlength="4"/>                  
                    </div>
					<div class="form-group col-md-6">
                      <label for="pageTitle">Tax Rate(%)  </label>
                      <input type="text" class="form-control" id="taxRate" name="taxRate" value="<?php echo $pageData['taxRate'] ?>" maxlength="5"/>                  
                    </div>
					<div class="form-group col-md-12">
                      <label for="pageTitle">Description</label>
                      <textarea class="form-control" id="planDescription" name="planDescription" placeholder="Description " maxlength="100"  required> <?php echo $pageData['planDescription'] ?></textarea>                  
                    </div>
                    <div class="form-group col-md-12">
                      <label>Status</label>
                      <select class="form-control" name="status">
                      <?php $status=$pageData['status'];
					   ?>
					  <option value="0"<?php if($status ==0) echo 'selected'; ?>>Enabled</option>
    				<option value="1"<?php if( $status == 1) echo 'selected'; ?>>Disabled</option>
                      </select>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="editStates">Update</button>
                  </div>
                </form>
              </div><!-- /.box -->



            </div><!--/.col (left) -->

          </div>   <!-- /.row -->
        </section>      
</div>
      <!-- /.content-wrapper -->
<?php include("common/adminFooter.php");?>

