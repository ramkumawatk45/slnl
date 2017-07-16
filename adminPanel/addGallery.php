<?php
include("controller/web_pages_controller.php");
$menuType =+"gallery";
$msg='';
if(isset($_REQUEST['addGallery']))
{
	 $galleryName = trim($_REQUEST['galleryName']);
	 $pageId = $_REQUEST['pageId'];	
	 $status = $_REQUEST['status'];
	 $sql = "select galleryName from gallery where galleryName='$galleryName'";
	 $res = mysql_query($sql);
		if(mysql_num_rows($res))
		{
		$msg="Gallery Already created.";
		}
		else
		{
		$sql=mysql_query("INSERT INTO gallery(pageId,galleryName,status) VALUES('$pageId','$galleryName','$status')");
		$msg="Data Sucessfully Submited";
		}
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
                  		<h3 class="box-title">Gallery Detail</h3>
                	</div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
                 <div class="box-body">
                        <div class="form-group">
                        <label>Select Page</label>
                        <select class="form-control" name="pageId" id="pageId" required>
                        <option>Select Page</option>
                        <?php 
                        $query="SELECT * FROM pages where deleted='0' and status='0'";
                        $pagesData=fetchData($query);
                        foreach($pagesData as $pageData)
                        { ?><option value="<?php echo $pageData['pageId']; ?>"><?php  echo $pageData['pageName'] ?></option> <?php } ?>
                        </select>
                        </div>
                        <div class="form-group">
                        <label for="pageTitle">Gallery Name</label>
                        <input type="text" class="form-control" id="galleryName" name="galleryName" placeholder="Gallery Name" required />                   
                        </div>
                        <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                        <option value="0">Enabled </option>
                        <option value="1" >Disabled</option>
                        </select>
                        </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="addGallery">Submit</button>
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
