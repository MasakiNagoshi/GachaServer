<?php
///////////////////////////////////
//製作者　名越大樹
//全体を管理するクラス
///////////////////////////////////

class Master
{
		function __construct()
		{
			$this->IniCreateClass();
			require_once("Manager/RequestManager.php");
			require_once("Log/Log.php");
			$log = new Log();
			$manager = new RequestManager();
		}

		private function IniCreateClass()
		{
			$api = new APIMySQL();
			$error = new ErrorCheck();
			$post = new PostProtocol();
		}

}
?>
