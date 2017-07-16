<?php
include("controller/web_pages_controller.php");
$menuType =+"gallery";
$id=$_REQUEST['id'];
$msg='';
if(isset($_REQUEST['addImages']))
{
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // valid extensions
$path =path; // upload directory

	$img = $_FILES['image']['name'];
	$tmp = $_FILES['image']['tmp_name'];
	$galleryId = $_REQUEST['galleryId'];
	$imageTitle = $_REQUEST['imageTitle'];
	$imagedescription = $_REQUEST['imagedescription'];
	$status = $_REQUEST['status'];		
	// get uploaded file's extension
	$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
	
	// can upload same image using rand function
	$final_image = rand(1000,1000000).$img;
	
	// check's valid format
	if(in_array($ext, $valid_extensions)) 
	{					
		$path = $path.strtolower($final_image);	
			$sql=mysql_query("INSERT INTO galleryimages(galleryId,imgTitle,location,imgname,imgDescription,status) VALUES('$galleryId','$imageTitle','$path','$final_image','$imagedescription','$status')");
		move_uploaded_file($tmp,$path); 
		$msg="Data Sucessfully Submited";
		$pageHrefLink="editImages.php?id=$galleryId";
		
	} 
	else 
	{
		echo 'invalid';
	}
	
	
}
?>
      <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="content-header">
          <h1>&nbsp;          </h1>
 			<ol class="breadcrumb">
             <!--<li><b><a href="addGallery.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add  Gallery</a></b></li> -->
            <li><b><a href="addImage.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Image In Gallery</a></b></li>
          </ol>
          </section>
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
                     <form role="form"  action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label>Gallery Name</label>
                      <select class="form-control" name="galleryId" id="galleryId" disabled>
                     <?php 
                    	$query="SELECT * FROM gallery where deleted='0' and status='0' and galleryId='$id'";
					$menuData=fetchData($query);
					foreach($menuData as $tableData)
					{ ?><option value="<?php echo $tableData['galleryId']; ?>"><?php  echo $tableData['galleryName'] ?></option> <?php } ?>
                      </select>
                    </div>                          
                         <div id="preview"> 
                        <?php $myquery="SELECT * FROM galleryimages where deleted='0'  and galleryId='$id'";
                            $imageData=fetchData($myquery);
                            foreach($imageData as $imagessData)
                            {
                        ?>	
                            <div class="photo-select">
                            <center>
                            <span  class="titlespan" ><?php echo $imagessData['imgTitle']; ?> </span>
							<a href="<?php echo $imagessData['location']; ?>" target="_blank">
                            <img src="<?php echo $imagessData['location']; ?>" />
							</a>
                            <a href="editImage.php<?php echo '?id='.$imagessData['imgId'].'&galleryId='.$imagessData['galleryId']; ?>" class="btn-edit-photos">Edit</a>
                            <a onClick="javascript: return confirm('Please confirm deletion');"href='deleteImage.php?id=<?php echo  $imagessData['imgId']; ?>&url=<?php echo basename($_SERVER['PHP_SELF']) ?>&galleryId=<?php echo $imagessData['galleryId']?>' class="btn-delete-photos">Delete</a>
                            </center>  
                             <span style="float:left; padding-left:25px;" ><strong>STATUS</strong> : <?php $status=$imagessData['status']; if($status ==0){echo 'Enabled';} else {echo 'Disabled'; } ?> </span>                 
                            </div>	                                
                        <?php 
                            }
                            ?>
                            </div>
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
