<?php	
	include 'includes/config.php'; 
	include 'includes/header.php';
	
	/* UCP User klasa */
	require_once 'classes/ucp_user.class.php';
	$ucp_user = new User();
	
	/* Provjera da li je logovan */
	if(!$ucp_user->IsLogged())
	{
		header('location: index.php');
		exit();
	}
	
	/* Provjera da li je banovan */
	if($ucp_user->IsBanned($_SESSION['username']))
	{
        session_destroy();
		header('location: index.php');
		exit();
	}
	/* Proces updejt profila */
	if(isset($_POST['settings_submit']))
	{
		if(empty($_POST['email']))
			$_SESSION['error_msg'] = "Niste upisali email adresu!";
		else if(empty($_POST['tpassword']))
			$_SESSION['error_msg'] = "Niste upisali trenutnu sifru!";
		else if(empty($_POST['npassword']))
			$_SESSION['error_msg'] = "Niste upisali novu sifru!";
		else if(empty($_POST['sig_pitanje']))
			$_SESSION['error_msg'] = "Niste upisali sigurnosno pitanje!";
		else if(empty($_POST['sig_odgovor']))
			$_SESSION['error_msg'] = "Niste upisali odgovor na sigurnosno pitanje!";
		else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
			$_SESSION['error_msg'] = "Email adresu koju ste upisali nije validna!";
		else if(!preg_match('/\.(jpg|jpeg|png|gif|svg)(?:[\?\#].*)?$/i', $_POST['avatar'], $matches))
			$_SESSION['error_msg'] = "URL Avatara koji ste unijeli nije u formatu .png, .jpg, .jpeg, .svg ili .gif!";
		else
			$ucp_user->UpdateProfile(
					$_POST['email'],
					$_SESSION['username'],
					$_POST['tpassword'],
					$_POST['npassword'],
					$_POST['sig_pitanje'],
					$_POST['sig_odgovor'],
					$_POST['avatar']
				);	
	}	
	
	/* Proces updejt max_karaktera */
	if(isset($_POST['settings_maxkaraktera']))
	{
		if(empty($_POST['max_characeters']))
			$_SESSION['error_msg'] = "Niste upisali broj max. karaktera!";
		else
			$ucp_user->UpdateSettings($_SESSION['username'], 'max_characters', $_POST['max_characeters']);	
	}
	/* Proces obavijesti */
	if(isset($_POST['obavijest_submit']))
	{
		if(empty($_POST['obavijest_naslov']))
			$_SESSION['error_msg'] = "Niste upisali naslov obavijesti!";
		else if(empty($_POST['obavijest_text']))
			$_SESSION['error_msg'] = "Niste upisali text obavijesti!";
		else
			$ucp_user->CreateAnnouncement($_SESSION['username'], $_POST['obavijest_naslov'], $_POST['obavijest_text']);
	}
	/* Proces banovanja */
	if(isset($_POST['ban']))
	{
		if(empty($_POST['ban_id']))
			$_SESSION['error_msg'] = "Niste unijeli korisnika kojeg zelite banovati!";
		else if(empty($_POST['ban_reason']))
			$_SESSION['error_msg'] = "Niste unijeli razlog bana!";
		else
			$ucp_user->Ban($_SESSION['username'], $_POST['ban_id'], $_POST['ban_reason']);
	}
	/* Proces unbanovanja */
	if(isset($_POST['unban']))
	{
		if(empty($_POST['unban_id']))
			$_SESSION['error_msg'] = "Niste unijeli korisnika kojeg zelite unbanovati!";
		else
			$ucp_user->UnBan($_SESSION['username'], $_POST['unban_id']);
	}
