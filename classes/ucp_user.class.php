<?php	
/***
* California Role Play - CONFIG FILE
* 
* @Author		Almir Kvakic - KvaX
* @Version		1.0
* @Date-Time	02/02/2017 - 22:00
*
***/ 
session_start();
require 'ucp_db.class.php';

class User
{
    public function __construct()
    {
        $this->db = new Db();
	}
	
/* OSNOVNO */	
	public function IsLogged()
	{
		if(isset($_SESSION['logged']))
		{
			if($_SESSION['logged'] == true)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
		return false;
	}
	
	public function IsBanned($username)
	{
		$username = $this->db->quote($username);
		$result   = $this->db->select("SELECT * FROM `users` WHERE `username` = '$username'");
		if($result[0]['ban'] == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
		return false;
	}
	
	public function BannedReason($username)
	{
		$username = $this->db->quote($username);
		$result   = $this->db->select("SELECT * FROM `users` WHERE `username` = '$username'");
		return $result[0]['ban_reason'];
	}
	
	public function IsAdmin($username)
	{
		$username = $this->db->quote($username);
		$result   = $this->db->select("SELECT * FROM `users` WHERE `username` = '$username'");
		if($result[0]['ucp_rank'] == 3)
		{
			return true;
		}
		else
		{
			return false;
		}
		return false;		
	}
	
	public function Login($username, $password)
	{
		$username = $this->db->quote($username);
		$password = $this->db->quote($password);
		$password = $this->Whirlpool($password);
		if($_COOKIE['login_pokusaji'] <= 2)
		{
			if($this->db->exists("users", "username", $username))
			{
				$result = $this->db->select("SELECT * FROM `users` WHERE `username` = '$username'");
				if($result[0]['password'] == $password)
				{
					if($this->IsBanned($username))
					{
						$_SESSION['error_msg'] = "Vi ste banovani od strane administratora. Razlog bana: ".$this->BannedReason($username)."";
					}
					else
					{	
						$_SESSION['logged']   = true;
						$_SESSION['username'] = $username;
						$this->db->query("UPDATE `users` SET `last_ip` = '".$this->getRealIpAddr()."', `lastactivity_date` = '".date("Y-m-d H:i:s")."', `session_id` = '".session_id()."' WHERE `username` = '".$username."';");
						$this->db->query("INSERT INTO `login_logs` (`id`, `user_id`, `ip`, `date`, `useragent`, `os`) VALUES (NULL, '".$result[0]['id']."', '".$this->getRealIpAddr()."', '".date("Y-m-d H:i:s")."', '".$this->getUserAgent()."', '');");
						$_SESSION['success_msg'] = "Uspesno ste logirani. Preusmjeravamo vas... <meta http-equiv='refresh' content='5; url=".$this->GetFullURL()."/panel.php'>";
						#header("Location: panel.php");
						#exit();
					}
				}
				else
				{
					setcookie("login_pokusaji", $_COOKIE['login_pokusaji']+1, time() + (60 * 10)); // 60 * 10 = 10 minuta
					$_SESSION['error_msg'] = "Sifra koju ste unijeli nije tacna!";
				}
				
			}
			else
			{
				$_SESSION['error_msg'] = "Korisnicko ime koje ste unijeli ne postoji!";
				return true;
			}
		}
		else
		{
			$_SESSION['error_msg'] = "Ukucali ste netacnu sifru 3 puta pa ste stoga banovani na 10 minuta!";
		}
		return false;
	}
	
	public function Register($username, $email, $password, $ppassword, $sig_pitanje, $sig_odgovor, $captcha)
	{
		$username    = $this->db->quote($username);
		$email       = $this->db->quote($email);
		$password    = $this->db->quote($password);
		$ppassword   = $this->db->quote($ppassword);
		$sig_pitanje = $this->db->quote($sig_pitanje);
		$sig_odgovor = $this->db->quote($sig_odgovor);
		$captcha     = $this->db->quote($captcha);
		if(!$this->db->exists("users", "username", $username))
		{
			if(!$this->db->exists("users", "email", $email))
			{
				#provjera da li je sifra duza od 8 karaktera
				if(strlen($password) < 8)
				{
					$_SESSION['error_msg'] = "Sifra mora biti duza od 8 karaktera!";
					$greska = true;
				}
				
				#provjera da li se sifre podudaraju
				if($password != $ppassword)
				{
					$_SESSION['error_msg'] = "Unesene sifre se ne podudaraju!";
					$greska = true;
				}
				
				#provjera da li je tacna captcha
				if($_SESSION['captcha_code'] != $captcha)
				{
					$_SESSION['error_msg'] = "Odgovor na Captchu nije tacan!";
					$greska = true;					
				}
				
				if(!$greska)
				{
					$password = $this->Whirlpool($password);
					$result = $this->db->query("INSERT INTO `california_rp`.`users` (`id`, `username`, `password`, `email`, `sig_pitanje`, `sig_odgovor`, `register_date`, `lastactivity_date`, `last_ip`, `session_id`, `ucp_rank`) VALUES (NULL, '".$username."', '".$password."', '".$email."', '".$sig_pitanje."', '".$sig_odgovor."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."', '".$this->getRealIpAddr()."', '".session_id()."', '0');");
					if($result)
					{
						$_SESSION['success_msg'] = "<b>Uspjesno ste se registrovali!</b><br>Preusmjeravamo vas...<meta http-equiv='refresh' content='5; url=".$this->GetFullURL()."/index.php'>";
						$this->CreateLog($username, 'Registracija', "Korisnik ".$username." se registrovao!");
					}
					else
					{
						$_SESSION['error_msg'] = "<b>GRESKA!</b><br>Pokusajte ponovo kasnije.";
					}
				}
			}
			else
			{
				$_SESSION['error_msg'] = "Unesenu email adresu vec neko koristi!";
			}
		}
		else
		{
			$_SESSION['error_msg'] = "Uneseno korisnicko ime vec neko koristi!";
		}
	}
	
	public function UpdateProfile($email, $username, $tpassword, $npassword, $sig_pitanje, $sig_odgovor, $avatar)
	{
		$email          = $this->db->quote($email);
		$username       = $this->db->quote($username);
		$tpassword      = $this->db->quote($tpassword);
		$npassword      = $this->db->quote($npassword);
		$sig_pitanje    = $this->db->quote($sig_pitanje);
		$sig_odgovor    = $this->db->quote($sig_odgovor);
		$avatar         = $this->db->quote($avatar);
		
		#provjera trenutne sifre
		$sifra_query = $this->db->select("SELECT * FROM `users` WHERE `username` = '$username'");
		if($sifra_query[0]['password'] != $this->Whirlpool($tpassword))
		{
			$_SESSION['error_msg'] = "Trenutnu sifru koju ste unijeli nije tacna!";
			$greska = true;
		}
		
		#provjera da li je sifra duza od 8 karaktera
		if(strlen($npassword) < 8)
		{
			$_SESSION['error_msg'] = "Sifra mora biti duza od 8 karaktera!";
			$greska = true;
		}
		
		#provjera da li je nova sifra unijeta 
		if(isSet($npassword))
		{
			$npassword = $this->Whirlpool($npassword);
		}
		else
		{
			$npassword = $sifra_query[0]['password'];
		}
		
		if(!$greska)
		{
			$result = $this->db->query("UPDATE `users` SET `email` = '".$email."', `sig_pitanje` = '".$sig_pitanje."', `sig_odgovor` = '".$sig_odgovor."', `password` = '".$npassword."', `avatar` = '".$avatar."'  WHERE `username` = '".$username."'");
			if($result)
			{
				$_SESSION['success_msg'] = "Uspjesno ste izmjenili postavke!";
				$this->CreateLog($username, 'Izmjena Profila', "Korisnik ".$username." je promjenio postavke profila!");
			}
			else
			{
				$_SESSION['error_msg'] = "<b>GRESKA!</b><br>Pokusajte ponovo kasnije.";
			}
		}
	}
	
/* ADMIN PANEL */
	public function UpdateSettings($username, $setting_name, $setting_value)
	{
		$value  = $this->db->quote($value);
		$result = $this->db->query("UPDATE `settings` SET `setting_value` = '".$setting_value."' WHERE `setting_name` = '".$setting_name."'");
		if($this->IsAdmin($username))
		{
			if($result)
			{
				$_SESSION['success_msg'] = "Uspjesno ste izmjenili postavku!";
				$this->CreateLog($username, "Postavka", "Admin ".$username." je izmjenio postavku ".$setting_name."");
			}
			else
			{
				$_SESSION['error_msg'] = "<b>GRESKA!</b><br>Pokusajte ponovo kasnije.";
			}
		}
		else
		{
			$_SESSION['error_msg'] = "<b>GRESKA!</b><br>Vi niste administrator, ne pokusaji ne ide!";
		}
 	}
	
	public function GetSettingsValue($setting_name)
	{
		$setting_name = $this->db->quote($setting_name);
		$result       = $this->db->select("SELECT * FROM `settings` WHERE `setting_name` = '".$setting_name."'");
		return $result[0]['setting_value'];
	}
	
	public function CreateAnnouncement($username, $title, $text)
	{
		$username = $this->db->quote($username);
		$title    = $this->db->quote($title);
		$text     = $this->db->quote($text);
		if($this->IsAdmin($username))
		{
			$result   = $this->db->query("INSERT INTO `announcements` (`id`, `title`, `text`, `date`, `by`, `visible`) VALUES (NULL, '".$title."', '".$text."', '".date("Y-m-d H:i:s")."', '".$username."', '1');");
			if($result)
			{
				$_SESSION['success_msg'] = "Uspjesno ste dodali obavijest!";
			}
			else
			{
				$_SESSION['error_msg'] = "<b>GRESKA!</b><br>Pokusajte ponovo kasnije.";
			}
		}
		else
		{
			$_SESSION['error_msg'] = "<b>GRESKA!</b><br>Vi niste administrator, ne pokusaji ne ide!";
		}
	}
	
	public function GetAllUsers()
	{
		$result = $this->db->select("SELECT * FROM `users`");
		return $result;
	}	
	
	public function GetAllBannedUsers()
	{
		$result = $this->db->select("SELECT * FROM `users` WHERE `ban` ='1'");
		return $result;
	}
	
	public function Ban($username, $ban_id, $ban_reason)
	{
		$ban_id     = $this->db->quote($ban_id);
		$ban_reason = $this->db->quote($ban_reason);
		if($this->IsAdmin($username))
		{
			$result     = $this->db->query("UPDATE `users` SET `ban` = '1', `ban_reason` = '".$ban_reason."' WHERE `id` = '".$ban_id."'");
			if($result)
			{
				$_SESSION['success_msg'] = "Uspjesno ste banovali korisnika sa ID: ".$ban_id."";
				$this->CreateLog($username, "Ban", "Admin ".$username." je banovao korisnika sa ID: ".$ban_id."");
			}
			else
			{
				$_SESSION['error_msg'] = "<b>GRESKA!</b><br>Pokusajte ponovo kasnije.";
			}
		}
		else
		{
			$_SESSION['error_msg'] = "<b>GRESKA!</b><br>Vi niste administrator, ne pokusaji ne ide!";
		}
	}
	
	public function UnBan($username, $unban_id)
	{
		$unban_id     = $this->db->quote($unban_id);
		if($this->IsAdmin($username))
		{
			$result    	  = $this->db->query("UPDATE `users` SET `ban` = '0', `ban_reason` = '0' WHERE `id` = '".$unban_id."'");
			if($result)
			{
				$_SESSION['success_msg'] = "Uspjesno ste unbanovali korisnika sa ID: ".$unban_id."";
				$this->CreateLog($username, "Unban", "Admin ".$username." je unbanovao korisnika sa ID: ".$unban_id."");
			}
			else
			{
				$_SESSION['error_msg'] = "<b>GRESKA!</b><br>Pokusajte ponovo kasnije.";
			}
		}
		else
		{
			$_SESSION['error_msg'] = "<b>GRESKA!</b><br>Vi niste administrator, ne pokusaji ne ide!";
		}
	}
	
	public function CreateLog($log_by, $log_action, $log_text)
	{
		$log_action = $this->db->quote($log_action);
		$log_text   = $this->db->quote($log_text);
		$result     = $this->db->query("INSERT INTO `logs` (`id`, `action`, `text`, `by`, `date`) VALUES ('', '".$log_action."', '".$log_text."', '".$log_by."', '".date("Y-m-d H:i:s")."')");
	}
/* OSTALO */
	public function GetAllAnnouncement()
	{
		$result = $this->db->select("SELECT * FROM `announcements` WHERE `visible` = 1 LIMIT 5");
		return $result;
	}
	
	public function LastLoginLog($username)
	{
		$id     = $this->GetIDFromUsername($username);
		$result = $this->db->select("SELECT * FROM `login_logs` WHERE `user_id` = '".$id."'");
		return $result;
	}
	
	public function GetEmail($username)
	{
		$result = $this->db->select("SELECT * FROM `users` WHERE `username` = '$username'");
		return $result[0]['email'];
	}	
	
	public function GetAvatarURL($username)
	{
		$result = $this->db->select("SELECT * FROM `users` WHERE `username` = '$username'");
		return $result[0]['avatar'];
	}
	
	public function GetSecretQuestion($username)
	{
		$result = $this->db->select("SELECT * FROM `users` WHERE `username` = '$username'");
		return $result[0]['sig_pitanje'];
	}	
	
	public function GetSecretAnswer($username)
	{
		$result = $this->db->select("SELECT * FROM `users` WHERE `username` = '$username'");
		return $result[0]['sig_odgovor'];
	}
	
	public function GetIDFromUsername($username)
	{
		$result = $this->db->select("SELECT * FROM `users` WHERE `username` = '$username'");
		return $result[0]['id'];
	}
	public function getRealIpAddr()
	{
		if(!empty($_SERVER['HTTP_CF_CONNECTING_IP']))
		{
			$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
		} elseif (!empty($_SERVER['HTTP_CLIENT_IP']))
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
		
	public function getUserAgent()
	{
		return $_SERVER["HTTP_USER_AGENT"];
	}
	
	public function getUserOS()
	{
		$useragent = $_SERVER["HTTP_USER_AGENT"];
		$user_load = $this->url("http://www.useragentstring.com/?uas=".urlencode($useragent)."&getJSON=all", 5);
		$user_load = json_decode($user_load);
		$os = $user_load->os_type." (".$user_load->os_name.")";
		return $os;
	}
	
	public function url($url, $timeout)
	{
		//$timeout = 10;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	} 
	
	public function GetFullURL()
	{
		$fullurl = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
		return $fullurl;
	}
	
	public function Whirlpool($value)
	{
		return hash('whirlpool', $value);
	}
}
?>