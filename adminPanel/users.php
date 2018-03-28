<?php
include("controller/pages_controller.php");
$menuType = "users";
?>
<script src="js/jquery.min.js"></script>   
<script type="text/javascript">
$(document).ready(function() 	
{
	if(($("#branchAccess").val() =="VIEW") || ($("#userAccess").val() =="VIEW"))
	{
		$("#users").addClass("readWriteAccess");
	}
});	
</script>
<div class="content-wrapper" id="users">
        <!-- Main content -->
        <section class="content-header">
          <h1>&nbsp;          </h1>
		  <?php 
			if($_SESSION['moduleRole']=="GLOBAL")
			{ 
			?>
			  <ol class="breadcrumb">
				<li><b><a href="addUser.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add User</a></b></li>
			  </ol>
		  <?php 
			}
			?>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">User Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="category" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="col-md-1">Sr. no.</th>
                        <th class="col-md-2">User Name</th>
						<th class="col-md-2">User Role</th>
						<th class="col-md-2">User Access</th>
                        <th class="col-md-1">Status</th>
						<?php 
						if($_SESSION['moduleRole']=="GLOBAL")
						{ 
						?>
							<th class="col-md-1">Edit</th>
							<th class="col-md-1">Delete</th>
						<?php
						}
						?>	
                      </tr>
                    </thead>
					<tbody>
                     <?php
					$query="SELECT * FROM user where deleted='0' ";
					$pageData=fetchData($query);
					if (is_array($pageData) || is_object($pageData))
					{
					$i=1;
					foreach($pageData as $tableData)
					{
					?>
                      <tr>
                        <td><?php echo  $i++; ?></td>
                        <td><?php echo $tableData['username']; ?></td>
						<td><?php echo $tableData['usertype']; ?></td>
						<td><?php echo $tableData['userAccess']; ?></td>
                        <td><?php $status=$tableData['status']; if($status==0){ echo "Enabled"; } else{ echo "Disabled"; } ?></td>
						<?php 
						if($_SESSION['moduleRole']=="GLOBAL")
						{ 
						?>
						<td><a href='editUser.php?id=<?php echo  $tableData['id'];?>'>Edit </a> </td>
                        <td> <?php if($tableData['username'] !="slnl") { ?> <a  onClick="javascript: return confirm('Please confirm deletion');" href='deleteUser.php?id=<?php echo  $tableData['id']; ?>&url=<?php echo basename($_SERVER['PHP_SELF']) ?>' name="subDelete">Delete</a> <?php } ?></td> 
						<?php 
						}
						?>
                      </tr>
                    <?php } } ?>
				   </tbody>	
                  </table>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            
            </div><!-- /.col -->
            
          </div><!-- /.row -->
          
          
        </section><!-- /.content -->
      </div>
<?php include("common/adminFooter.php");?>
