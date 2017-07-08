<?php
//Include database configuration file
include("common/conn.php");
include("class/datalist.php");
if(isset($_POST["districtID"]) && !empty($_POST["districtID"])){
    			$districtID = $_POST["districtID"];
                    $query="SELECT * FROM areas where deleted='0' and status='0' and districtId='$districtID'";
					$stateData=fetchData($query);
					foreach($stateData as $tableData)
					{ ?><option value="<?php echo $tableData['areaId']; ?>"><?php  echo $tableData['areaName'] ?></option> <?php } 
}
?>