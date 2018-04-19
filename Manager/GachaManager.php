<?php
//////////////////////////////////
//製作者　名越大樹
//ガチャを管理するクラス
//////////////////////////////////

class GachaManager
{
	function __construct()
	{
		require_once("GachaManagerReadFile.php");
		global $postProtocol;
		$api = new APIMySQL();
		$rate = $postProtocol->GetGachaRate();
		echo"2,";

		switch($rate)
		{
			case "normal"://ノーマルガチャ
			$gacha = new NormalGacha();
			break;
			case "specal":
			$gacha = new SpecalGacha();
			break;
		}
	}
}
?>