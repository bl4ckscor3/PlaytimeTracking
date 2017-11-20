<tr>
	<th>SteamID</th>
	<th>Last Name</th>
	<th>Total Playtime</th>
	<th>Tryhard Ratio</th>
</tr>
<?php 
    $max = 20 * $page;
    $min = $max > 19 ? $max - 19 : 0;
    
    if($_GET['reload'] == 0)
    {
    	$names = $mysql->query("SELECT * FROM names ORDER BY id ASC");
    	$accounts = array(); //reset accounts array
    	
    	while($name = $names->fetch_assoc())
    	{
    		$id = $name['steamid'];
    		$lastname = $name['lastname'];
    		$times = $mysql->query("SELECT * FROM times WHERE steamid=\"".$mysql->real_escape_string($id)."\"");
    		$minutes = 0.0;
    		$tryhardtime = 0.0;
    		$ratio = 0.0;
    		$hours = 0;
    
    		while($time = $times->fetch_assoc())
    		{
    			$minutes += floatval($time['time']);
    
    			if($mysql->query("SELECT * FROM maps WHERE map=\"".$mysql->real_escape_string($time['map'])."\"")->fetch_assoc()['tryhard'] == 1)
    				$tryhardtime += floatval($time['time']);
    		}
    		
    		if($minutes != 0)
    		{
    			$ratio = round(($tryhardtime / $minutes) * 10, PHP_ROUND_HALF_UP) / 10;
    		}
    		else
    		{
    			$ratio = 0;
    		}
    		
    		while($minutes >= 60)
    		{
    			$hours += 1;
    			$minutes -= 60;
    		}
    		
    		$accounts[] = new Account($id, $lastname, $hours, $minutes, $ratio);
    	}
    }
	
	usort($accounts, $_GET['cmpFunc']);
	
	for($c = ($min - 1); $c < ($max); $c++)
	{?>
		<tr onclick="location.href='user.php?id=<?php echo $id;?>'" style="cursor: pointer">
			<td><?php echo $accounts[$c]->id;?></td>
			<td><?php echo $accounts[$c]->lastname;?></td>
			<td><?php echo $accounts[$c]->hours."h:".$accounts[$c]->minutes."m"?></td>
			<td><?php echo $accounts[$c]->ratio;?></td>
		</tr> <?php
    }?>