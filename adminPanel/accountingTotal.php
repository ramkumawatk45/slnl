<?php
include("controller/pages_controller.php");
$menuType = "gallery";
?> 
<script type="text/javascript">
/*$("#loading").removeClass('hide');
 $.ajax({    //create an ajax request to load_page.php
        type: "GET",
        url: "ajaxEMIREPORT.php", 
		async: true,	
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
            $("#tableData").html(response); 
			sortTableData();
            //alert(response);
        }
 });
 */
 function sortTableData()
 {
	$("#loading").addClass('hide');
    $('#accountingReport').DataTable({
        dom: 'Bfrtip',
        buttons: [
				'pageLength',
			{
			extend: 'pdf',
			footer: true,
			title: 'Accounting Report',
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
				title: 'Accounting Report',
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
				title: 'Accounting Report',
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
				title: 'Accounting Report',
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
            targets: -1,
            visible: true
        } ],
		lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 ', '25 ', '50 ', 'Show all' ]
        ],
		 "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            // Total over this page
           
			paymentTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			receivePaymentTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			pendingTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );	
            // Update footer
			$( api.column( 2 ).footer() ).html(paymentTotal);
			$( api.column( 3 ).footer() ).html(receivePaymentTotal);
			$( api.column( 4 ).footer() ).html(pendingTotal);
        }

    });
	
}

$(document).ready(function(){  
	var date_input=$('#from_date'); //our date input has the name "date"
	var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	date_input.datepicker({
	format: 'dd/mm/yyyy',
	container: container,
	todayHighlight: true,
	autoclose: true,
	maxDate: 0
	})
   var date_input=$('#to_date'); //our date input has the name "date"
	var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	date_input.datepicker({
	format: 'dd/mm/yyyy',
	container: container,
	todayHighlight: true,
	autoclose: true,
	maxDate: 0
	}) 
	sortTableData(); 
   
});  

</script>
<div class="content-wrapper">
        <!-- Main content -->
        <section class="content-header" id="addLoan">
          <h1>&nbsp;          </h1>
          <ol class="breadcrumb">
            <li><b><a href="addAccountingEntries.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Accounting Entry </a></b></li>
          </ol>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Accounting Total Report</h3>
                </div><!-- /.box-header -->
                <div class="box-body ">
				</div>	
                  <table id="accountingReport" class=" table table-bordered table-striped display responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Sr. no.</th>
                        <th>Branch Name</th>
						<th>Total collection</th>
						<th>Receive collection </th>
						<th>Pending collection</th>
                      </tr>
                    </thead>
					<tbody id="tableData">
					<?php 
						$query="SELECT * FROM branchs where deleted='0' and status='0' and branchCode !='0'";
						$menuData=fetchData($query);
						$i = 1;
						if(is_array($menuData) || is_object($menuData))
						{
						foreach($menuData as $tableData)
						{ ?>
						<tr>
                        <td><?php echo  $i++; ?></td>
						<td><?php  echo $tableData['branchName']." - ".$tableData['branchCode']; ?></td>
						<?php  
						$branchId = $tableData['branchId'];
						$query = "SELECT sum(totalPayment), sum(receivePayment), sum(pendingCollection) FROM accountings where branchId='$branchId'";
						$pagesData=fetchData($query);
						foreach($pagesData as $loanData)
						{
						?>	
						<td><?php echo $loanData['sum(totalPayment)']; ?></td>
						<td><?php echo $loanData['sum(receivePayment)']; ?></td>
						<td><?php echo $loanData['sum(pendingCollection)']; ?></td>
						<?php
						}
						?>
						
						
                      </tr>
					  <?php
						}
						}
					  ?>
					<tfoot>
					  <tr>
                        <td class="col-md-1"></td>
						<td class="col-md-1">Total</td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
                      </tr>
					  </tfoot>
					  </tbody>
					  
                  </table>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            
            </div><!-- /.col -->
            
          </div><!-- /.row -->
          
          
        </section><!-- /.content -->
      </div>
<?php include("common/webAdminFooter.php");?>
