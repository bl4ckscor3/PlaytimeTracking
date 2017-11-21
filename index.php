<?php
	if(!isset($_GET['cmpFunc']))
		$_GET['cmpFunc'] = "cmpPlaytimeDesc";

	if(!isset($_GET['page']))
		$_GET['page'] = 1;
	
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
					<table class="table table-striped" id="visibleTable">
						<?php require('tablecontents.php');?>
					</table>
				</div>
			</div>
		</div>
	</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>
		var toggle = false;
		
		$(window).scroll(function() {
			if($(window).scrollTop() > 190 && !toggle)
			{
				$("#placeholder").height($(".fixedbar").height());
 				$(".fixedbar").addClass("fixed");
 				$("#child").width($("#parent").width());
 				toggle = true;
			}
			else if($(window).scrollTop() <= 190 && toggle)
			{
				$(".fixedbar").removeClass("fixed");
				$("#placeholder").height(0);
				toggle = false;
			}
		});

		$(window).resize(function() {
			$("#child").width($("#parent").width());

			if(toggle)
				$("#placeholder").height($(".fixedbar").height());
			else
				$("#placeholder").height(0);
		});
	</script>
</html>