<?php
/////////////////////////////////////////
//制作者　名越大樹
//POSTで送られる情報を管理するクラス
/////////////////////////////////////////

class PostProtocol
{
	private $gachaRate;//ガチャの種類(string型)
	private $userId;//ユーザーID(string型)
	private $gachaLimit;//ガチャの回数(int型)
	private $getRequest;//取得するリクエストの種類(string型)
	private $useNormalTicket;//使用したノーマルチケット数(string型)
	private $useSpecalTicket;//使用したスペシャルチケット数(string型)
	private $errorCheck;//PostErrorCheck(クラス型)
	private $userName;//ユーザー名(string型)
	const LIMIT = "limit";
	const USE_NORMAL_GACHATICKET = "usenormal";
	const USE_SPECAL_GACHATICKET = "usespecal";
	const USER_ID = "id";
	const USER_NAME = "name";
	const GACHA_RATE = "rate";
	const GET_REQUEST = "getrequest";
	
	function __construct()
	{
		$this->ReadData();
	}

	private function ReadData()
	{
		require_once("Protocol/PostErrorCheck.php");
		$this->errorCheck = new PostErrorCheck();
		$this->getRequest = $_POST[self::GET_REQUEST];
		$this->useNormalTicket = intval($_POST[self::USE_NORMAL_GACHATICKET]);
		$this->useSpecalTicket = intval($_POST[self::USE_SPECAL_GACHATICKET]);
		$this->CheckGachaRate();
		$this->CheckUserId();
		$this->CheckLimit();
		$this->CheckUserName();
		global $postProtocol;
		$postProtocol = $this;
	}
	
	private function CheckUserName()
	{
		$this->userName = $this->errorCheck->CheckUserName($_POST[self::USER_NAME]);		
	}
	
	private function CheckLimit()
	{
		$this->gachaLimit = $this->errorCheck->CheckLimit($_POST[self::LIMIT]);
	}

	private function CheckUserId()
	{
		$this->userId = $this->errorCheck->CheckUserId($_POST[self::USER_ID]);
	}

	private function CheckGachaRate()
	{
		$this->gachaRate = $this->errorCheck->CheckGachaRate($_POST[self::GACHA_RATE]);
	}
	
	function GetUserName()
	{
		return $this->userName;
	}

	function GetUseNormalTicket()
	{
		return $this->useNormalTicket;
	}

	function GetUseSpecalTicket()
	{
		return $this->useSpecalTicket;
	}

	function GetRequest()
	{
		return $this->getRequest;
	}

	function GetGachaRate()
	{
		return $this->gachaRate;
	}

	function GetGachaLimit()
	{
		return $this->gachaLimit;
	}

	function GetUserId()
	{
		return $this->userId;
	}
}
?>
