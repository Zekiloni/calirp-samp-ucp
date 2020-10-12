<?php	
	include 'includes/config.php'; 
	include 'includes/header.php';

	/* UCP User klasa */
	require_once 'classes/ucp_user.class.php';
	$ucp_user = new User();
	
	/* Proces logovanja */
	if(isset($_POST['Submit']))
	{
		if(empty($_POST['username']))
			$_SESSION['error_msg'] = "Niste upisali korisnicku ime.";
		else if(empty($_POST['password']))
			$_SESSION['error_msg'] = "Niste upisali korisnicku sifru.";
		else
			$ucp_user->Login($_POST['username'], $_POST['password']);	
	}
?>
		<div class="under-cover">
			<?php if($ucp_user->IsLogged()) { ?>
				<div id="login-place" class="login-place">
					<a href="panel.php?page=admin-panel"><div class="button">Admin Panel</div></a>
					<a href="panel.php?page=settings"><div class="button">Podesavanja</div></a>
					<a href="logout.php"><div style="background: #bb0000;" class="button">Logout</div></a>
				</div>
				<div class="greetings">Pozdrav <a href="#"><b><?php echo $_SESSION['username']; ?></b></a>, dobrodosli na korisnicki panel.</div>
			<?php } else { ?>
			<div id="login-place" class="login-place">
				<form action="" method="post">
					<i style="color: white;" class="fa fa-user" aria-hidden="true"> <input type="text" name="username" maxlength="20"/></i>
					<i style="color: white;" class="fa fa-key" aria-hidden="true"> <input type="password" name="password" maxlength="25"/></i>
                    <input type="submit" name="Submit" value="login" class="quick-login-button" />
				</form>
			</div>
			<div class="greetings">Pozdrav gost ! Molimo <a href="register.php">registrujte</a> se ili se <a href="#login-place">prijavite</a>.</div>
			<?php } ?>
		</div>
		<?php if(isset($_SESSION['error_msg'] )){?>
			<?php echo '<div class="box-alert">'.$_SESSION['error_msg'] .'</div>';unset($_SESSION['error_msg']);?>
		<?php } ?>		
		<?php if(isset($_SESSION['success_msg'] )){?>
			<?php echo '<div class="box-success">'.$_SESSION['success_msg'] .'</div>';unset($_SESSION['success_msg']);?>
		<?php } ?>		
		<div class="main-content">
			<center>
				<h1>DONACIJSKI PAKETI</h1>
				<img src="assets/images/donacije/bronze.png"/>
				<img src="assets/images/donacije/silver.png"/>
				<img src="assets/images/donacije/gold.png"/>
			</center>
		</div>
		<div class="footer">
			<center><img class="logo" src="assets/images/logo-1.gif"/></center>
			<span class="credits-text">&copy; Copyright <?php echo date("Y"); ?> - All rights reserved - Designed and coded by <a href="#">Zekiloni</a></span>
			<!--<span class="time"><?php //echo date("H:i"); ?></span> -->
		</div>
	</div>
</body>