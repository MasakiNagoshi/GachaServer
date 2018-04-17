<?php

class UpdatePresent
{
		private $loginCount;
		private $present;
		private $api;
		private $mysqli;
		private $post;
		
		function __construct($presentnumber,$logincount,$mysqliobj)
		{
			$this->Ini($presentnumber,$logincount,$mysqliobj);
			$this->Update();
		}
		
		private function Ini($presentnumber,$logincount,$mysqliobj)
		{
			global $apiMySQL;
			global $postProtocol;
			$this->api = $apiMySQL;
			$this->post = $postProtocol;
			$this->loginCount = $logincount;
			$this->present = $presentnumber;
			$this->mysqli = $mysqliobj;			
		}
		
		private function Update()
		{
			$presentNumber = split(":",$this->present);
			$this->UpdateTicket($presentNumber[0],$presentNumber[1]);
		}
		
		private function UpdateTicket($rate,$count)
		{
			$response = $this->GetTicket();
			switch($rate)
			{
				case "1":
				$response->normal += intval($count);
				break;
				case "2":
				$response->specal += intval($count);
				break;
			}
			$param = new RequestUpdateGachaTicket();
			$param->userId = $response->userId;
			$param->normal = $response->normal;
			$param->specal = $response->specal;
			$this->api->RequestUpdateGachaTicket($param,$this->mysqli);
		}
		
		private function GetTicket()
		{
			$param = new RequestGetGachaTicket();
			$param->userId = $this->post->GetUserId();
			$response = $this->api->RequestGetGachaTicket($param,$this->mysqli);
			return $response;
		}		
}
?>