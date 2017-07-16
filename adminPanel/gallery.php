<?php
include("controller/web_pages_controller.php");
$menuType = "gallery";
?>
<div class="content-wrapper">
        <!-- Main content -->
        <section class="content-header">
          <h1>&nbsp;          </h1>
          <!--
          <ol class="breadcrumb">
             <li><b><a href="addGallery.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add  Gallery</a></b></li>
            <li><b><a href="addImage.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Image In Gallery</a></b></li>
          </ol>
          -->
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Gallery</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="category" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr. no.</th>
                        <th>Gallary Name</th>
                        <th>Status</th>
                        <th>View / Edit</th>
                        <!--<th>Delete</th> -->
                      </tr>
                    </thead>
                     <?php
					$query="SELECT * FROM gallery where deleted='0' ";
					$pageData=fetchData($query);
					$i=1;
					foreach($pageData as $tableData)
					{
					?>
                    <tbody>
                      <tr>
                         <td><?php echo  $i++; ?></td>
                        <td><?php echo $tableData['galleryName']; ?></td>
                        <td><?php $status=$tableData['status']; if($status==0){ echo "Enabled"; } else{ echo "Disabled"; } ?></td>
                        <td><a href='editImages.php?id=<?php echo  $tableData['galleryId'];?>'>View / Edit </a></td>
                        <!--<td><a  onClick="javascript: return confirm('Please confirm deletion');" href='deleteGallery.php?id=<?php echo  $tableData['galleryId']; ?>&url=<?php echo basename($_SERVER['PHP_SELF']) ?>' name="subDelete">Delete</a></td> -->
                      </tr>
                    </tbody>
                    <?php } ?>
                  </table>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            
            </div><!-- /.col -->
            
          </div><!-- /.row -->
          
          
        </section><!-- /.content -->
      </div>
<?php include("common/adminFooter.php");?>
