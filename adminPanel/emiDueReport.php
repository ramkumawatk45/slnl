<?php
include("controller/pages_controller.php");
$menuType = "emiDueReport";
?> 
<script type="text/javascript">
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
			title: 'All EMI Due Report',
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
				title: 'All EMI Due Report',
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
				title: 'All EMI Due Report',
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
				title: 'All EMI Due Report',
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
				  url:"ajaxEmiDueReport.php",  
				  method:"GET",   
				  data: { 
					from_date: from_date, 
					to_date: to_date
				  },
				  success:function(data)  
				  { 
					console.log(data);
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
                  <h3 class="box-title">EMI Detail Due  Report</h3>
                </div><!-- /.box-header -->
                <div class="box-body ">
				<div class="col-md-3">  
                     <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  
                </div>  
                <div class="col-md-3">  
                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />  
                </div>  
                <div class="col-md-5">  
                     <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />  
                </div>  
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
						<th>Remain Total(RS.)</th>
                      </tr>
                    </thead>
					<tbody id="tableData">
					
					
					  </tbody>
					  
                  </table>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            
            </div><!-- /.col -->
            
          </div><!-- /.row -->
          
          
        </section><!-- /.content -->
      </div>
<?php include("common/adminFooter.php");?>