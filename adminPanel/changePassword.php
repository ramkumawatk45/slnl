<?php 
 include("controller/pages_controller.php");
$menuType = "";
$username=$_SESSION['login_user'];

?>
<!-- Content Wrapper. Contains page content -->
<?php 
if(isset($_POST['changePassword']))
		{
		$old_pass=md5($_POST['opassword']);
		$new_pass=md5($_POST['password']);
		$re_pass=md5($_POST['rPassword']);
		$chg_pwd=mysql_query("select * from user where username='$username'");
		while($chg_pwd1=mysql_fetch_array($chg_pwd))
		{
		$data_pwd=$chg_pwd1['password'];
		}
		if($data_pwd==$old_pass){
		if($new_pass==$re_pass){
			$update_pwd=mysql_query("update user set password='$new_pass' where username='$username'");
			echo "<script>alert('Your Password Update Sucessfully.Please Login Again'); window.location='logout.php';</script>";
		}
		else{
			echo "<script>alert('Your new and Retype Password is not match'); window.location='changePassword.php'</script>";
		}
		}
		else
		{
		echo "<script>alert('Your old password is wrong'); window.location='changePassword.php'; </script>";
		}}
?>		
<div class="content-wrapper">
  <section class="content">
    <div class="row"> 
      <!-- left column -->
      <div class="col-md-12"> 
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Change Password   </h3>
          </div>
                <form role="form"  action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
					<div class="form-group">
                      <label for="password">Old Password</label>
                      <input type="password" class="form-control" id="opassword" name="opassword" autocomplete="off"  placeholder="Old Password" required />
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password" autocomplete="off" placeholder="Password" required />
                    </div>
                    <div class="form-group">
                      <label for="rPassword">Re Type-Password</label>
                      <input type="password" class="form-control" id="rPassword" name="rPassword" autocomplete="off" placeholder="Re Type-Password" required />
                    </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="changePassword">Submit</button>
                  </div>
                  </div>
                </form>
        
      </div>
      <!--/.col (left) --> 
      </div>
    </div>
    <!-- /.row --> 
  </section>
</div>
<!-- /.content-wrapper -->
<?php include("common/adminFooter.php");?>
<script>

/* var password = document.getElementById("password")
  , confirm_password = document.getElementById("rPassword");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
*/
</script>
