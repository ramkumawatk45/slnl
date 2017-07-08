<?php
include("controller/web_pages_controller.php");
$menuType =+"viewPages";
$id=$_REQUEST['id'];
$parentId=$_REQUEST['parentId'];
$msg='';
if(isset($_REQUEST['addPages']))
{
	$menuId = $_REQUEST['menuId'];
	$pageTitle = $_REQUEST['pageTitle'];
	$pageSubTitle = $_REQUEST['pageSubTitle'];
	$pageDescription = $_REQUEST['pageDescription'];
	$status = $_REQUEST['status'];
	$sql=mysql_query("update pages set pageTitle='$pageTitle',pageSubTitle='$pageSubTitle',pageDescription='$pageDescription', status='$status',s_menu_id='$menuId',m_menu_Id='$menuId' where pageId='$id'");
	$msg=updated;
	$pageHrefLink="viewPlans.php";
}
?>
<script src="plugins/ckeditor/ckeditor.js"></script>
      <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">  
	<section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Section Details</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"  action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                	<?php $query="SELECT * FROM pages where pageId='$id' and m_menu_Id='$parentId'";
					$pagesData=fetchData($query);
					foreach($pagesData as $pageData)
					?>
                  <div class="box-body">
                    <div class="form-group">
                      <label>Select Menu</label>
                      <select class="form-control" name="menuId" id="categoryId" required>
                     <?php 
                    	$query="SELECT * FROM main_menu where m_menu_deleted='0' and m_menu_status='0' and m_menu_name='Deposit Plan' or m_menu_name='Loan Plan' ";
						$menuData=fetchData($query);
						foreach($menuData as $tableData)
						{ ?><option value="<?php echo $tableData['m_menu_id']; ?>"<?php if($tableData['m_menu_id']==$parentId)echo "selected"; ?>><?php  echo $tableData['m_menu_name'] ?></option>			<?php } ?>
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label for="pageTitle">Section Heading </label>
                      <input type="text" class="form-control" id="pageTitle" name="pageTitle"value="<?php echo $pageData['pageTitle']; ?>"  required />                 
                    </div>
					<div class="box-body pad">
                      <label for="pageTitle">Section Sub Heading </label>
                      <textarea class="form-control" style="height:60px !important;" id="pageSubTitle" name="pageSubTitle"placeholder="Section Sub Heading" maxlength="2000" rows="5" cols="80" ><?php echo $pageData['pageSubTitle']; ?></textarea>               
                    </div>
					<div class="box-body pad">
					<label>Section description</label>
						<textarea id="editor1" class="form-control" name="pageDescription" rows="5" cols="80"><?php echo $pageData['pageDescription']; ?></textarea>
					</div>
                    

                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" name="status">
                      <?php $status=$pageData['status'];
					   ?>
					  <option value="0"<?php if($status ==0) echo 'selected'; ?>>Enabled</option>
    				<option value="1"<?php if( $status == 1) echo 'selected'; ?>>Disabled</option>
                      </select>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="addPages">Update</button>
                  </div>
                </form>
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
