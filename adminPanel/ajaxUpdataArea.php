<?php
//Include database configuration file
include("common/conn.php");
include("class/datalist.php");
if(isset($_POST["districtID"]) && !empty($_POST["districtID"])){
				$districtID = $_POST["districtID"];
				$areaCode = $_POST["areaCode"];
					 $query="SELECT * FROM areas where deleted='0' and status='0' and districtId='$districtID'";
					$stateData=fetchData($query);
					foreach($stateData as $tableData)
					{ ?><option value="<?php echo $tableData['areaId']; ?>" <?php if($tableData['areaId']== $areaCode )echo "selected"; ?>><?php  echo $tableData['areaName'] ?></option> <?php } 
}
?>