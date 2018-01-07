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
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- jvectormap -->
   
    <!-- Bootstrap WYSIHTML5 -->
  
      <script type="text/javascript"  src="js/jquery-1.12.4.js"></script> 
     <script type="text/javascript"  src="js/jquery.dataTables.min.js"></script> 
     <script type="text/javascript"  src="js/dataTables.buttons.min.js"></script> 
	   <script type="text/javascript"  src="js/dataTables.responsive.min.js"></script> 
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
var menuType = "<?php echo $menuType ?>";
$("."+menuType).addClass("active");
</script>
<?php
 if($msg){?>
<script>
alert("<?php echo $msg ?>");
window.location.href = "<?php echo $pageHrefLink?>";
</script>
<?php
}
?>
<?php ob_end_flush(); ?>

