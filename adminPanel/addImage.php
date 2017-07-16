<?php
include("controller/web_pages_controller.php");
$menuType =+"gallery";
$msg='';
if(isset($_REQUEST['addImages']))
{
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // valid extensions
$path = path; // upload directory

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
		$msg=inserted;
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
                      <label>Select Gallery</label>
                      <select class="form-control" name="galleryId" id="galleryId" required>
                      <option >Select Gallery</option>
                     <?php 
                    	$query="SELECT * FROM gallery where deleted='0' and status='0'";
					$menuData=fetchData($query);
					foreach($menuData as $tableData)
					{ ?><option value="<?php echo $tableData['galleryId']; ?>"><?php  echo $tableData['galleryName'] ?></option> <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="pageTitle"> Select Image </label>
                      <input type="file" class="form-control" id="file" name="image" required />
                                         
                    </div>
                    <div class="form-group">
                      <label for="pageTitle">Image Title</label>
                      <input type="text" class="form-control" id="imageTitle" name="imageTitle" placeholder="Image title" value=""  required />
                                         
                    </div>
            
                     <div class="form-group">
                      <label for="description">Image Description</label>
                      <input type="text" class="form-control" id="description" name="imagedescription" placeholder="Image Description" required/>
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
                    <button type="submit" class="btn btn-primary" name="addImages">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->



            </div><!--/.col (left) -->

          </div>   <!-- /.row -->
        </section>      
      </div>
      <!-- /.content-wrapper -->
<?php include("common/adminFooter.php");?>
