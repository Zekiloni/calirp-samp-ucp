<?php	
	include 'includes/config.php'; 
	include 'includes/header.php';
	
	/* UCP User klasa */
	require_once 'classes/ucp_user.class.php';
	$ucp_user = new User();
	
	/* Provjera da li je logovan */
	if($ucp_user->IsLogged())
	{
		header('location: panel.php');
		exit();
	}
	
	/* Proces registracije */
	if(isset($_POST['submit']))
	{
		if(empty($_POST['username']))
			$_SESSION['error_msg'] = "Niste upisali korisnicku ime!";
		else if(empty($_POST['email']))
			$_SESSION['error_msg'] = "Niste upisali email adresu!";
		else if(empty($_POST['password']))
			$_SESSION['error_msg'] = "Niste upisali korisnicku sifru!";
		else if(empty($_POST['ppassword']))
			$_SESSION['error_msg'] = "Niste upisali potvrdu korisnicke sifru!";
		else if(empty($_POST['sig_pitanje']))
			$_SESSION['error_msg'] = "Niste upisali sigurnosno pitanje!";
		else if(empty($_POST['sig_odgovor']))
			$_SESSION['error_msg'] = "Niste upisali odgovor na sigurnosno pitanje!";
		else if(empty($_POST['captcha']))
			$_SESSION['error_msg'] = "Niste upisali brojeve sa slike!";
		else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
			$_SESSION['error_msg'] = "Email adresu koju ste upisali nije validna!";
		else
			$ucp_user->Register(
					$_POST['username'],
					$_POST['email'],
					$_POST['password'],
					$_POST['ppassword'],
					$_POST['sig_pitanje'],
					$_POST['sig_odgovor'],
					$_POST['captcha']
				);	
	}
?>
			<?php if(isset($_SESSION['error_msg'] )){?>
			<?php echo '<div class="box-alert">'.$_SESSION['error_msg'] .'</div>';unset($_SESSION['error_msg']);?>
			<?php } ?>		
			<?php if(isset($_SESSION['success_msg'] )){?>
			<?php echo '<div class="box-success">'.$_SESSION['success_msg'] .'</div>';unset($_SESSION['success_msg']);?>
			<?php } ?>
		</div>
		<div class="main-content">
			<div class="info-box">
				<h2>REGISTRACIJA</h2>
				<form id="register-place" class="login-place" method="POST">
					<div class="register-holder">
						<label for="username">Username<br>
						<input type="text" name="username" id="username" placeholder="Korisinicko ime" required="required"><br>
					</div>
					<div class="register-holder">
						<label for="email">Email</label><br>
						<input type="email" name="email" id="email" placeholder="example@example.com" required="required"><br>
					</div>	
					<div class="register-holder">
						<label for="password">Sifra</label><br>
						<input type="password" name="password" id="password" placeholder="Korisnicka sifra" required="required"><br>
					</div>	
					<div class="register-holder">
						<label for="ppassword">Potvrdite sifru</label><br>
						<input type="password" name="ppassword" id="ppassword" placeholder="Ponovite korisnicku sifra"" required="required"><br>
					</div>
					<div class="register-holder">
						<label for="sig_pitanje">Sigurnosno pitanje</label><br>
						<input type="text" name="sig_pitanje" id="sig_pitanje" placeholder="npr. Gdje ste rodjeni?" required="required"><br>
					</div>
					<div class="register-holder">
						<label for="sig_odgovor">Odgovor na sigurnosno pitanje</label><br>
						<input type="text" name="sig_odgovor" id="sig_odgovor" placeholder="Beograd" required="required"><br>
					</div>
					<div class="register-holder">
						<label for="captcha">Potvrdite da niste robot:</label><br>
						<img src="includes/captcha.php"><br>
						<input style="margin-top: 5px;" type="text" name="captcha" id="captcha" required="required"><br>
					</div>
					<input type="submit" name="submit" value="Registracija">
				</form>	
			</div>
		</div>
		<div class="footer">
			<center><img class="logo" src="assets/images/logo-1.gif"/></center>
			<span class="credits-text">&copy; Copyright <?php echo date("Y"); ?> - All rights reserved - Designed and coded by <a href="#">Zekiloni</a></span>
			<!--<span class="time"><?php //echo date("H:i"); ?></span> -->
		</div>
	</div>
</body>