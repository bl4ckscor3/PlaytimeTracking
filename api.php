<?php 
	require('password.php');

	function getMysql()
	{
		$mysql = new mysqli("158.69.59.239", "Vauff", getPass(), "maptracking");
	
		if($mysql->connect_error)
		{
			return false;
		}
	
		return $mysql;
	}
?>
