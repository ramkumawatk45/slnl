<?php
include("controller/pages_controller.php");
$menuType = "gallery";
?> 
<script type="text/javascript">
 $("#loading").removeClass('hide');
 var date = new Date();
 var firstDay = new Date(1+"/"+date.getMonth()+"/"+date.getFullYear());
 var lastDay = new Date(0+"/"+date.getMonth()+1+"/"+date.getFullYear());
 var branchId = "All"
 $.ajax({  
	  url:"ajaxACCOUNTINGREPORT.php",  
	  method:"GET",   
	  data: { 
		from_date: firstDay, 
		to_date: lastDay,
		branchId:branchId 
		},
	  success:function(data)  
	  { 
			var table = $('#emiReport').DataTable();
			table.destroy();
			$('#tableData').empty(); 
			$("#tableData").html(data); 
			setTimeout(function(){sortTableData();},5000); 
	  }  
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
            shriLifeTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			loanTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );	
			mfTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			paymentTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			receivePaymentTotal = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			pendingTotal = api
                .column( 8, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );	
            // Update footer
			$( api.column( 3 ).footer() ).html(shriLifeTotal);
			$( api.column( 4 ).footer() ).html(loanTotal);
			$( api.column( 5 ).footer() ).html(mfTotal);
			$( api.column( 6 ).footer() ).html(paymentTotal);
			$( api.column( 7 ).footer() ).html(receivePaymentTotal);
			$( api.column( 8 ).footer() ).html(pendingTotal);
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
   $('#filter').click(function(){  
		var from_date = $('#from_date').val();  
		var to_date = $('#to_date').val();  
		var branchId = $('#branchId').val();  
		if(branchId != '' && from_date != '' && to_date != '')  
		{  
		    $("#loading").removeClass('hide');
			 $.ajax({  
				  url:"ajaxACCOUNTINGREPORT.php",  
				  method:"GET",   
				  data: { 
					from_date: from_date, 
					to_date: to_date,
					branchId:branchId
				  },
				  success:function(data)  
				  { 
						var table = $('#emiReport').DataTable();
						table.destroy();
						 $('#tableData').empty(); 
						$("#tableData").html(data); 
						sortTableData();  
				  }  
			 });  
		} 
		else if(branchId != '' && from_date == '' && to_date == '')
		{
			 $("#loading").removeClass('hide');
			 $.ajax({  
				  url:"ajaxACCOUNTINGREPORT.php",  
				  method:"GET",   
				  data: { 
					from_date: from_date, 
					to_date: to_date,
					branchId:branchId
				  },
				  success:function(data)  
				  { 
						var table = $('#emiReport').DataTable();
						table.destroy();
						 $('#tableData').empty(); 
						$("#tableData").html(data); 
						sortTableData();  
				  }  
			 });  
			
		}	
		else  
		{  
			 alert("Please Select Date");  
		}  
   });  
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
                  <h3 class="box-title">Accounting  Report</h3>
                </div><!-- /.box-header -->
                <div class="box-body ">
				<div class="row">
					<div class="col-md-3 col-xs-3 col-sm-3">  
						<select class="form-control" name="branchId" id="branchId" <?php if($_SESSION['branchCode']){echo "disabled";} ?>>
						<option value="All">All</option> 
							<?php 
							$query="SELECT * FROM branchs where deleted='0' and status='0' and branchCode !='0'";
							$menuData=fetchData($query);
							foreach($menuData as $tableData)
							{ ?><option   <?php if($_SESSION['branchCode'] ==$tableData['branchCode']){echo "selected";} ?> value="<?php echo $tableData['branchId']; ?>"><?php  echo $tableData['branchName']." - ".$tableData['branchCode'] ?></option>	<?php } ?>
						</select>
					</div>	
					<div class="col-md-3 col-xs-3 col-sm-3">  
						 <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  
					</div>  
					<div class="col-md-3 col-xs-3 col-sm-3">  
						 <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />  
					</div>  
					<div class="col-md-2 col-xs-2 col-sm-2">  
						 <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />  
					</div> 
				</div>	
                  <table id="emiReport" class=" table table-bordered table-striped display responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Sr. no.</th>
                        <th>Date</th>
						<th>Branch</th>
						<th>Shri Life</th>
						<th>Loan </th>
						<th>MF</th>
						<th>Total payment</th>
						<th>Receive payment </th>
						<th>Pending collection</th>
						<?php if($_SESSION['userType']=="ADMIN") { ?>
						<th>Edit</th>
						<?php } ?>
                      </tr>
                    </thead>
					<tbody id="tableData">
					
					<tfoot>
					  <tr>
                        <td class="col-md-1"></td>
                        <td class="col-md-1"></td>
						<td class="col-md-1">Total</td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<?php if($_SESSION['userType']=="ADMIN") { ?>
						<td class="col-md-1"></td>
						<?php } ?>
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
