<?php
////////////////////////////////////////////////////
//制作者　名越大樹
//リクエスト内容を管理するクラス
////////////////////////////////////////////////////

class RequestManager
{
	function __construct()
	{
		$this->Request();
	}

	private function Request()
	{
		if($_POST["status"] == "0")//新規ユーザ作成
		{
			require_once("Request/GetRequestReadFile.php");
			require_once("Request/CreateUserId.php");
			$user = new CreateUser();
		}

		else if($_POST["status"] == "1")//ユーザーの情報を取得する
		{
			require_once("Request/GetRequestReadFile.php");
			$test = new GetRequest();
		}

		else
		{
			require_once("Manager/GachaManager.php");//ガチャを行う
			$gacha = new GachaManager();
		}

	}
}
?>
