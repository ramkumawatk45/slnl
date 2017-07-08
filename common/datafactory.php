<?php
include'conn.php';	
function fetchData($query)
{
	$datainfo='';
	$sql=mysql_query($query);
	if($sql)
	{	
	while($row=mysql_fetch_assoc($sql))
	{
		$datainfo[]=$row;
	}
	return $datainfo;
	}
}
	


?>