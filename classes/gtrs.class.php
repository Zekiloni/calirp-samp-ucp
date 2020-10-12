<?php
/***
* Gametracker.rs API JSON
* 
* @Author		Almir Kvakic - KvaX
* @Version		1.0
* @Date-Time	02/02/2017 - 22:00
*
***/ 
class Gtrs
{
	private $ip;	
	private $port;
 
	public function __construct($ip, $port)
	{
		$this->ip = $ip;
		$this->port = $port;
    }
	
	public function Status()
	{
		$result = json_decode(file_get_contents("http://api.gametracker.rs/demo/json/server_info/".$this->ip.":".$this->port.""));
		return $result->status;
	}	
	
	public function isOnline()
	{
		$result = json_decode(file_get_contents("http://api.gametracker.rs/demo/json/server_info/".$this->ip.":".$this->port.""));
		if($result->status == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function Players()
	{
		$result = json_decode(file_get_contents("http://api.gametracker.rs/demo/json/server_info/".$this->ip.":".$this->port.""));
		return $result->players;
	}	
	
	public function MaxPlayers()
	{
		$result = json_decode(file_get_contents("http://api.gametracker.rs/demo/json/server_info/".$this->ip.":".$this->port.""));
		return $result->playersmax;
	}		
	
	public function Gamemode()
	{
		$result = json_decode(file_get_contents("http://api.gametracker.rs/demo/json/server_info/".$this->ip.":".$this->port.""));
		return $result->modname;
	}	
	
	public function Mapname()
	{
		$result = json_decode(file_get_contents("http://api.gametracker.rs/demo/json/server_info/".$this->ip.":".$this->port.""));
		return $result->map;
	}	
}