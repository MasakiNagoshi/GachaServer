<?php
/////////////////////////////////////////////
//製作者　名越大樹
//ノーマルガチャを行うクラス
/////////////////////////////////////////////

class NormalGacha extends GachaBase
{
	private $status = 1;//
	private $rate = "n";//ガチャのレートの値

	function __construct()
	{
		parent::__construct($this->status);
		$this->EmmisionCharacter();
	}

	//////////////////////////////////////
	//キャラクターを排出する処理
	//////////////////////////////////////
	private function EmmisionCharacter()
	{
		$limit = $this->GetLimit($this->status);
		$emmision = $this->GetEmmisionCharacters();
		$emmisionCharacters = $emmision->GetNormalCharacters();
		$rateMaxCount = count($emmisionCharacters);
		for($count = 0;$count < $limit; $count++)
		{
			$duplication;
			$ran = rand(0,$rateMaxCount - 1);
			$this->PushEmmisonCharacter($emmisionCharacters[$ran]);
			$result = $this->CheckDuplication($emmisionCharacters[$ran]);
			if($result)
			{
				$duplication = "1";
			}
			else
			{
				$duplication = "0";
			}
			$this->OutputGacha($emmisionCharacters[$ran],$this->rate,$duplication);
		}
		$this->GetUserDictionary();
	}
}
?>
