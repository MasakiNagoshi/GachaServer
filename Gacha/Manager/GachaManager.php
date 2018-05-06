<?php
//////////////////////////////////
//制作者 名越大樹
//ガチャを行うときのガチャ全体を管理するクラス
//////////////////////////////////

class GachaManager
{
	function __construct()
	{
		require_once("Manager/GachaManagerReadFile.php");
		global $postProtocol;
		$api = new APIMySQL();
		$rate = $postProtocol->GetGachaRate();
		echo"2,";

		switch($rate)
		{
			case "normal":
			$gacha = new NormalGacha();
			break;
			case "specal":
			$gacha = new SpecalGacha();
			break;
		}
	}
}
?>
