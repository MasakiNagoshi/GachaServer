<?php
require_once("OutPut.php");
class GetRequest extends OutPut
{
	private $api;//APIMySQLクラス
	private $post;//PostProtocolクラス
	private $mysqli;//mysqliオブジェクト型

	function __construct()
	{
		$this->Ini();
		$this->Request();
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

	private function Request()
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
	
	///////////////////////////////////////
	//ユーザーの図鑑情報を取得する処理
	////////////////////////////////////////
	private function GetUserDictionary()
	{
		$param = new RequestGetUserDictionary();
		$param->userId = $this->post->GetUserId();
		$response = $this->api->RequestGetUserDictionary($param,$this->mysqli);
		$this->OutputDictionary($response);
	}
	
	private function GetLogin()
	{
		$param = new RequestGetUserLogin();
		$param->userId = $this->post->GetUserId();
		$response = $this->api->RequestGetUserLogin($param,$this->mysqli);
		if($response->isLogin == false)
		{
			$this->UpdateLogin();
		}
		$this->OutputLogin($response);
	}
	
	private function UpdateLogin()
	{
		$param = new RequestUpdateGachaLogin();
		$param->userId = $this->post->GetUserId();
		$param->isLogin = true;
		$this->api->RequestUpdateGachaLogin($param,$this->mysqli);
	}

	private function GetTicket()
	{
		$param = new RequestGetGachaTicket();
		$param->userId = $this->post->GetUserId();
		$response = $this->api->RequestGetGachaTicket($param,$this->mysqli);
		$this->OutputTicket($response);
	}
	
}
?>