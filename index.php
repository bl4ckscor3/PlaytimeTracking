<!DOCTYPE html>
<html>
	<?php require('head.php');?>
	<body>
		<div class="container">
			<div class="jumbotron">
				<?php require('pageheader.php');?>
				<div id="placeholder"></div>
				<div class="container fixedbar">
                	<div class="jumbotron" style="padding-bottom: 20px; padding-top: 20px">
                    	<form id="search" action="search.php">
                			<button class="btn btn-info btn-md" type="submit" style="float: left"><span class="glyphicon glyphicon-search"></span></button>
                			<input id="search-input" class="form-control" name="search" type="text" placeholder="Search for Steam ID or last known name" style="width: 20em">
                    	</form>
                    </div>
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
 				$("#placeholder").addClass("container");
				document.getElementById("placeholder").innerHTML = "<div class=\"jumbotron\" style=\"padding-bottom: 20px; padding-top: 20px\"><form><button class=\"btn btn-info btn-md\" type=\"submit\" style=\"float: left\"><span class=\"glyphicon glyphicon-search\"></span></button><input class=\"form-control\" name=\"search\" type=\"text\" placeholder=\"Search for Steam ID or last known name\" style=\"width: 20em\"></form></div>";
			}
			else
			{
				$(".fixedbar").removeClass("fixed");
 				$("#placeholder").removeClass("container");
				document.getElementById("placeholder").innerHTML = "";
			}
		});
	</script>
</html>