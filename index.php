<?php 
	if(!isset($_GET['page']))
	{
		$_GET['page'] = 1;
	}
	
	$page = $_GET['page'];
?>
<!DOCTYPE html>
<html>
	<?php require('head.php');?>
	<body>
		<div class="container" style="margin-left: auto; margin-right: auto;">
			<div class="jumbotron" id="parent">
				<?php require('pageheader.php');?>
				<div id="placeholder"></div>
				<div class="container fixedbar" id="child">
					<div class="jumbotron" style="padding-bottom: 20px; padding-top: 20px; margin-bottom: 0px; border-radius: 0px;">
						<form id="search" action="search.php">
							<button class="btn btn-warning btn-md" type="submit" style="float: left"><span class="glyphicon glyphicon-search"></span></button>
							<input id="search-input" class="form-control" name="search" type="text" placeholder="Search for SteamID/name" style="width: 20em">
						</form>
						<?php require('pageselector.php');?>
					</div>
				</div>
				<h2>Player Times</h2><br>
				<div class="table-responsive">
					<table class="table table-striped">
						<tr>
							<th>SteamID</th>
							<th>Last Name</th>
							<th>Total Playtime</th>
							<th>Tryhard Ratio</th>
						</tr>
						<?php
							$max = 20 * $page;
							$min = $max > 19 ? $max - 19 : 0;
							$names = $mysql->query("SELECT * FROM names WHERE id>=".$mysql->real_escape_string($min)." AND id<=".$mysql->real_escape_string($max)." ORDER BY id ASC");
							
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
								}?>
								
								<tr onclick="location.href='user.php?id=<?php echo $id;?>'" style="cursor: pointer">
									<td><?php echo $id;?></td>
									<td><?php echo $lastname;?></td>
									<td><?php echo $hours."h:".$minutes."m"?></td>
									<td><?php echo $ratio;?></td>
								</tr>
						<?php }?>
					</table>
				</div>
			</div>
		</div>
	</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>
		var once = false;
		
		$(window).scroll(function() {
			if($(window).scrollTop() > 190)
			{
 				$(".fixedbar").addClass("fixed");
 				document.getElementById("placeholder").innerHTML = "<div class=\"jumbotron\" style=\"padding-bottom: 20px; padding-top: 20px; margin-bottom: 0px\"><form><button class=\"btn btn-info btn-md\" type=\"submit\" style=\"float: left\"><span class=\"glyphicon glyphicon-search\"></span></button><input class=\"form-control\" name=\"search\" type=\"text\" placeholder=\"Search for Steam ID or last known name\" style=\"width: 20em\"></form></div>";

 				if(!once)
 				{
 	 				$("#child").width($("#parent").width());
 	 				once = true;
 				}
			}
			else
			{
				$(".fixedbar").removeClass("fixed");
				document.getElementById("placeholder").innerHTML = "";
			}
		});

		$(window).resize(function() {
			$("#child").width($("#parent").width());
		});
	</script>
</html>