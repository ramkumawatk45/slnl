<?php
include("controller/web_pages_controller.php");
$menuType = "menu";
?>
<div class="content-wrapper">
        <!-- Main content -->
        <section class="content-header">
          <h1>&nbsp;          </h1>
          <!--<ol class="breadcrumb">
            <li><b><a href="addMenu.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Main Menu</a></b></li>
          </ol>
          -->
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Main Menu Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="category" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr. no.</th>
                        <th>Menu Name</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <!--<th>Delete</th> !-->
                      </tr>
                    </thead>
                    <?php
					$query="SELECT * FROM main_menu where m_menu_deleted='0' ";
					$menuData=fetchData($query);
					$i=1;
					if (is_array($menuData) || is_object($menuData))
					{
					foreach($menuData as $tableData)
					{
					?>
                    <tbody>
                     <tr>
                         <td><?php echo  $i++; ?></td>
                        <td><?php echo $tableData['m_menu_name']; ?></td>
                        <td><?php $status=$tableData['m_menu_status']; if($status==0){ echo "Enabled"; } else{ echo "Disabled"; } ?></td>
                        <td><a href='editMenu.php?id=<?php echo  $tableData['m_menu_id']; ?>'>Edit </a></td>
                        </form>
                       <!-- <td><a  onClick="javascript: return confirm('Please confirm deletion');" href='deleteMenu.php?id=<?php echo  $tableData['m_menu_id']; ?>&url=<?php echo basename($_SERVER['PHP_SELF']) ?>' name="subDelete">Delete </a></td> -->
                      </tr>
                    </tbody>
                    <?php 
					}
					}
					?>
                  </table>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            
            </div><!-- /.col -->
            
          </div><!-- /.row -->
          
          
        </section>
        
      </div>
<?php include("common/adminFooter.php");?>
