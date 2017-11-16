<!DOCTYPE html>
<html>
	<?php require('head.php');?>
	<body>
		<div class="container" style="margin-left: auto; margin-right: auto;">
			<div class="jumbotron">
				<?php require('pageheader.php');?>
				<div id="placeholder"></div>
				<div class="container fixedbar">
					<div class="jumbotron" id="searchotron" style="padding-bottom: 20px; padding-top: 20px; margin-bottom: 0px">
						<form id="search" action="search.php">
							<button class="btn btn-info btn-md" type="submit" style="float: left"><span class="glyphicon glyphicon-search"></span></button>
							<input id="search-input" class="form-control" name="search" type="text" placeholder="Search for SteamID/name" style="width: 20em">
						</form>
					</div>
				</div> 
				<div class="table-responsive">
					<table class="table table-striped">
						<tr>
							<th>SteamID</th>
							<th>Last Name</th>
							<th>Tryhard Ratio</th>
						</tr>
						<?php
							$names = $mysql->query("SELECT * FROM names");
							$times = $mysql->query("SELECT * FROM times");
							$maps = $mysql->query("SELECT * FROM maps");
							
							while($name = $names->fetch_assoc())
							{
								$id = $name['steamid'];
								$lastname = $name['lastname'];?>
								
								<tr onclick="location.href='user.php?id=<?php echo $id;?>'" style="cursor: pointer">
									<td><?php echo $id;?></td>
									<td><?php echo $lastname;?></td>
									<td>N/A</td>
								</tr>
						<?php }?>
					</table>
				</div>
			</div>
		</div>
	</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>
		$(window).scroll(function() {
			if($(window).scrollTop() > 190)
			{
 				$(".fixedbar").addClass("fixed");
 				$("#searchotron").css("width", "113%");
 				$("#placeholder").addClass("container");
				document.getElementById("placeholder").innerHTML = "<div class=\"jumbotron\" style=\"padding-bottom: 20px; padding-top: 20px; margin-bottom: 0px\"><form><button class=\"btn btn-info btn-md\" type=\"submit\" style=\"float: left\"><span class=\"glyphicon glyphicon-search\"></span></button><input class=\"form-control\" name=\"search\" type=\"text\" placeholder=\"Search for Steam ID or last known name\" style=\"width: 20em\"></form></div>";
			}
			else
			{
				$(".fixedbar").removeClass("fixed");
 				$("#searchotron").css("width", "");
 				$("#placeholder").removeClass("container");
				document.getElementById("placeholder").innerHTML = "";
			}
		});
	</script>
</html>