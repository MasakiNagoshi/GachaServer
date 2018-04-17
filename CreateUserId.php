<?php
require_once("MySQLSetting.php");
require_once("APIServer.php");
require_once("Protocol.php");


class CreateUser
{
	private $mysqli;//mysqliオブジェクト型
	private $api;//APIMySQLクラス
	private $createid;//新規ユーザーのID(string型)
	
	function __construct()
	{
		$this->Ini();
		$this->InsertUser();
		$output = "0," .$this->createid . "," . $_POST["name"];
		echo$output;
	}
	
	private function Ini()
	{
		global $apiMySQL;
		$mysqlinfo = MySQLSetting();
		$mysqlinfo->SetTableName("GachaUser");
		$this->mysqli = Connect($mysqlinfo->GetHostName(), $mysqlinfo->GetRoot(), $mysqlinfo->GetPassWord(), $mysqlinfo->GetDataBase());
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
		$this->api->RequestInsertGachaTicket($param,$this->mysqli);
	}
	
	///////////////////////////////////
	//ログイン情報の初期登録に関する処理
	///////////////////////////////////
	private function InsertGachaLogin()
	{
		$param = new RequestInsertGachaLogin();
		$param->userId = $this->createid;
		$this->api->RequestInsertGachaLogin($param,$this->mysqli);
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
		$this->api->RequestInsertUserId($param,$this->mysqli);
	}

}
?>