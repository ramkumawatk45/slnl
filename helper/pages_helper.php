<?php
if(isset($_POST['addPages']))
{
	try {
			if(isset($_POST['pageTitle']))
			{
				$pageDetailData = new stdClass();
				$pageDetailData->pageTitle = $_POST['pageTitle'];
				$pageDetailData->pageDescription = $_POST['pageDescription'];
				$pageDetailData->specialNote = $_POST['specialNote'];	
				$pageDetailData->seoTitle = $_POST['seoTitle'];
				$pageDetailData->metaTag = $_POST['metaTag'];
				$pageDetailData->keyWord = $_POST['keyWord'];				
				$pageDetailData->sort_order = $_POST['sort_order'];				
				$pageDetailData->status = $_POST['status'];
				$pageDetailData->categoryId = $_POST['categoryId'];
				if(isset($_POST['pageId']))
				{
					$pageDetailData->pageId = $_POST['pageId'];
				    $pageDetailData->state = 2;
				}
				else{
					$pageDetailData->state = 1;
				}
				$pageDetailInfo = new dataInfo();
				$response = $pageDetailInfo ->addPageDetail($pageDetailData);
				$succesMsg = $response;
				header("location:viewPages.php?msg=".$succesMsg);
			}
			else
			{
			throw new Exception("fill required field.");
			}
	}
	catch(Exception $e) {
	  $msg = $e->getMessage();
	}



}

?>