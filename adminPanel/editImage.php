<?php
include("controller/web_pages_controller.php");
$menuType =+"gallery";
$id=$_REQUEST['id'];
$galleryId=$_REQUEST['galleryId'];
$msg='';
if(isset($_REQUEST['editImage']))
{
		$path =path; // upload directory
		$img = $_FILES['image']['name'];
		$tmp = $_FILES['image']['tmp_name'];		
		// get uploaded file's extension
		$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
		// can upload same image using rand functio
		$final_image = rand(1000,1000000).$img;		
		// check's valid format		
		$galleryId = $_REQUEST['galleryId'];
		$imageTitle = $_REQUEST['imageTitle'];
		$imagedescription = $_REQUEST['imagedescription'];
		$status = $_REQUEST['status'];	
		if(empty($img))
		{
			$path=$_REQUEST['exitImage'];
		}
		else
		{
			$path = $path.strtolower($final_image);
		}
			$sql=mysql_query("update galleryimages set imgTitle='$imageTitle',location='$path',imgDescription='$imagedescription',status='$status' where imgId='$id'");
			move_uploaded_file($tmp,$path); 
			$msg=updated;
			$pageHrefLink="editImages.php?id=$galleryId";
	
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
                  <h3 class="box-title">Image Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                     <form role="form"  action="<?php echo  $_SERVER['PHP_SELF'].'?id='.$id.'&galleryId='.$galleryId;?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label>Gallery Name </label>
                      <select class="form-control" name="galleryId" id="galleryId" disabled>
						 <?php 
                        $query="SELECT * FROM gallery where deleted='0' and status='0' and galleryId='$galleryId'";
                        $menuData=fetchData($query);
                        foreach($menuData as $tableData)
                        { ?><option value="<?php echo $tableData['galleryId']; ?>"><?php  echo $tableData['galleryName'] ?></option> <?php } ?>
                      </select>
                    </div>
                     <?php $query="SELECT * FROM galleryimages where deleted='0' and imgId='$id' ";
					$imageData=fetchData($query);
					foreach($imageData as $imagesData)
					{
				?>	
                    <div class="form-group">
                    <div class="photo-select">
                        <center>
                        <span  class="titlespan" > <b>Existing Image </b> </span>
						<a href="<?php echo $imagesData['location']; ?>" target="_blank">
                        <img src="<?php echo $imagesData['location']; ?>" /> <input type="hidden" name="exitImage" value="<?php echo $imagesData['location'] ?>">
                        </center>
						</a>
                        </div>
                         <input type="file" class="form-control" id="file" name="image"  />
                                     
                     </div>
                    <div class="form-group">
                      <label for="pageTitle">Image Title</label>
                      <input type="text" class="form-control" id="imageTitle" name="imageTitle"  value="<?php echo $imagesData['imgTitle']; ?>"  />
                                         
                    </div>
            
                     <div class="form-group">
                      <label for="description">Image Description</label>
                      <textarea class="form-control" id="description" name="imagedescription"/><?php echo $imagesData['imgDescription']; ?></textarea>
                    </div>
					<div class="form-group">
                      <label>Status</label>
                      <select class="form-control" name="status">
                       <?php $status=$imagesData['status'];
					   ?>
					  <option value="0"<?php if($status ==0) echo 'selected'; ?>>Enabled</option>
    				<option value="1"<?php if( $status == 1) echo 'selected'; ?>>Disabled</option>
                      </select>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="editImage">Update</button>
                  </div>
                </form>
              </div><!-- /.box -->
              <?php } ?>
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
