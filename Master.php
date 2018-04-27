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
			require_once("RequestManager.php");
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