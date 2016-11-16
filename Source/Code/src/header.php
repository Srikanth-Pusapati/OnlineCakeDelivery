<!DOCTYPE html>
<html>
<head>
	<!-- Start header section -->

	<!-- Font awesome -->
	<link href="css/font-awesome.css" rel="stylesheet"  />
	<!-- Bootstrap -->
	<link href="css/bootstrap.css" rel="stylesheet" />
	<!-- SmartMenus jQuery Bootstrap Addon CSS -->
	<link href="css/jquery.smartmenus.bootstrap.css" rel="stylesheet" />
	<!-- slick slider -->
	<link rel="stylesheet" type="text/css" href="css/slick.css" />
	<!-- Theme color -->
	<link id="switcher" href="css/theme-color/default-theme.css"
	rel="stylesheet" />

	<!-- Main style sheet -->
	<link href="css/style.css" rel="stylesheet" />

	<!-- Google Font -->
	<link href='https://fonts.googleapis.com/css?family=Lato'
	rel='stylesheet' type='text/css' />
	<link href='https://fonts.googleapis.com/css?family=Raleway'
	rel='stylesheet' type='text/css' />


	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- jQuery library -->
  <script
  src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.js"></script>
  <!-- SmartMenus jQuery plugin -->
  <script type="text/javascript" src="js/jquery.smartmenus.js"></script>
  <!-- SmartMenus jQuery Bootstrap Addon -->
  <script type="text/javascript" src="js/jquery.smartmenus.bootstrap.js"></script>
  <!-- slick slider -->
  <script type="text/javascript" src="js/slick.js"></script>
  <!-- Custom js -->
  <script src="js/custom.js"></script>
</head>
<body>
	<section>
		<header id="aa-header">
			<!-- start header top  -->
			<div class="aa-header-top">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="aa-header-top-area">
								<!-- start header top left -->
								<div class="aa-header-top-left">

									<!-- start cellphone -->
									<div class="cellphone hidden-xs">
										<p>
											<span class="fa fa-phone"></span>984-802-2338
										</p>
									</div>
									<!-- / cellphone -->
								</div>
								<div class="aa-header-top-right">
									<ul class="aa-head-top-nav-right">
										<!-- / header top left -->
										<?php session_start();
										if(isset($_SESSION["userEmail"])){ ?>
										<li><p>Welcome<?php echo " ".$_SESSION["userEmail"]; ?></p></li>
										<li class="hidden-xs"><a href="logout.php">Logout</a></li>
										<?php }else{ ?>
										<li><a href="login.php">My Account</a></li>
										<li class="hidden-xs"><a href="Registration.php">Registration</a></li>

										<?php } ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- / header top  -->

			<!-- start header bottom  -->
			<div class="aa-header-bottom">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="aa-header-bottom-area">
								<!-- logo  -->
								<div class="aa-logo">
									<!-- Text based logo -->
									<a href="<?php 
									if(isset($_SESSION["userType"])){
										$redirectpage =(redirectHref($_SESSION["userType"]));
										echo $redirectpage;
									}else {
										echo "index.php";
									}
									function redirectHref($userType){
										if($userType == 'admin'){
											$redirectpage= "admin_features.php";
										}else if($userType =='customer'){
											$redirectpage="index_Customer_logged.php";
										}else if($userType == 'deliverer'){
											$redirectpage = "deliverer_customerOrders.php";
										}
										return $redirectpage;
									} ?>"> <span class="fa fa-shopping-cart">
								</span>
								<p>
									Online <strong>Cake Delivery</strong> <span>Your choice</span>
								</p>
							</a>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- / header bottom  -->
</header>
</section>
</body>
</html>