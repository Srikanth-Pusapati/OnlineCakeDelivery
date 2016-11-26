<!DOCTYPE html>
<html>
<head>
	<title>Success</title>
	<style type="text/css">
		#sucId{
			padding: 10px 50px;
		}
	</style>
</head>
<body>
	<?php
	include 'utils.php';
	$utilsObj=new Utils();
	$utilsObj->includeHeader();

	?>
	<div id="sucId">
		<h2>Order Placed Successfully</h2>
		<h3>THANK YOU FOR SHOPPING</h3>
		<h4>Visit Again</h4>
	</div>
	<?php $utilsObj->includeFooter();?>
</body>
</html>