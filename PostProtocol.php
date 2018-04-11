<?php
$postProtocol;

class PostProtocol
{
	private $gachaRate;
	private $userId;
	private $gachaLimit;
	private $getRequest;
	
	function __construct()
	{
		global $postProtocol; 
		$postProtocol = $this;
		$this->gachaRate = $_POST["rate"];
		$this->gachaLimit = intval($_POST["limit"]);
		$this->userId = $_POST["id"];
		$this->getRequest = $_POST["getrequest"];
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