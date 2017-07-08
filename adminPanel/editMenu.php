<?php
include("controller/web_pages_controller.php");
$menuType =+"menu";
$msg='';
$id=$_REQUEST['id'];
if(isset($_REQUEST['editMenu']))
{
	$menu_name = trim($_REQUEST['menuName']);
	$metaTag = $_REQUEST['metaTag'];
	$keyWord = $_REQUEST['keyWord'];
	$description = $_REQUEST['description'];	
	$status = $_REQUEST['status'];
	$sql=mysql_query("UPDATE main_menu set m_menu_name='$menu_name',m_menu_status='$status',metaTitle='$metaTag',metaDescription='$description',metaKeywords='$keyWord' where m_menu_id='$id'");
	$msg=updated;
	$pageHrefLink="viewMenu.php";
}
?>
      <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Main Menu Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                  <form role="form"  action="<?php echo $_SERVER['PHP_SELF'].'?id='.$id;?>" method="post" enctype="multipart/form-data">
                 <?php
					$query=mysql_query("SELECT * FROM main_menu where m_menu_id='$id' ");
					while($tableData=mysql_fetch_array($query))
					{
					?>
              
                  <div class="box-body">
                        <div class="form-group">
                        <label for="pageTitle">Menu Name</label>
                        <input type="text" class="form-control" id="menuName" name="menuName"  value="<?php echo $tableData['m_menu_name']; ?>" required />                   
                        </div>
                        <div class="form-group">
                      <label for="metaTag">SEO Title</label>
                      <textarea   rows="5" cols="80" class="form-control" id="metaTag" name="metaTag"><?php echo $tableData['metaTitle']; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                      <label for="keyWord">Meta Keyword</label>
                      <textarea   rows="5" cols="80" class="form-control" id="keyWord" name="keyWord"><?php echo $tableData['metaKeywords']; ?></textarea>
                    </div>
                     <div class="form-group">
                      <label for="keyWord">Meta Description</label>
                      <textarea   rows="5" cols="80" class="form-control" id="description" name="description"><?php echo $tableData['metaDescription']; ?></textarea>
                    </div>

                        <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                        <?php $status=$tableData['m_menu_status']; echo $status;
                        ?>
                        <option value="0"<?php if($status ==0) echo 'selected'; ?>>Enabled</option>
                        <option value="1"<?php if( $status == 1) echo 'selected'; ?>>Disabled</option>
                        
                        </select>
                        </div>
                        </div><!-- /.box-body -->
                        
                        <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="editMenu">Update</button>
                        </div>
                        </form>
                        <?php 
                        }
                        ?>
                        </div><!-- /.box -->
            	</div><!--/.col (left) -->
          </div>   <!-- /.row -->
        </section>            
</div>
      <!-- /.content-wrapper -->
<?php include("common/adminFooter.php");?>
<script>
CKEDITOR.replace('editor1', {
"filebrowserImageUploadUrl": "<?php echo BaseUrl;?>admin/plugins/ckeditor/plugins/imgupload.php",
"filebrowserBrowseUrl": "<?php echo BaseUrl;?>admin/plugins/ckeditor/plugins/imgupload.php",
"filebrowserUploadUrl": "<?php echo BaseUrl;?>admin/plugins/ckeditor/plugins/imgupload.php"
});

    </script>
