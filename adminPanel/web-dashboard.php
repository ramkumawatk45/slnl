<?php
include("controller/web_pages_controller.php");
?>
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>         
         </section>
        <!-- Main content -->
                <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Logo  Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="category" class="table table-bordered table-striped">
                  <thead>
                  <th>Logo Image </th><th>Logo Title </th> <th>WebSite Title </th> <!--<th>Status </th> --><th> Action </th>
                  </thead>
                    <?php
					$query="SELECT * FROM logo  ";
					$menuData=fetchData($query);
					if (is_array($menuData) || is_object($menuData))
					{
					foreach($menuData as $tableData)
					{
					?>
                    <tbody>
                     <tr>
                        <td><img src="<?php echo $tableData['logo_Location']; ?>" style="width:50px; height:50px;" /></td>
                        <td><?php echo $tableData['logo_Title']; ?></td>
                        <td><?php echo $tableData['site_Title']; ?></td>
						<!--<td><?php $status=$tableData['status']; if($status==0){ echo "Enabled"; } else{ echo "Disabled"; } ?></td>-->                        
						<td><a href='editLogo.php?id=<?php echo  $tableData['id']; ?>'>Edit </a></td>
                        </form>
                       <!-- <td><a  onClick="javascript: return confirm('Please confirm deletion');" href='deleteMenu.php?id=<?php echo  $tableData['m_menu_id']; ?>&url=<?php echo basename($_SERVER['PHP_SELF']) ?>' name="subDelete">Delete </a></td> -->
                      </tr>
                    </tbody>
                    <?php 
					} }
					?>
                  </table>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            
            </div><!-- /.col -->
            
          </div><!-- /.row -->
          
          
        </section>
        
<!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
<?php include("common/adminFooter.php");?>
