<style> 
.table>thead>tr>th {
    vertical-align: bottom;
    border-bottom: 2px solid #ddd;
    background-color: #c52d2f;
    color: #fff;
    border: 1px solid ##c52d2f;
}
</style>
<?php include("common/menu.php"); ?>
<?php 
		$id=$_REQUEST['id'];
		$query="SELECT * FROM pages where pageId='$id' and status='0' and deleted='0'";
		$pagesData=fetchData($query);
		if (is_array($pagesData) || is_object($pagesData))
		{
			foreach($pagesData as $pageData)
			{
?>
<section class="pricing-page">
        <div class="container">
            <div class="center">  
                <h2><?php echo $pageData['pageTitle']; ?></h2>
                <p class="lead"><?php echo $pageData['pageSubTitle']; ?></p>
            </div> 
			
			<?php echo $pageData['pageDescription']; ?>
			
        </div><!--/container-->
		
    </section>
		<?php }} ?>	
	<?php include("common/footer.php"); ?>	