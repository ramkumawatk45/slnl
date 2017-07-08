<?php include("datafactory.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Shri Life Nidhi Ltd.</title>
	
	<!-- core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/favicon.png">
	 <script src="http://code.jquery.com/jquery-1.9.1.js" type="text/javascript"></script>
  <script type="text/javascript">
    
<!--
        //Disable right click script 
        //visit http://www.rainbow.arch.scriptmania.com/scripts/ 
       /* var message = "Sorry, right-click has been disabled";
        /////////////////////////////////// 
        function clickIE() { if (document.all) { (message); return false; } }
        function clickNS(e) {
            if
	(document.layers || (document.getElementById && !document.all)) {
                if (e.which == 2 || e.which == 3) { (message); return false; }
            }
        }
        if (document.layers)
        { document.captureEvents(Event.MOUSEDOWN); document.onmousedown = clickNS; }
        else { document.onmouseup = clickNS; document.oncontextmenu = clickIE; }
        document.oncontextmenu = new Function("return false") */
// --> 

  </script>
  
</head><!--/head-->

<body class="homepage">

    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-xs-4">
                        <div class="top-number"><p><i class="fa fa-phone-square"></i> +917737371436, 01424-258055 </p></div>
                    </div>
					<div class="col-sm-4 col-xs-4">
                        <div class="notification">Only For Members</div>
                    </div>
                    <div class="col-sm-4 col-xs-4">
                       <div class="social">
                            <ul class="social-share">
                                <li><a target="_blank" href="https://www.facebook.com/shrilifenidhilimited/?fref=ts"><i class="fa fa-facebook"></i></a></li>
                                <li><a target="_blank" href="https://twitter.com/shrilifenidhi"><i class="fa fa-twitter"></i></a></li>
                                <li><a target="_blank" href="https://www.linkedin.com/in/shri-life-nidhi-limited-583797a3"><i class="fa fa-linkedin"></i></a></li> 
                                <li><a target="_blank" href="https://plus.google.com/u/0/110712397422183489950"><i class="fa fa-google-plus"></i></a></li>
                                <li><a target="_blank" href="http://www.shrilifenidhi.com:2095/"><i class="fa fa-envelope-o"></i></a></li>
                            </ul>
                            <div class="search">
                                <img src="images/ind-flag.gif" class="flag">
                           </div>
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand"  href="http://loan.shrilifenidhi.com/" target="_blank"><img src="images/logo.png" alt="logo"></a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav" id="main-menu">
					<?php 
							$menuQuery="select * from main_menu where m_menu_deleted='0' and m_menu_status='0'";
							 $menuData=fetchdata($menuQuery);
							if (is_array($menuData) || is_object($menuData))
							{
							 foreach($menuData as $menuItem)
							{
								$active = "";
								if(basename($_SERVER['SCRIPT_NAME']) == $menuItem['m_menu_link']){ $active ="active"; } 
								else{ $active =""; }
								if($menuItem['m_menu_name'] =="About Us")
								{
									if(basename($_SERVER['SCRIPT_NAME']) == "aboutus.php" || basename($_SERVER['SCRIPT_NAME']) == "companyprofie.php" || basename($_SERVER['SCRIPT_NAME']) == "legal.php"){ $active ="active"; }
								?>
									<li class="dropdown <?php echo $active; ?>">
										<a href="aboutus.php" class="dropdown-toggle" data-toggle="dropdown"><?php echo $menuItem['m_menu_name']; ?> <i class="fa fa-angle-down"></i></a>
										<ul class="dropdown-menu">
											<li><a href="aboutus.php">COMPANY PROFILE</a></li>
											<li><a href="companyprofie.php">VISION & MISSION </a></li>
											<li><a href="legal.php">LEGAL</a></li>
										</ul>
									</li>
								<?php	
								}
								else if($menuItem['m_menu_name'] =="Deposit Plan")	
								{
								?>
									<li class="dropdown <?php echo $active; ?>">
										<a class="dropdown-toggle" data-toggle="dropdown"><?php echo $menuItem['m_menu_name']; ?> <i class="fa fa-angle-down"></i></a>
										<ul class="dropdown-menu">
										<?php 
											$parentmenuId= $menuItem['m_menu_id'];
											$menuQuery="select * from pages where deleted='0' and status='0' and m_menu_Id ='$parentmenuId'";
												 $menuData=fetchdata($menuQuery);
												if (is_array($menuData) || is_object($menuData))
												{
													 foreach($menuData as $menuItem)
													{
														?>
														<li><a href="depositPlan.php?id=<?php echo $menuItem['pageId']; ?>"><?php echo ucwords(strtolower($menuItem['pageTitle'])); ?></a></li>
														<?php
													}
												}
										?>
										</ul>
									</li>
								<?php	
								}	
								else if($menuItem['m_menu_name'] =="Loan Plan")	
								{
								?>
									<li class="dropdown <?php echo $active; ?>">
										<a class="dropdown-toggle" data-toggle="dropdown"><?php echo $menuItem['m_menu_name']; ?> <i class="fa fa-angle-down"></i></a>
										<ul class="dropdown-menu">
										<?php 
											$parentmenuId= $menuItem['m_menu_id'];
											$menuQuery="select * from pages where deleted='0' and status='0' and m_menu_Id ='$parentmenuId'";
												 $menuData=fetchdata($menuQuery);
												if (is_array($menuData) || is_object($menuData))
												{
													 foreach($menuData as $menuItem)
													{
														?>
														<li><a href="loanPlan.php?id=<?php echo $menuItem['pageId']; ?>"><?php echo ucwords(strtolower($menuItem['pageTitle'])); ?></a></li>
														<?php
													}
												}
										?>
										</ul>
									</li>
								<?php	
								}	
								
								else
								{	
							 ?>
								<li class="header-li <?php echo $active; ?> "><a href="<?php echo $menuItem['m_menu_link']; ?>"><?php echo htmlentities($menuItem['m_menu_name']); ?></a></li>
							 <?php 
								}
								}
							}
						?>
                        <!--<li><a href="index.php">HOME</a></li>
						 <li class="dropdown">
                            <a href="aboutus.php" class="dropdown-toggle" data-toggle="dropdown">ABOUT US <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="aboutus.php">COMPANY PROFILE</a></li>
                                <li><a href="companyprofie.php">VISION & MISSION </a></li>
								<li><a href="legal.php">LEGAL</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="dailyplan.php" class="dropdown-toggle" data-toggle="dropdown">DEPOSIT PLAN <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="dailyplan.php">DAILY SAVING PLAN</a></li>
                                <li><a href="recurringplan.php">RECURRING DEPOSIT PLAN</a></li>
                                <li><a href="fixeddepositplan.php">FIXED DEPOSIT PLAN</a></li>
								<li><a href="#">PENSION PLAN</a></li>
                                <li><a href="savingaccount.php">SAVING ACCOUNT</a></li>
								<li><a href="#">MONTHLY INCOME PLAN</a></li>
                            </ul>
                        </li>
						 <li class="dropdown">
                            <a href="goldloan.php" class="dropdown-toggle" data-toggle="dropdown">LOAN PLAN <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="goldloan.php">GOLD LOAN</a></li>
                                <li><a href="mortgageloan.php">MORTGAGE LOAN</a></li>
                                <li><a href="microfinance.php">MICRO FINANCE</a></li>
                            </ul>
                        </li>
                        <li><a href="gallery.php">GALLERY</a></li> 
                        <li><a href="career.php">CAREER</a></li>   
                        <li><a href="contact-us.php">CONTACT</a></li>     
						 -->    
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
		
    </header><!--/header-->
    </body>
    </html>