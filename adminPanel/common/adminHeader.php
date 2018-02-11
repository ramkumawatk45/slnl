<?php error_reporting( E_ALL ); ob_start(); ?>
<?php
 include("conn.php");
 include("sms.php");
 include("constant.php");
 include("class/datalist.php");
 include("session.php");

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
 
    <title>Shri Life Nidhi Ltd.</title>
    <!--<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	   <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
	<link rel="stylesheet" href="css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="css/buttons.dataTables.min.css">
	<link rel="stylesheet" href="css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="css/responsive.dataTables.min.css">
	<link rel="stylesheet" href="css/style.css">   
	<link rel="stylesheet" href="bootstrap/css/bootstrap-iso.css" />
	<link rel="stylesheet" href="bootstrap/css/bootstrap-datepicker3.css"/>
	<script src="js/jquery.min.js"></script> 	 
	<script type="text/javascript" src="bootstrap/js/bootstrap-datepicker.min.js"></script>

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
          <?php

?><a href="dashboard.php" class="logo">
          <span class="logo-lg"><b><?php echo $_SESSION['userType'] ?></b></span>
		  <input type="hidden" id="branchAccess" value="<?php echo $_SESSION['branchAccess']; ?>" />
		  <input type="hidden" id="userAccess" value="<?php echo $_SESSION['userAccess']; ?>" />
		  <input type="hidden" id="userRole" value="<?php echo $_SESSION['userRole']; ?>" />
        </a>
        <?php
?>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <!--<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>-->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">
<!--                  <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
-->                  <span class="glyphicon glyphicon-user"> <?php echo $_SESSION['login_user']; ?></span>
                  <span class="caret"></span>
                  <span class="hidden-xs"></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-footer">
                    <div class="pull-left">
                    <?php  $_SESSION['login_user']; ?>
                    </div>
                   
                   
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
           
            </ul>
			 <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          
          <!-- search form -->
          
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            
            <li class="active treeview">
            
		
                  <a href="#">
                    <!--<i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>-->
                  </a>
              <ul class="treeview-menu mainmenu">
				<li class="index <?php if(basename($_SERVER['SCRIPT_NAME']) == 'dashboard.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a> </li>
				<li class="index <?php if(basename($_SERVER['SCRIPT_NAME']) == 'changePassword.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>"><a href="changePassword.php"><i class="fa fa-bars"></i> Change Password</a></li>
				<?php if($_SESSION['userType']=="ADMIN")
				{
				?>	
				<li class="states  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'states.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="states.php"><i class="fa fa-paperclip"></i>Defaults</a>
				<ul class="submenu">
					<li class="states  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'states.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="states.php">States</a></li> 
					<li class="districts  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'districts.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="districts.php">Districts</a></li> 
					<li class="areas  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'areas.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="areas.php">Areas</a></li> 
					<li class="trainingcenter  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'trainingCenter.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="trainingCenter.php">Branches</a></li> 
					<li class="users  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'users.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="users.php">Users</a></li> 
					<li class="loanPlans  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'loanPlans.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="loanPlans.php">Loan Plan</a></li>
					<li class="smsSetting  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'smsSetting.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="smsSetting.php">SMS API Setting</a></li>
					<li class="web-dashboard  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'web-dashboard.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="web-dashboard.php">Website Admin</a></li>
				</ul>
				</li> 	
				<li class="deleteLoanSearch  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'deleteLoanSearch.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="deleteLoanSearch.php"><i class="fa fa-paperclip"></i>Deleted EMI Data</a>
				<ul class="submenu">
					<li class="deleteLoanSearch  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'deleteLoanSearch.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="deleteLoanSearch.php">Delete Loan EMI</a></li>
					<li class="deletedEMI  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'deletedEMI.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="deletedEMI.php">Deleted Loan EMI</a></li>
				</ul>	
				</li>	
				<?php 
				}
				if($_SESSION['userRole'] == "FIELDWORKER" || $_SESSION['userRole'] =="BRANCH"  || $_SESSION['userRole'] =="ADMIN")
				{	
				?>
				<li class="loans  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'loans.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="loans.php"><i class="fa fa-user"></i>Loan Customer</a></li> 
				<li class="loanEMI  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'loanEmi.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="loanEmi.php"><i class="fa fa-money"></i>Loan EMI</a></li>
				<li class="emiReport  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'emiReport.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="emiReport.php"><i class="fa fa-money"></i>EMI Collection Report</a></li> 
				<?php 
				}
				if($_SESSION['userRole'] =="ADMIN" ||  $_SESSION['userRole'] =="BRANCH")
				{	
				?>
				<li class="dueReport  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'duereport.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="duereport.php"><i class="fa fa-circle-o"></i>Reports</a>
				<ul class="submenu">
					<li class="dueReport  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'duereport.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="duereport.php">EMI Due Report</a></li> 
					<li class="loanDueReport  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'loanDueReport.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="loanDueReport.php"></i>EMI Detail Due Report</a></li> 	
					<li class="sameDatePrint  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'sameDatePrint.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="sameDatePrint.php">Same Day Report</a></li> 
					<li class="emiDueReport  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'emiDueReport.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="emiDueReport.php">All EMI Due Report</a></li> 
				</ul>	
				</li>
				<li class="accounting  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'accounting.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="accounting.php"><i class="fa  fa-bars"></i>Accounting</a>
				<ul class="submenu">
					<li class="accounting  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'accounting.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="accounting.php">Accounting</a></li>
					<?php if($_SESSION['userRole'] =="ADMIN") { ?>
					<li class="accountingTotal  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'accountingTotal.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="accountingTotal.php">Accounting Total</a></li>
					<li class="expenses  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'expenses.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="expenses.php">Expenses</a></li>
					<li class="incomes  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'incomes.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="incomes.php">Incomes</a></li>
					<?php } ?>
				</ul>
				</li>
				<li class="loanRequest  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'loanRequest.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="loanRequest.php"><i class="fa  fa-bars"></i>Loan Requests</a>
				<ul class="submenu">
					<li class="loanRequest  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'loanRequest.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="loanRequest.php">All Requests</a> </li>
					<li class="loanApproveRequest  <?php if(basename($_SERVER['SCRIPT_NAME']) == 'loanApproveRequest.php'){echo 'active'; }else { echo basename($_SERVER['SCRIPT_NAME']); } ?>" ><a href="loanApproveRequest.php">Approve Requests</a> </li>
				  </ul>
				</li>
				<?php 
				}
				?>
               </ul>  
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
	  <div class="loading hide" id="loading">Loading&#8230;</div>
