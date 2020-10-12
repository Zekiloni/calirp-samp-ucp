<?php	
	include 'includes/config.php'; 
	include 'includes/header.php';
	
	
	require_once 'classes/gtrs.class.php';
	$samp_info = new Gtrs($config['samp-adress'], $config['samp-port']);
	
	
	require_once 'classes/ucp_user.class.php';
	$ucp_user = new User();
	
	$password_yes = '<i class="fa fa-lock" aria-hidden="true"></i>'; // zakljucan
	$password_no = '<i class="fa fa-unlock-alt" aria-hidden="true"></i>'; // otkljucan
	if($aInformation['password'] == 0)
	{
		$server_locked = $password_no;
	}
	else
	{
		$server_locked = $password_yes;
	}
	
	
	if(isset($_POST['Submit']))
	{
		if(empty($_POST['username']))
			$_SESSION['error_msg'] = "Niste upisali korisnicku ime.";
		else if(empty($_POST['password']))
			$_SESSION['error_msg'] = "Niste upisali korisnicku sifru.";
		else
			$ucp_user->Login($_POST['username'], $_POST['password']);	
	}
	#echo '<pre>'; var_dump($_SESSION); echo '</pre>';
	#echo '<pre>'; var_dump($_COOKIE); echo '</pre>';
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
		<table class="server-info">
			<?php if($samp_info->isOnline()) { ?>
				<tr>
					<td><span style="color: #38c071;">Online</span></td> 
					<td>SA-MP IP <b><?php echo $config['samp-adress'];?>:<?php echo $config['samp-port'];?></b></td>
					<td>Players <b><?php echo $samp_info->Players(); ?> / <?php echo $samp_info->MaxPlayers(); ?></b></td> 
					<td>Mapname <b><?php echo $samp_info->Mapname(); ?></b></td> 
					<td>Status <b><?php echo $server_locked; ?></b></td>
				</tr>
			<?php } else { ?>
				<tr>
					<td><span style="color: red;">Offline</span></td>  
					<td>SA-MP IP <b><?php echo $config['samp-adress'];?>:<?php echo $config['samp-port'];?></b></td>
					<td>Players <b>/</b></td> 
					<td>Gamemode <b>/</b></td> 
					<td>Status <b>/</b></td>
				</tr>
			<?php } ?>
		</table>
		<div class="main-content">
			<?php 
			foreach($ucp_user->GetAllAnnouncement() as $obavijest)
			{
			?>
				<?php echo $obavijest['title'];?>
				<?php echo $obavijest['text'];?>
				<?php echo $obavijest['date'];?>
				<?php echo '<br>';?>
			<?php
			}
			?>
		</div>
		<div class="footer">
			<center><img class="logo" src="assets/images/logo-1.gif"/></center>
			<span class="credits-text">&copy; Copyright <?php echo date("Y"); ?> - All rights reserved - Designed and coded by <a href="#">Zekiloni</a></span>
			<!--<span class="time"><?php //echo date("H:i"); ?></span> -->
		</div>
	</div>
</body>