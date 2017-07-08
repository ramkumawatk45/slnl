<?php
include("controller/web_pages_controller.php");
$menuType = "viewPages";
?>
<div class="content-wrapper">
        <!-- Main content -->
        <section class="content-header">
          <h1>&nbsp;          </h1>
          
          <ol class="breadcrumb">
            <li><b><a href="addPlan.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New Plan</a></b></li>
          </ol>
         
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Plans Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="category" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr. no.</th>
                        <th>Section Headings </th>
                        <th>Menu Name</th>
                        <th>Status</th>
                        <th>Edit</th>
                       <!-- <th>Delete</th> -->
                      </tr>
                    </thead>
                     <?php
					$query="SELECT * FROM pages where deleted='0' ";
					$pageData=fetchData($query);
					if (is_array($pageData) || is_object($pageData))
					{
					$i=1;
					foreach($pageData as $tableData)
					{
					?>
                    <tbody>
                      <tr>
                         <td><?php echo  $i++; ?></td>
                        <td><?php echo $tableData['pageTitle']; ?></td>
                        <td><?php  $menuid=$tableData['m_menu_Id'];
                    $query="SELECT * FROM main_menu where m_menu_id='$menuid'";
					$menuData=fetchData($query);
					foreach($menuData as $menuDatas)
					{ echo $menuDatas['m_menu_name']; }?> </td>
                        
                       <td><?php $status=$tableData['status']; if($status==0){ echo "Enabled"; } else{ echo "Disabled"; } ?></td>
                       <td><a href='editPlan.php?id=<?php echo  $tableData['pageId'];?>&parentId=<?php echo $tableData['m_menu_Id'];  ?>'>Edit </a></td>
                        <!--<td><a  onClick="javascript: return confirm('Please confirm deletion');" href='deletePage.php?id=<?php echo  $tableData['pageId']; ?>&url=<?php echo basename($_SERVER['PHP_SELF']) ?>' name="subDelete">Delete</a></td> -->
                      </tr>
                    </tbody>
                    <?php } } ?>
                  </table>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            
            </div><!-- /.col -->
            
          </div><!-- /.row -->
          
          
        </section><!-- /.content -->
      </div>
<?php include("common/adminFooter.php");?>
