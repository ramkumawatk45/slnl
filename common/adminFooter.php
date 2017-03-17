<style>
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>
<!-- Modal -->
     <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- jvectormap -->
	<script type="text/javascript" src="<?php echo BaseUrl;?>admin/bootstrap/js/moment.js"></script>
   
    <!-- Bootstrap WYSIHTML5 -->
  
      <script type="text/javascript"  src="js/jquery-1.12.4.js"></script> 
     <script type="text/javascript"  src="js/jquery.dataTables.min.js"></script> 
     <script type="text/javascript"  src="js/dataTables.buttons.min.js"></script> 
     <script type="text/javascript"  src="js/buttons.flash.min.js"></script> 
     <script type="text/javascript"  src="js/jszip.min.js"></script> 
     <script type="text/javascript"  src="js/buttons.html5.min.js"></script> 
     <script type="text/javascript"  src="js/buttons.print.min.js"></script> 
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	 <script type="text/javascript"  src="js/dataTables.bootstrap.min.js"></script>
	 <script type="text/javascript" src="js/pdfmake.min.js"></script>
	<script type="text/javascript" src="js/vfs_fonts.js"></script> 
	<script type="text/javascript"  src="js/buttons.colVis.min.js"></script> 
	<script type="text/javascript"  src="js/sum().js"></script> 	
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
  
  </body>
</html>
<script>
<?php
  if(!$studentLogin)
  {?>
$("ul.treeview-menu li").removeClass("active");
$("li.<?php echo $menuType; ?>").addClass("active");
<?php
}
else
{
	if($menuType !="viewNotes")
	{
		header("location:logout.php");
		
	}
}
?>
$("a.delete").click(function()
{
	var response = confirm("Do you really want to delete this ?");
	if(response)
	{
		var url = $(this).attr("data").split("=");
		var ele = $(this).parent().parent();
		var fieldName = url[0];
		var value = url[1];
		var tableName = url[2];
					$.ajax({
					url: "delete.php",
					data:"tableName="+tableName+"&value="+value+"&fieldName="+fieldName,
					type:"POST",
					success: function(result){
						if(result !="")
						{
							location.reload();
						}
						else
						{
							$(ele).hide();
						}
    				}
						
					});
	}
	
});

function isTop(elem)
{
    if (elem.checked)
    {
    $("#parentCategory").attr("disabled","disabled");

    }
    else
    {
    $("#parentCategory").removeAttr("disabled");
    }
}
</script>

<?php if($msg){?>
<script>
alert("<?php echo $msg ?>");
window.location.href = "<?php echo $pageHrefLink?>";
</script>
<?php
}
 if($edit ==true){?>
<script>
var parent = "<?php echo $parentId;?>";
console.log( parent );
if(parent > 0)
{
console.log( parent );
$("#parentCategory").val(parent);
}
else
{
	$("#parentCategory").attr("disabled","disabled");
	document.getElementById("top").checked = true;
}
</script>
<?php
}
?>
<?php ob_end_flush(); ?>

