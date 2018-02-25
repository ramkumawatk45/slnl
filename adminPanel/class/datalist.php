<?php
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
function deleteData($query,$url)
{
	$sql=mysql_query($query);
	header("loaction: ".$url);
}
function custumDateFormat( $first, $step = '+0 day', $format = 'd/m/Y' ) 
{
	$dates = "";
	$current = strtotime( $first );
	$current = strtotime( $step, $current );
	$dates = date( $format, $current );
	return $dates;
}
define("ADMIN_MOBILE", "9166782146");
?>