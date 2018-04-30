<?php
/////////////////////////////////////////
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
	private $errorCheck;
	function __construct()
	{
		$this->ReadData();
	}

	private function ReadData()
	{
		require_once("Protcol/PostErrorCheck.php");
		$this->errorCheck = new PostErrorCheck();
		$this->gachaLimit = intval($_POST["limit"]);
		$this->getRequest = $_POST["getrequest"];
		$this->useNormalTicket = intval($_POST["usenormal"]);
		$this->useSpecalTicket = intval($_POST["usespecal"]);
		$this->CheckGachaRate();
		$this->CheckUserId();
		global $postProtocol;
		$postProtocol = $this;
	}

	private function CheckUserId()
	{
		$this->userId = $this->errorCheck->CheckUserId($_POST["id"]);
	}

	private function CheckGachaRate()
	{
		$this->gachaRate = $this->errorCheck->CheckGachaRate($_POST["rate"]);
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
