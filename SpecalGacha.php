<?php

class SpecalGacha extends GachaBase
{
	private $status = 2;
	function __construct()
	{
		parent::__construct($this->status);
		$this->EmmisionCharacter();
	}

	private function EmmisionCharacter()
	{
		$limit = $this->GetLimit();
		$emmison = $this->GetEmmisionCharacters();
		for($count = 0; $count < $limit;$count++)
		{
		
			$ran = rand(0,100);
			$emmisionCharacters;
			$rate;
			if($ran >= 30 && $ran <= 100)
			{
				$emmisionCharacters = $emmison->GetRareCharacters();
				$rate = 1;
			}
		
			else if($ran >= 6 && $ran <= 29)
			{
				$emmisionCharacters = $emmison->GetSuperRareCharacters();
				$rate = 2;
			}
		
			else if($ran >= 0 && $ran <= 5)
			{
				$emmisionCharacters = $emmison->GetSuperSuperRareCharacters();
				$rate = 3;
			}
			$this->Emmision($emmisionCharacters,$rate);
		}
			$this->GetUserDictionary();
	}
	private function Emmision($emmisionarray,$rate)
	{
		$rateMaxCount = count($emmisionarray);
		$ran = rand(0,$rateMaxCount -1);
		$this->PushEmmisonCharacter($emmisionarray[$ran]);
		$result = $this->CheckDuplication($emmisionarray[$ran]);
		$duplication;
		$emmisionrate;
		if($result)
		{
			$duplication = "1";
		}
		else
		{
			$duplication = "0";			
		}
		switch($rate)
		{
			case 1:
			$emmisionrate = "r";
			break;
			case 2:
			$emmisionrate = "sr";
			break;
			case 3:
			$emmisionrate = "ssr";
			break;
		}
		$this->OutputGacha($emmisionarray[$ran],$emmisionrate,$duplication);
	}

}
?>