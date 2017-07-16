<?php include("common/menu.php"); ?>
<section id="portfolio">
        <div class="container">
            <div class="center">
               <h2>GALLERY</h2>
            </div>
            <!--<ul class="portfolio-filter text-center">
                <li><a class="btn btn-default active" href="#" data-filter="*">All Works</a></li>
                <li><a class="btn btn-default" href="#" data-filter=".bootstrap">Creative</a></li>
                <li><a class="btn btn-default" href="#" data-filter=".html">Photography</a></li>
                <li><a class="btn btn-default" href="#" data-filter=".wordpress">Web Development</a></li>
            </ul><!--/#portfolio-filter-->

            <div class="row">
                <div class="portfolio-items">
				<?php  $homeQuery="select * from galleryimages where deleted='0' and status='0'  and galleryId='1' ";
					 $pageData=fetchdata($homeQuery);
					 if (is_array($pageData) || is_object($pageData))
					{
						 foreach($pageData as $pageItem)
						{
						?> 
                    <div class="portfolio-item apps col-xs-12 col-sm-4 col-md-3">
                        <div class="recent-work-wrap">
                            <img class="img-responsive" src="<?php $location=explode('../',$pageItem['location']); echo $location[1]; ?>" alt="">
                            <a class="preview" href="<?php $location=explode('../',$pageItem['location']); echo $location[1]; ?>" rel="prettyPhoto">
							<div class="overlay">
                            </div>
							</a>
                        </div>
                    </div>
					<?php 
						}
					}
					?>
				</div>	
			</div>	
         </div>
 
		<div id="prettyphoto-controls">
 
</div>
    </section><!--/#portfolio-item-->
	<?php include("common/footer.php"); ?>	