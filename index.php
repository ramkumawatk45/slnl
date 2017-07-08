<?php include("common/menu.php"); ?>
 <section id="main-slider" class="no-margin">
        <div class="carousel slide">
            <ol class="carousel-indicators">
                <li data-target="#main-slider" data-slide-to="0" class="active"></li>
                <li data-target="#main-slider" data-slide-to="1"></li>
                <li data-target="#main-slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">

                <div class="item active" style="background-image: url(images/slider/CompanyLogo.png)">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="">
                                    <h1 class="animation animated-item-1">WELCOME TO SHRI LIFE NIDHI LTD.</h1>
                                    <h2 class="animation animated-item-2">Welcome to your investment planning, and this site provide the opportunity to your future planning where you effort & thought are not constrained by boundaries of your role but channeled toward the continuous growth & improvement of your solution.</h2>
                                </div>
                            </div>
							  <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img ">
                                    <img src="images/slider/building.png" class="img-responsive">
                                </div>
                            </div>
						</div>	
						
                    </div>
                </div><!--/.item-->

                <div class="item" style="background-image: url(images/slider/CompanyLogo.png)">
                  <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="">
                                    <h1 class="animation animated-item-1">WELCOME TO SHRI LIFE NIDHI LTD.</h1>
                                    <h2 class="animation animated-item-2">Fixed deposits (FD), Recurring Deposits (R.D), Monthly Installment Scheme (MIS) , Term Deposit (T.D) under various scheme formulated from time to time by company and to provide interest or benefit on the deposits.</h2>
                                </div>
                            </div>
							  <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img ">
                                    <img src="images/slider/wel_img.png" class="img-responsive">
                                </div>
                            </div>
						</div>	
						
                    </div>
                </div><!--/.item-->

                <div class="item" style="background-image: url(images/slider/CompanyLogo.png)">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="">
                                    <h1 class="animation animated-item-1">WELCOME TO SHRI LIFE NIDHI LTD.</h1>
                                    <h2 class="animation animated-item-2"> As is fit for and beneficial to the company and to the members as per the rules & regulations or guidelines of Reserve Bank of India (RBI), Ministry of corporate affairs and regulatory authority on NBFC or NIDHI</h2>
                                </div>
                            </div>
							  <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img ">
                                    <img src="images/slider/rupees-bundle_indian_rupees_1.png" class="img-responsive">
                                </div>
                            </div>
						</div>	
						
                    </div>
                </div><!--/.item-->
            </div><!--/.carousel-inner-->
        </div><!--/.carousel-->
        <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
            <i class="fa fa-chevron-left"></i>
        </a>
        <a class="next hidden-xs" href="#main-slider" data-slide="next">
            <i class="fa fa-chevron-right"></i>
        </a>
		
    </section><!--/#main-slider-->

    <section id="feature" >
        <div class="container">
           <div class="center wow fadeInDown">
                <h2>SHRI LIFE NIDHI LIMITED</h2>
                <p class="lead">SHRI LIFE NIDHI LIMITED company notified under section 620-A of the Companies Act is classified at present as "Mutual Benefit Financial Company" by RBI and regulated by the Bank for its deposit taking activities and by DCA for its operational matters as also the deployment of funds. These Companies enjoy exemption from core provisions of the RBI Act viz. requirement of registration, maintenance of liquid assets and creation of reserve fund, and RBI Directions except those relating to interest rate on deposits, prohibition from paying brokerage on deposits, ban on advertisements and the requirement of submission of certain Returns. Such companies, however, are allowed to deal with their shareholders only, for the purpose of accepting deposits and making loans. There are a number of companies functioning on the lines of Nidhi companies but not yet notified by DCA.</p> <p class="lead"> As RBI Directions to classify them as loan companies disallowed them the special dispensation available to Notified Nidhi companies. Bank and the Government received representations from a large number of such companies and their associations. Government decided to give them a special dispensation and notified that applications of companies incorporated on or before January 9, 1997 shall be considered for notifying as Nidhi Company under section 620-A of the Companies Act, 1956 only if they have minimum NOF of Rs.10 lakh or more. These companies shall be required to have net owned fund of Rs.25 lakh by December 31, 2002 like companies already declared as Nidhis. Government has also clarified that NOF shall have the same meaning as assigned to it in the RBI Act, 1934. Thus a new class of companies has been created i.e. the potential Nidhi companies. To distinguish them from the notified Nidhi companies ( Mutual Benefit Financial Companies) the term Mutual Benefit Companies (MBC) is being used</p>
            </div>

            <div class="row">
                <div class="features">
				<div class="center wow fadeInDown">
                <h2>OUR DEPOSIT PLAN</h2>
            </div>
					<?php 
							$query="SELECT * FROM main_menu inner join pages on main_menu.m_menu_id=pages.m_menu_Id and main_menu.m_menu_name='Deposit Plan' order by pages.datetime Desc LIMIT 3";
							$pagesData=fetchData($query);
							if (is_array($pagesData) || is_object($pagesData))
							{
								foreach($pagesData as $pageData)
								{
					?>
                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <a href="<?php echo $pageData['m_menu_link']."?id=".$pageData['pageId']; ?>"><div class="feature-wrap">
                            <i class="fa fa-hand-o-right"></i>
                            <h2><?php echo $pageData['pageTitle']; ?></h2>
                            <h3><?php echo substr($pageData['pageSubTitle'],0,300)." ...."; ?></h3>
                        </div>
						</a>
                    </div><!--/.col-md-4-->    
					<?php 		}
							}
					?>			
                </div><!--/.services-->
            </div><!--/.row--> 
 <div class="row">
                <div class="features">
				<div class="center wow fadeInDown">
                <h2>OUR LOAN PLAN</h2>
				</div>
					<?php 
							$query="SELECT * FROM main_menu inner join pages on main_menu.m_menu_id=pages.m_menu_Id and main_menu.m_menu_name='Loan Plan' order by pages.datetime Desc LIMIT 3";
							$pagesData=fetchData($query);
							if (is_array($pagesData) || is_object($pagesData))
							{
								foreach($pagesData as $pageData)
								{
					?>
                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <a href="<?php echo $pageData['m_menu_link']."?id=".$pageData['pageId']; ?>"><div class="feature-wrap">
                            <i class="fa fa-hand-o-right"></i>
                            <h2><?php echo $pageData['pageTitle']; ?></h2>
                            <h3><?php echo substr($pageData['pageSubTitle'],0,300)." ...."; ?></h3>
                        </div>
						</a>
                    </div><!--/.col-md-4-->    
					<?php 		}
							}
					?>			
                </div><!--/.services-->
            </div><!--/.row--> 			
        </div><!--/.container-->
    </section><!--/#feature-->  
<?php include("common/footer.php"); ?>	