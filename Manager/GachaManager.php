<?php
//////////////////////////////////
//�����ҁ@���z����
//�K�`�����Ǘ������N���X
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
			case "normal"://�m�[�}���K�`��
			$gacha = new NormalGacha();
			break;
			case "specal":
			$gacha = new SpecalGacha();
			break;
		}
	}
}
?>
