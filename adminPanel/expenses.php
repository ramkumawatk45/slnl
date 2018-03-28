<?php
include("controller/pages_controller.php");
$menuType = "expenses";
?>
<script type="text/javascript">
 function sortTableData()
 {
	$("#loading").addClass('hide'); 
	var pagePrintTitle = "Expenses List"	
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
				'pageLength',
			{
			extend: 'pdf',
			footer: true,
			title: pagePrintTitle,
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
				title:pagePrintTitle,
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
				title: pagePrintTitle,
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
				title: pagePrintTitle,
                exportOptions: {
                columns: ':visible',
				modifier: {
                    page: 'current'
                }
				}
            },
            'colvis'
        ],
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
           	
			expensesTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
			
			$( api.column( 4 ).footer() ).html(Math.round(expensesTotal,2));
    }
	});	
}
setTimeout(function()
{ 
	sortTableData(); 
}, 1500);
	if(($("#branchAccess").val() =="VIEW") || ($("#userAccess").val() =="VIEW"))
	{
		$("#addLoan").addClass("readWriteAccess");
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
		if(from_date != '' && to_date != '')  
		{  
		    $("#loading").removeClass('hide');
			 $.ajax({  
				  url:"ajaxExpenses.php",  
				  method:"GET",   
				  data: { 
					from_date: from_date, 
					to_date: to_date
				  },
				  success:function(data)  
				  { 
						var table = $('#example').DataTable();
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
            <li><b><a href="addExpenses.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Expenses </a></b></li>
          </ol>
        </section>	
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
			   
                <div class="box-header">
                  <h3 class="box-title">Expenses</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<div class="row">	
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
                  <table id="example" class="table table-bordered table-striped " cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th class="col-md-1">Sr. no.</th>
						<th class="col-md-3">Name</th>
						<th class="col-md-4">Remarks</th>
						<th class="col-md-2">Create Date</th>
                        <th class="col-md-1">Amount</th>
                        <th class="col-md-1">Edit</th>
                      </tr>
                    </thead>
					<tbody id="tableData">
                    <?php
					if($_SESSION['userType']=="ADMIN")
					{
						$query="SELECT * FROM income_expenses where type='Expenses' and deleted='0' order by id Desc LIMIT 20";
					}	
					$pageData=fetchData($query);
					if (is_array($pageData) || is_object($pageData))
					{
					$i=1;
					foreach($pageData as $tableData)
					{
					?>
                      <tr>
                         <td><?php echo  $i++; ?></td>
						<td><?php echo $tableData['name']; ?> </td>
						<td><?php echo $tableData['remarks']; ?> </td>
						<td><?php echo custumDateFormat($tableData['createDate']); ?> </td>								
						<td><?php echo $tableData['expensesAmount']; ?> </td>
                        <td><a href='editExpenses.php?id=<?php echo  $tableData['id'];?>'>Edit </a></td>
                      </tr>
                    <?php } } ?>
					  </tbody>
					<tfoot>
					  <tr>
                        <td class="col-md-1"></td>
                        <td class="col-md-3"></td>
                        <td class="col-md-4"></td>
						<td class="col-md-2">Total</td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
                      </tr>
					 </tfoot>
                  </table>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            
            </div><!-- /.col -->
            
          </div><!-- /.row -->
          
          
        </section><!-- /.content -->
      </div>
	  
<?php include("common/adminFooter.php");?>
