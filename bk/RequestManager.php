<?php

class RequestManager
{
	function __construct()
	{
		$this->Request();
	}

	private function Request()
	{
		if($_POST["status"] == "0")
		{
			require_once("Request/GetRequestReadFile.php");
			require_once("Request/CreateUserId.php");
			$user = new CreateUser();
		}

		else if($_POST["status"] == "1")
		{
			require_once("Request/GetRequestReadFile.php");
			$test = new GetRequest();
		}

		else if($_POST["status"] == "3")
		{
			echo"request";
		}
		else
		{
			require_once("Manager/GachaManager.php");
			$gacha = new GachaManager();
		}
	}
}
?>