<style>
.logo-lg img {
    width: 50%;
    height:auto ;
}
ol.breadcrumb-student {
    list-style: none;
    text-align: center;
    font-size: 20px;
}
.card.card-block.studentCard {
    border: 1px solid #ccc;
    border-radius: 5px;
    float: left;
    margin-bottom: 10px;
    padding: 0 10px 10px;
    width: 100%;
}
h3.title {
    font-size: 21px;
    font-family: Roboto-Medium;
    text-align: center;
	color:#fff;
}
p.titleDes {
 	color: #2c3b41;
    font-family: CALIST_1;
    font-size: 16px;
    text-align: justify;
}
.studentCard a.btn {
    margin: 0;
}
ol.breadcrumb-student li {
    float: left;
    padding: 0 0 5px;
    width: 7%;
}
.skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
    background-color: #3c8dbc;
}
.sidebar-menu .treeview-menu>li>a {
    padding: 5px 5px 5px 5px;
    display: block;
    font-size: 14px;
}

.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.0);
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 13px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
  -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
  box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

table.dataTable thead th, table.dataTable thead td {
    padding: 4px 4px;
    border-bottom: 1px solid #111;
}

div.dt-buttons {
    position: relative;
    float: right;
}
.dataTables_wrapper .dataTables_filter {
    float: left;
    text-align: right;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
    box-sizing: border-box;
    display: inline-block;
    min-width: 1.5em;
    padding: 0em 0em;
    margin-left: 2px;
    text-align: center;
    text-decoration: none !important;
    cursor: pointer;
    color: #333 !important;
    border: 1px solid transparent;
    border-radius: 2px;
}
table.dataTable.select tbody tr,
table.dataTable thead th:first-child {
  cursor: pointer;
}
.readWriteAccess
{  
	opacity: .9 !important;
    pointer-events: none !important;
	cursor: not-allowed !important;
}
body {
    font-size: 12px;
}
.sidebar {
    width: 250px;
    height: calc(100vh - 50px);
    float: none;
    display: block;
    position: fixed !important;
    overflow-y: auto;
    z-index: 100;
    background: #323a47;
    color: #a4a7b0;
}
.sidebar-menu .treeview-menu>li>a:focus, .sidebar-menu .treeview-menu>li>a:hover {
    color: #fff;
    background-color: #4c5363;
}
ul.treeview-menu li.active {
    border-right: 3px solid #378fcb;
	background-color: #4c5363;
}
span.requiredField {
    color: red;
}
.main-header {
    position: fixed;
    max-height: 100px;
    z-index: 1030;
    width: 100%;
}
.content-wrapper, .right-side {
    min-height: 100%;
    max-height: 100%;
    background-color: #ecf0f5;
    z-index: 800;
    margin-top: 50px;
}	

/* reset our lists to remove bullet points and padding */
.mainmenu, .submenu {
  list-style: none;
  padding: 0;
  margin: 0;
}

/* make ALL links (main and submenu) have padding and background color */
.mainmenu a {
  display: block;
  text-decoration: none;
	padding: 6px 6px 6px 25px;
  color: #000;
}

/* add hover behaviour */
.mainmenu a:hover {
    color: #fff;
    background-color: #4c5363;
}


/* when hovering over a .mainmenu item,
  display the submenu inside it.
  we're changing the submenu's max-height from 0 to 200px;
*/

.mainmenu li:hover .submenu {
  display: block;
  max-height: 300px;
}
.mainmenu li.active .submenu li.active{
	 max-height: 300px;
}
/*
  we now overwrite the background-color for .submenu links only.
  CSS reads down the page, so code at the bottom will overwrite the code at the top.
*/

.submenu a {
  background-color: #2c3b41;
  border-left :1px solid #378fcb;
  border-right :1px solid #378fcb;
}

/* hover behaviour for links inside .submenu */
.submenu a:hover {
  background-color: #666;
}

/* this is the initial state of all submenus.
  we set it to max-height: 0, and hide the overflowed content.
*/
.submenu {
  overflow: hidden;
  max-height: 0;
  -webkit-transition: all 0.5s ease-out;
}
</style>