<?php
///////////////////////////////////////////
//制作者 名越大樹
//新規ユーザーを作成するクラス
///////////////////////////////////////////

class CreateUser extends OutPut
{
	private $mysqli;//mysqliオブジェクト型
	private $api;//APIMySQLクラス
	private $createid;//新規ユーザーのID(string型)
	private $postProtocol;
	function __construct()
	{
		$this->Ini();
		$this->InsertUser();
		global $postProtocol;
		$this->postProtocol = $postProtocol;
		$this->OutputCreateUser($this->createid,$this->postProtocol->GetUserName());
	}
	
	private function Ini()
	{
		global $apiMySQL;
		$this->api = $apiMySQL;		
	}
	
	///////////////////////////////////
	//ユーザーの初期登録の処理
	///////////////////////////////////
	private function InsertUser()
	{
		
		$this->CreateUser();
		$this->InsertGachaLogin();
		$this->InsertGachaTicket();
	}
	
	////////////////////////////////////
	//ガチャチケットの初期登録に関する処理
	////////////////////////////////////
	private function InsertGachaTicket()
	{
		$param = new RequestInsertGachaTicket();	
		$param->userId = $this->createid;
		$this->api->RequestInsertGachaTicket($param);
	}
	
	///////////////////////////////////
	//ログイン情報の初期登録に関する処理
	///////////////////////////////////
	private function InsertGachaLogin()
	{
		$param = new RequestInsertGachaLogin();
		$param->userId = $this->createid;
		$this->api->RequestInsertGachaLogin($param);
	}
	
	//////////////////////////////////////
	//新規ユーザーを作成する処理
	//////////////////////////////////////
	private function CreateUser()
	{
		$this->createid = uniqid();
		$param = new RequestInsertUserId();
		$param->userId = $this->createid;
		$param->userName = $_POST["name"];
		$this->api->RequestInsertUserId($param);
	}

}
?>