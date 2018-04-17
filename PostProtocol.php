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