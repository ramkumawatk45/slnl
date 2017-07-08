<?php
include("controller/web_pages_controller.php");
$menuType =+"viewPages";
$msg='';
if(isset($_REQUEST['addPages']))
{
	$menuId = $_REQUEST['menuId'];
	$pageTitle = $_REQUEST['pageTitle'];
	$pageSubTitle = $_REQUEST['pageSubTitle'];
	$pageDescription = $_REQUEST['pageDescription'];
	$sql=mysql_query("INSERT INTO pages(pageTitle,pageSubTitle,pageDescription,m_menu_Id) VALUES('$pageTitle','$pageSubTitle','$pageDescription','$menuId')");
	$msg=inserted;
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
                  <h3 class="box-title">Plan Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"  action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label>Select Menu</label>
                      <select class="form-control" name="menuId" id="categoryId" required>
                      <option value="0" >Select Menu</option>
                     <?php 
                    $query="SELECT * FROM main_menu where m_menu_deleted='0' and m_menu_status='0' and m_menu_name='Deposit Plan' or m_menu_name='Loan Plan' ";
					$menuData=fetchData($query);
					foreach($menuData as $tableData)
					{ ?><option value="<?php echo $tableData['m_menu_id']; ?>"><?php  echo $tableData['m_menu_name'] ?></option> <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="pageTitle">Section Heading </label>
                      <input type="text" class="form-control" id="pageTitle" name="pageTitle" placeholder="Section Heading" maxlength="200"  required />                  
                    </div>
					<div class="form-group">
                      <label for="pageTitle">Section Sub Heading </label>
                     <textarea class="form-control" style="height:60px !important;" id="pageSubTitle" name="pageSubTitle" placeholder="Section Sub Heading" maxlength="2000"></textarea>
                    </div>
                <div class="box-body pad">
                <label>Section Description</label>
                    <textarea id="editor1" name="pageDescription" class="form-control" rows="5" cols="80" >
                                          
                    </textarea>
                </div>
					<!--<div class="form-group">
                      <label>Status</label>
                      <select class="form-control" name="status">
                      <option value="0">Enabled </option>
                      <option value="1" >Disabled</option>
                      </select>
                    </div>-->
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="addPages">Submit</button>
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
