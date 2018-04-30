<?php
class GetAllNumbers
{
	private $api;
	private $post;
	private $mysqli;

	function __construct()
	{
		$this->Ini();
		$this->GetRequest();
	}
	
	private function Ini()
	{
		global $apiMySQL;
		global $postProtocol;
		$this->api = $apiMySQL;
		$this->post = $postProtocol;
		$mysqlInfo = MySQLSetting();
		$mysqlInfo->SetTableName("GachaUser");
		$this->mysqli = Connect($mysqlInfo->GetHostName(), $mysqlInfo->GetRoot(), $mysqlInfo->GetPassWord(), $mysqlInfo->GetDataBase());
	}

	private function GetRequest()
	{
		switch($this->post->GetRequest())
		{
			case "login":
			$this->GetLogin();			
			break;
			case "dictionary":
			$this->GetUserDictionary();
			break;
			case "ticket":
			$this->GetTicket();			
			break;
		}
	}
	
	private function GetUserDictionary()
	{
		$param = new RequestGetUserDictionary();
		$param->userId = $postProtocol->GetUserId();
		$response = $api->RequestGetUserDictionary($param,$mysqli);
		$output = "1,".$response->getNumbers;
		echo$output;		
	}
	
	private function GetLogin()
	{
		$param = new RequestGetUserLogin();
		$param->userId = $this->post->GetUserId();
		$response = $api->RequestGetUserLogin($param,$this->mysqli);
		$output = $response->isLogin;
		echo$output;
	}
	
	private function GetTicket()
	{
		$param = new RequestGetUserTicket();
		$param->userId = $this->post->GetUserId();
		$response = $api->RequestGetUserTicket($param,$this->mysqli);
		$output = "hoge";
		echo$output;
	}
	
}
?>