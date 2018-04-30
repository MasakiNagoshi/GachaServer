<?php
////////////////////////////////////
//製作者　名越大樹
//ユーザー情報を取得するクラス
////////////////////////////////////

class GetRequest extends OutPut
{
	private $api;//APIMySQLクラス
	private $post;//PostProtocolクラス

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
		$response = $this->api->RequestGetUserDictionary($param);
		$this->OutputDictionary($response);
	}
	
	////////////////////////////////////////
	//ユーザーのログイン情報を取得する処理
	////////////////////////////////////////
	private function GetLogin()
	{
		$param = new RequestGetUserLogin();
		$param->userId = $this->post->GetUserId();
		$response = $this->api->RequestGetUserLogin($param);
		if($response->isLogin == false)			
		{
			$present = $this->LoginPresent($response);
			$updatepresent = new UpdatePresent($present->GetPresent(),$response->loginCount);
			$this->UpdateLogin($response->loginCount);
			$this->OutputLoginPresent($response,$present->GetPresent());
		}
		else
		{
			$this->OutputLogin($response);
		}
	}
	
	//////////////////////////////////////////
	//ユーザーのログイン情報を更新する処理
	//////////////////////////////////////////
	private function UpdateLogin($logincount)
	{
		$param = new RequestUpdateGachaLogin();
		$param->userId = $this->post->GetUserId();
		$param->isLogin = true;
		$param->loginCount = $logincount + 1;
		if($param->loginCount >= 7)
		{
			$param->loginCount = 0;
		}
		$this->api->RequestUpdateGachaLogin($param);
	}

	///////////////////////////////////////////
	//ユーザーのチケットの情報を取得する処理
	///////////////////////////////////////////
	private function GetTicket()
	{
		$param = new RequestGetGachaTicket();
		$param->userId = $this->post->GetUserId();
		$response = $this->api->RequestGetGachaTicket($param);
		$this->OutputTicket($response);
	}
	
	//////////////////////////////////////
	//ログインプレゼントの処理
	//////////////////////////////////////
	private function LoginPresent($response)
	{
		require_once("LoginPresent.php");
		require_once("UpdatePresent.php");
		$loginPresent = new LoginPresent($response->loginCount);
		return $loginPresent;
	}
}
?>