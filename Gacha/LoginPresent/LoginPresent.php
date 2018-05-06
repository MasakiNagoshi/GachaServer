<?php
////////////////////////////////////
//製作者　名越大樹
//ログインボーナスを取得に関するクラス
////////////////////////////////////

class LoginPresent
{
	private $present;//プレゼント内容(配列string型)

	/////////////////////////////
	//$count = ログイン回数(int型)
	/////////////////////////////
	function __construct($count)
	{
		$this->ReadPresent($count);
	}

	/////////////////////////////
	//$count = ログイン回数(int型)
	/////////////////////////////
	private function ReadPresent($count)
	{
		$presents = FileRead("Info/LoginPresents.txt","/");
		$this->present = $presents[$count];
	}

	public function GetPresent()
	{
		return $this->present;
	}
}
?>
