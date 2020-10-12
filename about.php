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
				<form action="index.php" method="post">
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
			<?php if(empty($_GET['action'])) { ?>
			<a href="?action=about"><div class="redirect-btn">INFORMACIJE</div></a>
			<a href="?action=team"><div class="redirect-btn">TIM</div></a>
			<?php } if($_GET['action'] == 'about') { ?>
			<center>
			<h2>OSNIVANJE</h2>
			<p class="about-text">California Role Play (skraceno CRP, simbol C:RP) je San Andreas Multiplajer role play zajednica koja je zapocela sa radom u 25. avgust 2016. godine, oficijalno lansirana 30.08.2016. Osnivaci zajednice su je osnovali sa zeljom da igracima pruze sto bolju zabavu i role play.</p>
			<h2>SA-MP</h2>
			<p class="about-text">San Andreas Multiplayer, skraceno SA-MP, je besplatna modifikacija koja GTA:SA pretvara u multiplajer igru gde mozete igrati sa ostalim igracima sirom sveta. Tu su takodje serveri koji imaju dosta tipova igre(modova), kao sto su roleplay, dm, tdm, stunt, freeroam, rpg i ostali.<br></p>
			</center>
			<p style="font-family: 'Roboto', sans-serif; text-transform: uppercase; font-weight: 300; color: #d4d4d4; margin-left: 15px; font-size: 12px;">Zadnji Update <b>30.08.2016</b> - <b>2:10</b> od strane <b>Zekiloni</b></p>
			<?php } else if($_GET['action'] == 'team') { ?>
			<center><h2>CLANOVI TIMA</h2></center>
			<fieldset class="place">
				<legend class="place-title">Lead Management</legend>
				<span><a href="#"><b>Zekiloni</b></a> - Community Owner</span><br>
				<span><a href="#"><b>Deuce</b></a> - Community Owner</span><br>
				<span><a href="#"><b>Vucko</b></a> - Community Co-Owner</span><br>
				<span><a href="#"><b>/ /</b></a> - Community Lead Admin</span><br>
			</fieldset>
			<fieldset class="place">
				<legend class="place-title">Developement Team</legend>
				<span><a href="#"><b>Zekiloni</b></a> - Web / Game Developement</span><br>
				<span><a href="#"><b>Deuce</b></a> - Game Developement</span><br>
				<span><a href="#"><b>Vucko</b></a> - Game Developement</span><br>
			</fieldset>
			<fieldset class="place">
				<legend class="place-title">General Adminstrators (Admin 4)</legend>
				<span><a href="#"><b>/ /</b></a> - Zaduzenje</span><br>
			</fieldset>
			<fieldset class="place">
				<legend class="place-title">Senior Adminstrators (Admin 3)</legend>
				<span><a href="#"><b>/ /</b></a> - Zaduzenje</span><br>
				<span><a href="#"><b>/ /</b></a> - Zaduzenje</span><br>
			</fieldset>
			<fieldset class="place">
				<legend class="place-title">Junior Adminstrators (Admin 2)</legend>
				<span><a href="#"><b>/ /</b></a> - Marketing</span><br>
				<span><a href="#"><b>/ /</b></a> - Marketing</span><br>
				<span><a href="#"><b>/ /</b></a> - Marketing</span><br>
			</fieldset>
			<fieldset class="place">
				<legend class="place-title">Moderators (Admin 1)</legend>
				<span><a href="#"><b>Aci</b></a> - Zaduzenje</span><br>
				<span><a href="#"><b>Casey</b></a> - Zaduzenje</span><br>
				<span><a href="#"><b>Slaven</b></a> - Zaduzenje</span><br>
				<span><a href="#"><b>Soap</b></a> - Zaduzenje</span><br>
				<span><a href="#"><b>Bogi</b></a> - Zaduzenje</span><br>
				<span><a href="#"><b>Dema</b></a> - Zaduzenje</span><br>
				<span><a href="#"><b>Calvio</b></a> - Zaduzenje</span><br>
				<span><a href="#"><b>Granth</b></a> - Zaduzenje</span><br>
			</fieldset>
			<fieldset class="place">
				<legend class="place-title">Helpers</legend>
				<span><a href="#"><b>/ /</b></a> - Zaduzenje</span><br>
				<span><a href="#"><b>/ /</b></a> - Zaduzenje</span><br>
				<span><a href="#"><b>/ /</b></a> - Zaduzenje</span><br>
				<span><a href="#"><b>/ /</b></a> - Zaduzenje</span><br>
				<span><a href="#"><b>/ /</b></a> - Zaduzenje</span><br>
				<span><a href="#"><b>/ /</b></a> - Zaduzenje</span><br>
				<span><a href="#"><b>/ /</b></a> - Zaduzenje</span><br>
			</fieldset>
			<p style="font-family: 'Roboto', sans-serif; text-transform: uppercase; font-weight: 300; color: #d4d4d4; margin-left: 15px; font-size: 12px;">Zadnji Update <b>30.08.2016</b> - <b>15:31</b> od strane <b>Zekiloni</b></p>
			<?php } ?>
		</div>
		<div class="footer">
			<center><img class="logo" src="assets/images/logo-1.gif"/></center>
			<span class="credits-text">&copy; Copyright <?php echo date("Y"); ?> - All rights reserved - Designed and coded by <a href="#">Zekiloni</a></span>
			<!--<span class="time"><?php //echo date("H:i"); ?></span> -->
		</div>
	</div>
</body>