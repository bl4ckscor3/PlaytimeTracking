<h4 style="float: right; margin-top: -34px">
	<?php echo $page > 1 ? "<a href=\"index.php".($page - 1 == 1 ? "" : "?page=".($page - 1))."\">" : ""?>
		<button class="btn btn-warning<?php echo $page <= 1 ? " disabled" : "";?>"><span class="glyphicon glyphicon-arrow-left"></span></button>
	<?php echo $page > 1 ? "</a>" : "";
		
		$mysql = getMysql();
		$pages = $mysql->query('SELECT COUNT(id) AS id FROM names')->fetch_assoc()['id'] / 20;
		$ceiled = ceil($pages);
		
		for($i = 1; $i <= $ceiled; $i++)
		{
			if($i == $page)
			{
				echo $i." ";
			}
			else if($i == 1)
			{
				echo "<a href=\"index.php?cmpFunc=".$_GET['cmpFunc']."\">".$i."</a> ";
			}
			else
			{
				echo "<a href=\"index.php?page=".$i."&cmpFunc=".$_GET['cmpFunc']."\">".$i."</a> ";
			}
		}
		?>
	<?php echo $page < $ceiled ? "<a href=\"index.php?page=".($page + 1)."&cmpFunc=".$_GET['cmpFunc']."\">" : ""?>
	<button class="btn btn-warning<?php echo $page >= $ceiled ? " disabled" : "";?>"><span class="glyphicon glyphicon-arrow-right"></span></button>
	<?php echo $page < $ceiled ? "</a>" : "";?>
</h4>
