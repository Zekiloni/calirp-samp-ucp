<head>
	<!-- Title -->
	<title><?php echo $config['ime-servera'];?></title>
	
	<!-- Loading Favicon -->
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	
	<!-- Including CSS -->
	<link rel="stylesheet" href="assets/css/style.css">
	
	<!-- Including Font Awesome -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
	<div class="wrapper">
		<div class="menu">
			<ul class="navigation">
				<li><a <?php if(basename($_SERVER["PHP_SELF"]) == 'index.php'){ echo 'class="active firstlevel"';}?> href="index.php">Pocetna</a></li>
				<li><a class="firstlevel" href="http://forum.wl-rp.info/">Forum</a></li>
				<li><a <?php if(basename($_SERVER["PHP_SELF"]) == 'about.php'){ echo 'class="active firstlevel"';}?> href="about.php">O nama</a>
				<ul>
					<li><a <?php if(basename($_SERVER["PHP_SELF"]) == 'about.php'){ echo 'class="active firstlevel"';}?> href="about.php?action=about">Informacije</a></li>
					<li><a <?php if(basename($_SERVER["PHP_SELF"]) == 'about.php'){ echo 'class="active firstlevel"';}?> href="about.php?action=team">Clanovi Tima</a></li>
				</ul>
				</li>
				<li><a <?php if(basename($_SERVER["PHP_SELF"]) == 'donations.php'){ echo 'class="active firstlevel"';}?> href="donations.php">Donacije</a></li>
				<li><a class="firstlevel" href="#">Dnevnik azuriranja</a>
					<ul>
						<li><a class="firstlevel" href="#">Server</a></li>
						<li><a class="firstlevel" href="#">Portal - UCP</a></li>
					</ul>
				</li>
			</ul>
			<ul class="social-icons">
				<li><a href="<?php echo $config['facebook-page'];?>" class="fa fa-facebook"></a></li>
				<li><a href="#" class="fa fa-twitter"></a></li>
   				<li><a href="#" class="fa fa-dribbble"></a></li>
				<li><a href="#" class="fa fa-linkedin"></a></li>
            </ul>
		</div>
		<div class="cover">
			<span class="time"><?php echo date("d.m.Y"); ?><br><?php echo date("H:i"); ?></span>
			<center><img class="logo" src="assets/images/logo-1.png"/></center>
		</div>