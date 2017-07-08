<?php
//Include database configuration file
include("common/conn.php");
include("class/datalist.php");
if(isset($_POST["state_id"]) && !empty($_POST["state_id"])){
    			$stateId = $_POST["state_id"];
				$districtId = $_POST["district_id"];
                    $query="SELECT * FROM districts where deleted='0' and status='0' and stateId='$stateId'";
					$stateData=fetchData($query);
					foreach($stateData as $tableData)
					{ ?><option value="<?php echo $tableData['districtId']; ?>" <?php if($tableData['districtId']== $districtId )echo "selected"; ?>><?php  echo $tableData['districtName'] ?></option> <?php } 
}
?>