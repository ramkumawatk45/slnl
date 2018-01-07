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
    $('#emiReport').DataTable({
        dom: 'Bfrtip',
        buttons: [
				'pageLength',
			{
			extend: 'pdf',
			footer: true,
			title: 'EMI Collection Report',
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
				title: 'EMI Collection Report',
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
				title: 'EMI Collection Report',
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
				title: 'EMI Collection Report',
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
 
            // Total over all pages
            // latetotal = api
                // .column( 10 )
                // .data()
                // .reduce( function (a, b) {
                    // return intVal(a) + intVal(b);
                // }, 0 );
 
            // Total over this page
            latepageTotal = api
                .column( 10, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			emiTotal = api
                .column( 9, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );	
			serviceTotal = api
                .column( 11, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
			$( api.column( 9 ).footer() ).html(emiTotal);
            $( api.column( 10 ).footer() ).html(latepageTotal);
			$( api.column( 11 ).footer() ).html(serviceTotal);
			$("#totalOfPage").html(emiTotal+latepageTotal+serviceTotal)
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
		if(from_date != '' && to_date != '')  
		{  
		    $("#loading").removeClass('hide');
			 $.ajax({  
				  url:"ajaxEMIREPORTDATE.php",  
				  method:"GET",   
				  data: { 
					from_date: from_date, 
					to_date: to_date
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
      
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">EMI Collection  Report</h3>
                </div><!-- /.box-header -->
                <div class="box-body ">
				<div class="col-md-3 col-xs-3 col-sm-3">  
                     <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  
                </div>  
                <div class="col-md-3 col-xs-3 col-sm-3">  
                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />  
                </div>  
                <div class="col-md-5 col-xs-5 col-sm-5">  
                     <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />  
                </div>  
                  <table id="emiReport" class=" table table-bordered table-striped display responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Sr. no.</th>
                        <th>Loan Id</th>
						<th>Branch</th>
						<th>Customer Name</th>
						<th>Gurdian Name</th>
						<th>EMI NO</th>
						<th>Transction Id</th>
						<th>EMI Due Date</th>
						<th>EMI Paid Date</th>
                        <th>EMI(RS.)</th>
                        <th>Late Fees</th>
                        <th>Service charge</th> 
                      </tr>
                    </thead>
					<tbody id="tableData">
					
					<tfoot>
						<tr>
                        <td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-2">Sub Total</td>
                        <td></td>
                       <td></td>
                        <td></td>
                      </tr>
					  <tr>
                        <td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-1"></td>
						<td class="col-md-2">Total</td>
                        <td colspan="3" id="totalOfPage" align='center' style="color:red;"></td>
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
<?php include("common/adminFooter.php");?>
