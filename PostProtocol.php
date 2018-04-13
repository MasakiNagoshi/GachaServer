<?php
$postProtocol;

class PostProtocol
{
	private $gachaRate;//ガチャの種類
	private $userId;//ユーザーID
	private $gachaLimit;//ガチャの回数
	private $getRequest;//取得するリクエストの種類
	private $useNormalTicket;//使用したノーマルチケット数
	private $useSpecalTicket;//使用したスペシャルチケット数
	function __construct()
	{
		global $postProtocol; 
		$postProtocol = $this;
		$this->gachaRate = $_POST["rate"];
		$this->gachaLimit = intval($_POST["limit"]);
		$this->userId = $_POST["id"];
		$this->getRequest = $_POST["getrequest"];
		$this->useNormalTicket = intval($_POST["usenormal"]);
		$this->useSpecalTicket = intval($_POST["usespecal"]);
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