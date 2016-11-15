<!DOCTYPE html>
<html>
	<head>
		<title>Login User</title>

		<style>

#tabs a {
width: 40%;
}

#tabs a li {

display: inline-block;
width: 30%;
margin: auto;
background-color:#eee;
} 

#tabs a li:hover,
#tabs a li:active{
background-color: red;
color: white;
}

#totabl {
display:none;
}

#content div {
padding: 20px;
float: none;
}

#totab2 {
display:none;
}
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" />


			<script>
				$(document).ready(function(){

				$("#litotab1").click(function(){
				$("#totab1").show();
				$("#totab2").hide();
				});

				$("#litotab2").click(function(){

				$("#totab1").hide();
				$("#totab2").show();
				});
				

				});
			</script>
		</head>

		<body>
			<?php include 'header.php' ?>
			<section id="content">
				<ul id="tabs">
					<a href ="#totab1" >
						<li id="litotab1">Login</li>
					</a>
					<a href ="#totab2">
						<li id="litotab2">Register</li>
					</a>
				</ul>

				<div id="totab1" >
					<p> Tab 1 content
					</div>

					<div id="totab2">
						<p> welcome tab 2 content</p>
					</div>

				</section>



				<?php include'footer.php' ?>

			</body>
		</html>
		