?>
		<div class="under-cover">
			<?php
				if($ucp_user->IsLogged()) 
				{
			?>
				<div id="login-place" class="login-place">
					<a href="?page=admin-panel"><div class="button">Admin Panel</div></a>
					<a href="?page=settings"><div class="button">Podesavanja</div></a>
					<a href="logout.php"><div style="background: #bb0000;" class="button">Logout</div></a>
				</div>
				<div class="greetings">Pozdrav <a href="#"><b><?php echo $_SESSION['username']; ?></b></a>, dobrodosli na korisnicki panel.</div>
		</div>
		<?php 
				}
			?>
			<?php if(isset($_SESSION['error_msg'] )){?>
			<?php echo '<div class="box-alert">'.$_SESSION['error_msg'] .'</div>';unset($_SESSION['error_msg']);?>
			<?php } ?>		
			<?php if(isset($_SESSION['success_msg'] )){?>
			<?php echo '<div class="box-success">'.$_SESSION['success_msg'] .'</div>';unset($_SESSION['success_msg']);?>
			<?php } ?>
		<div class="main-content">
			<?php 
				if(empty($_GET['page']))
				{
			?>
					<div class="info-box">
						<img class="skin-box" src="assets/images/skinovi/21.png"/>
						<div class="info-holder">
							<span class="info-title">Statistika</span>
							<p class="info-text">Pol: <b>Musko</b><br>Datum rodjenja: <b>11.06.1992 (24 godine)</b><br>Poreklo: <b>Los Angeles, CA</b><br>Telefon: <b>Da (665437)</b><br>Posao: <b>Gradjevinar</b><br>Vencan: <b>Da - Nicole Parker</b><br>Organizacija: <b>/</b><br></p>
						</div>
						<div class="info-holder">
							<span class="info-title">Imovina</span>
							<p class="info-text">Novac: <b>9400$</b><br>Bankovni racun: <b>50000$</b><br>Stedna knjizica: <b>1400000$</b><br>Plata: <b>13000$</b><br>Kuca: <b>Hollywood Hills, 34</b><br>Biznis: <b>NIGHT CLUB 'Octopuss', 61</b><br>Stan: <b>Ne poseduje</b><br></p>
						</div>
						<div class="info-holder">
							<span class="info-title">Vozila</span>
							<p class="info-text">Vozila 1: <b>Sultan (1135)</b><br>Vozilo 2: <b>Nevada (1146)</b><br>Vozilo 3: <b>Tropic (1182)</b><br>Vozilo 4: <b>Ne poseduje</b><br>DODAVACE SE SLOTOVI<br></p>
						</div>
						<div class="info-holder">
							<span class="info-title">OOC Stats</span>
							<p class="info-text">Email: <b>zekirija2001@hotmail.com</b><br>Level: <b>5</b><br>Respekti: <b>26 / 40</b><br>Sati igre: <b>88</b><br>Zadnji put vidjeni: <b>27.08.2016 - 17:32</b><br>Pozicija: <b>Admin 6(Owner)</b><br>Donator Rank: <b>Nema</b></p>
						</div>
					</div>
					<div class="info-box">
						<span class="info-title">Oruzije</span><br><br>
						<center>
							<img src="assets/images/oruzija/weapon-0.png" width="75" height="75"/>
							<img src="assets/images/oruzija/weapon-4.png" width="75" height="75"/>
							<img src="assets/images/oruzija/weapon-3.png" width="75" height="75"/>
							<img src="assets/images/oruzija/weapon-2.png" width="75" height="75"/>
							<img src="assets/images/oruzija/weapon-1.png" width="75" height="75"/>
							<img src="assets/images/oruzija/weapon-0.png" width="75" height="75"/>
							<img src="assets/images/oruzija/weapon-0.png" width="75" height="75"/>
							<img src="assets/images/oruzija/weapon-0.png" width="75" height="75"/>
							<img src="assets/images/oruzija/weapon-0.png" width="75" height="75"/>
							<img src="assets/images/oruzija/weapon-0.png" width="75" height="75"/>
						</center>
					</div>
					<fieldset class="place">
						<legend class="place-title">SIGNATURA</legend>
						<center><img src="assets/images/signature-1.png"/></center><br>
						<center><img src="assets/images/signature-2.png"/></center>
					</fieldset>
			<?php
				}
				else if($_GET['page'] == 'settings')
				{
			?>
				<div class="info-box">
					<h2>PODESAVANJE RACUNA</h2>
					<form id="register-place" class="login-place" method="POST">
						<div class="register-holder">
							<label for="avatar">Profilna slika</label><br>
							<input type="text" id="avatar" name="avatar" placeholder="Unesite link (.png, .gif, .jpg)"><br>
							<img style="margin-top: 5px;" src="<?php echo $ucp_user->GetAvatarURL($_SESSION['username']);?>" width="50" height="50"/>	
						</div>
						<div class="register-holder">
							<label for="email">Email</label><br>
							<input type="email" id="email" name="email" value="<?php echo $ucp_user->GetEmail($_SESSION['username']);?>" required="required"><br>
						</div>
						<div class="register-holder">
							<label for="sig_pitanje">Sigurnosno pitanje</label><br>
							<input type="text" id="sig_pitanje" name="sig_pitanje" value="<?php echo $ucp_user->GetSecretQuestion($_SESSION['username']);?>" required="required"><br>
						</div>
						<div class="register-holder">
							<label for="sig_odgovor">Odgovor na sigurnosno pitanje</label><br>
							<input type="text" id="sig_odgovor" name="sig_odgovor" value="<?php echo $ucp_user->GetSecretAnswer($_SESSION['username']);?>" required="required"><br>	
						</div>
						<div class="register-holder">
							<label for="tpassword">Nova sifra</label><br>
							<input type="password" id="npassword" name="npassword" placeholder="Nova sifra" required="required"><br>
						</div>
						<div class="register-holder">
							<label for="tpassword">Trenutna sifra</label><br>
							<input type="password" id="tpassword" name="tpassword" placeholder="Potvrdite trenutnu sifru" required="required"><br>	
						</div>
							<div class="register-holder">
							<input type="submit" name="settings_submit" value="Sacuvaj">
						</div>
					</form>
					<table class="server-info">
						<thead>
							<tr>
								<th><b>Date</b></th>
								<th><b>Adress</b></th> 
							</tr>
						</thead>
						<tbody>
							<?php foreach($ucp_user->LastLoginLog($_SESSION['username']) as $log) { ?>
							<tr>
								<td><?php echo $log['date'];?></td>
								<td><?php echo $log['ip'];?></td> 
							</tr>
							<?php } ?>
						</tbody>
					</table>
					</div>
			<?php 
				} 
				else if($_GET['page'] == 'admin-panel')
				{
					if(!$ucp_user->IsAdmin($_SESSION['username']))
					{
						header('location: panel.php');
						exit();
					}
			?>
					<div class="info-box">
						<h2>ADMINISTRATORSKI PANEL</h2>
						<form class="login-place" method="POST">
							<div class="register-holder">
								<label for="max_characeters">Maksimalno Karaktera</label><br>
								<input type="text" id="max_characeters" name="max_characeters" value="<?php echo $ucp_user->GetSettingsValue("max_characters");?>" required="required"><br>	
							</div>
								<div class="register-holder">
								<input type="submit" name="settings_maxkaraktera" value="Sacuvaj">
							</div>
						</form>
						<form class="login-place" method="POST">
							<div class="register-holder">
								<label for="obavijest_naslov">Naslov obavijesti</label><br>
								<input type="text" id="obavijest_naslov" name="obavijest_naslov" required="required"><br>
								<label for="obavijest_text">Tekst obavijesti</label><br>
								<textarea rows="4" cols="50" id="obavijest_text" name="obavijest_text" required="required">
								</textarea>
							</div>
								<div class="register-holder">
								<input type="submit" name="obavijest_submit" value="Posalji">
							</div>
						</form>						
						<form class="login-place" method="POST">
							<div class="register-holder">
								<label for="ban_id">Banuj</label><br>
								<select name="ban_id">
								<?php 
									foreach($ucp_user->GetAllUsers() as $user)
									{
								?>
										<option value="<?php echo $user['id'];?>"><?php echo $user['username'];?></option>
								<?php
									}
								?>
								</select><br>
								<label for="ban_reason">Razlog</label><br>
								<input type="text" id="ban_reason" name="ban_reason" required="required"><br>
								</textarea>
							</div>
								<div class="register-holder">
								<input type="submit" name="ban" value="Posalji">
							</div>
						</form>
						<form class="login-place" method="POST">
							<div class="register-holder">
								<label for="unban_id">Unbanuj</label><br>
								<select id="unban_id" name="unban_id">
								<?php 
									foreach($ucp_user->GetAllBannedUsers() as $user)
									{
								?>
										<option value="<?php echo $user['id'];?>"><?php echo $user['username'];?></option>
								<?php
									}
								?>
								</select><br>
								</textarea>
							</div>
								<div class="register-holder">
								<input type="submit" name="unban" value="Posalji">
							</div>
						</form>
					</div>
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