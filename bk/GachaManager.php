<?php
require_once("Manager/GachaManagerReadFile.php");
class GachaManager
{
	function __construct()
	{
		global $postProtocol;
		$api = new APIMySQL();
		$rate = $postProtocol->GetGachaRate();
//		$status = "1";
		echo"2,";

		switch($rate)
		{
			case "normal"://�m�[�}���K�`��
		//	$gacha = new NormalGacha();
			break;
			case "specal":
			//$gacha = new SpecalGacha();
			break;
		}
	}
}
?>
