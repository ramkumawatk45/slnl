<?php
include("controller/pages_controller.php");
$menuType = "gallery";
?>
<style>
 @media print{
    table {
        border:solid; white !important;
        border-width:1px 0 0 1px !important;
        border-bottom-style: none;
    }
    th, td{
        border:solid; white !important;
        border-width:0 1px 1px 0 !important;
        border-bottom-style: none;
    }
	tr.brahchName{
		text-align:center;background-color:grey;color:#fff;
	}	
}
</style>
<script type="text/javascript">
//$("#loading").removeClass('hide');
 // $.ajax({    //create an ajax request to load_page.php
        // type: "GET",
        // url: "ajaxDueReport.php",             
        // dataType: "html",   //expect html to be returned                
        // success: function(response){                    
            // $("#tableData").html(response); 
			// //sortTableData();
            // //alert(response);
        // }
 // });
 $(document).ready(function() {
	 //sortTableData();
 }); 
 function sortTableData()
 {
	$("#loading").addClass('hide');
    $('#emiReport').DataTable({
        dom: 'Bfrtip',
        buttons: [
				'pageLength',
			{
			extend: 'pdf',
			footer: true,
			title: 'EMI Due Report',
			exportOptions: {
			columns: ':visible',
			modifier: {
				page: 'current',
			}
			}
			},
            {
                extend: 'print',
				footer: true,
				title: 'EMI Due Report',
                exportOptions: {
                columns: ':visible',
				modifier: {
                    page: 'current',
                }
				}
            },
			{
                extend: 'copy',
				footer: true,
				title: 'EMI Due Report',
                exportOptions: {
                columns: ':visible',
				modifier: {
                    page: 'current'
                }
				}
            },
			{
                extend: 'excel',
				footer: true,
				title: 'EMI Due Report',
                exportOptions: {
                columns: ':visible',
				modifier: {
                    page: 'current'
                }
				}
            },
            'colvis'
        ],
        columnDefs: [ {
            visible: false
        } ],
		lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 ', '25 ', '50 ', 'Show all' ]
        ],

    });
	
}
</script>
<div class="content-wrapper">
        <!-- Main content -->
      
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">EMI Due  Report</h3>
                </div><!-- /.box-header -->
                <div class="box-body ">
                  <table id="emiReport" class="table table-bordered table-striped">
                   <thead>
                      <tr>
                        <th class="col">Loan Id</th>
						<th>Applicant Name</th>
						<th>Gurdian Name</th>
						<th>Address</th>						
						<th>Area Name</th>
						<th>Phone No</th>
						<th>Term</th>
						<th>Mode</th>
						<th>EMI Date</th>
						<th>EMI No.</th>
                        <th>EMI(RS.)</th>
                      </tr>
                    </thead>
					<tbody id="tableData">
