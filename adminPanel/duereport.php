<?php
include("controller/pages_controller.php");
$menuType = "dueReport";
?>
<script type="text/javascript">
$("#loading").removeClass('hide');
 $.ajax({    //create an ajax request to load_page.php
        type: "GET",
        url: "ajaxDueReport.php",             
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
            $("#tableData").html(response); 
			sortTableData();
            //alert(response);
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
                        <th>Sr. no.</th>
                        <th>Loan Id</th>
						<th>Branch</th>
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

					  </tbody>
                  </table>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            
            </div><!-- /.col -->
            
          </div><!-- /.row -->
          
          
        </section><!-- /.content -->
      </div>
<?php include("common/adminFooter.php");?>
