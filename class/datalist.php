<?php
function fetchData($query)
{
	$datainfo='';
	$sql=mysql_query($query);
	while($row=mysql_fetch_assoc($sql))
	{
		$datainfo[]=$row;
	}
	return $datainfo;
}
function deleteData($query,$url)
{
	$sql=mysql_query($query);
	header("loaction: ".$url);
}
?>