<?php					
		$branchId = $_SESSION['branchId'];	
		$today=date('Y-m-d');
		if($_SESSION['userType']=="ADMIN")
		{
			$queryBranch="SELECT * FROM branchs where status='0' and deleted='0' ";
		}
		else
		{
			$queryBranch="SELECT * FROM branchs where status='0' and deleted='0' and branchId='$branchId'";
		}	
			$menuDatas=fetchData($queryBranch);
			$branchTableId;
			foreach($menuDatas as $branchData)
			{  
				?>
				<tr style="text-align:center;background-color:grey;color:#fff;" class="brahchName">
						<th colspan="12"style="text-align:center;background-color:grey;color:#fff; border:none;"> 
						<?php echo $branchData['branchName']." - ".$branchData['branchCode'];  ?>
						</th>
					
				</tr>
		<?php
		$branchTableId = $branchData['branchId'];
		if($_SESSION['userType']=="ADMIN")
		{
		$query=" SELECT * FROM loans inner join loanemi on loans.loanId=loanemi.loanId and loans.deleted='0' and loanemi.emiNo =(SELECT max(emiNO) from loanemi where loans.loanId=loanemi.loanId) and loanemi.ndd <'$today' and loanemi.emiStatus !='PRE' and loanemi.branchCode='$branchTableId'";
		}
		else
		{
				$query=" SELECT * FROM loans inner join loanemi on loans.loanId=loanemi.loanId and  loans.deleted='0' and loanemi.emiNo =(SELECT max(emiNO) from loanemi where loans.loanId=loanemi.loanId) and loanemi.ndd <'$today' and loanemi.emiStatus !='PRE'  and loans.branchCode='$branchId'";
		}	
		$pageData=fetchData($query);
		if (is_array($pageData) || is_object($pageData))
		{
		$i=1;	
		foreach($pageData as $tableData)
		{
			
			$pplanId=$tableData['loanPlanId'];
			$plansQuery="SELECT * FROM loanplan where id='$pplanId' ";
			$plansDatas=fetchData($plansQuery);
			if (is_array($plansDatas) || is_object($plansDatas))
			{
				foreach($plansDatas as $branchData)
				{ $totalPlanDuration = $branchData['planDuration']; } 
				$remainLoanEMI = $totalPlanDuration-$tableData['emiNo'];
			}	

				$nexDueDate = "";
				$cdate=explode('-',$tableData['ndd']);
				$date=$cdate[2];
				$month=$cdate[1];
				$year=$cdate[0];
				$counter=$month;
				for($g=1;$g<=$remainLoanEMI;$g++)
				{
					if(strlen($counter)==1)
					{
						if($counter==2 && $date>=29)
						{
							if($year%4==0)
							{
								$nexDueDate =+'29-0'.$counter.'-'.$year;
							}
							else				
							{
								$nexDueDate =+ '28-0'.$counter.'-'.$year;
							}
						}
						elseif($counter==4 && $date>=30 || $counter==6 && $date>=30 || $counter==9 && $date>=30)
						{
							$nexDueDate =+ '30-0'.$counter.'-'.$year;
						}
						else 
						{
							$nexDueDate =+ $date.'-0'.$counter.'-'.$year;
						}			
					}
					elseif( $counter==11 && $date>=30)
					{
						$nexDueDate =+ '30-'.$counter.'-'.$year;
				
					}
					else
					{	
					 $nexDueDate = $date.'-'.$counter.'-'.$year;
					}
					if($counter==12){$counter=0; $year++;}
						$counter++;
				}
				
				
				
				// Set timezone
					date_default_timezone_set('UTC');

					// Start date
					$date = $tableData['ndd'];
					// End date
					$end_date = $nexDueDate;
					$items = array();	
					while (strtotime($date) <= strtotime($end_date)) {
						$caluculateDate = date("d/m/Y", strtotime($date));
						$date = date ("Y-m-d", strtotime("+1 month", strtotime($date)));
						if($caluculateDate)
						{	
							$items[] = $caluculateDate;
						}	
					}
			//var_dump($remainLoanEMI);			
			for($j=1; $j<=$remainLoanEMI; $j++)
			{			
?>

  <tr>
	 <td><?php echo $tableData['loanId']; ?></td>
		<td><?php  echo $tableData['applicantName']; ?> </td>
		<td><?php  echo $tableData['gurdianName']; ?></td>
		<td><?php  echo $tableData['address']; ?></td>
		<td><?php $areaId = $tableData['areaId']; 
			$queryBranch="SELECT * FROM areas where areaId='$areaId' and status='0' and deleted='0' ";
			$menuDatas=fetchData($queryBranch); 
			if(is_array($menuDatas) || is_object($menuDatas)) 
			{ 
				foreach($menuDatas as $branchData)
				{ 
					echo $branchData['areaName'];
				} 
			}	?> 
		</td>
		<td><?php  echo $tableData['memberMobile'];?></td>
		<td><?php $planId=$tableData['loanPlanId'];
			$planQuery="SELECT * FROM loanplan where id='$planId' and status='0' and deleted='0' ";
			$menuDatas=fetchData($planQuery);
			if(is_array($menuDatas) || is_object($menuDatas)) 
			{
				foreach($menuDatas as $branchData)
				{ 
					echo $branchData['planName']; 
				}
			}	
				?>
		</td>
		<td><?php $planId=$tableData['planTypeId'];
		$planQuerys="SELECT * FROM plantypes where id='$planId' and status='0' and deleted='0' ";
		$menuDatass=fetchData($planQuerys);
		if(is_array($menuDatass) || is_object($menuDatass)) 
		{
			foreach($menuDatass as $branchDataa)
			{ 
				echo $branchDataa['planName']; 
			}
		}	
		?>
		</td>
	<td> <?php if($items) { echo $items[$j-1]; }   ?></td>
	<td><?php  echo $tableData['emiNo']+$j; ?></td> 
	<td><?php echo $tableData['emi']; ?></td>
  </tr>
<?php } 
if($remainLoanEMI)
{	
?>
						<tr> 
						<th colspan="10" style="text-align:right;">Loan ID Total : </th>
						<th  style="text-align:center;"><?php echo $tableData['emi']*$remainLoanEMI;  ?></th>
						</tr>
<?php
}
} } }  ?>

					  </tbody>
                  </table>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            
            </div><!-- /.col -->
            
          </div><!-- /.row -->
          
          
        </section><!-- /.content -->
      </div>
<?php include("common/adminFooter.php");?>
