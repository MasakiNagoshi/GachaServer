<?php
//////////////////////////////////
//製作者　名越大樹
//ログインボーナスの情報をデータベースへ更新するクラス
//////////////////////////////////

class UpdatePresent
{
		private $loginCount;//int型
		private $present;//配列string型
		private $api;//APIMySQLクラス
		private $post;//PostProtocolクラス型
		
		function __construct($presentnumber,$logincount)
		{
			$this->Ini($presentnumber,$logincount);
			$this->Update();
		}
		
		private function Ini($presentnumber,$logincount)
		{
			global $apiMySQL;
			global $postProtocol;
			$this->api = $apiMySQL;
			$this->post = $postProtocol;
			$this->loginCount = $logincount;
			$this->present = $presentnumber;
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
			$this->api->RequestUpdateGachaTicket($param);
		}
		
		private function GetTicket()
		{
			$param = new RequestGetGachaTicket();
			$param->userId = $this->post->GetUserId();
			$response = $this->api->RequestGetGachaTicket($param);
			return $response;
		}		
}
?>