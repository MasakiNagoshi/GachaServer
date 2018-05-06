<?php
//////////////////////////////////////////////////
//制作者　名越大樹
//スペシャルガチャを行うクラス
//////////////////////////////////////////////////

class SpecalGacha extends GachaBase
{
	private $status = 2;
	private $specalGachaRate;
	const R_RATE = "r";
	const SR_RATE = "sr";
	const SSR_RATE = "ssr";

	function __construct()
	{
		parent::__construct($this->status);
		require_once("GachaRate/SpecalGachaRate.php");
		$this->specalGachaRate = new SpecalGachaRate();
		$this->EmmisionCharacter();
	}

	private function EmmisionCharacter()
	{
		$limit = $this->GetLimit($this->status);
		$emmision = $this->GetEmmisionCharacters();

		for($count = 0; $count < $limit;$count++)
		{
			$ran = rand($this->specalGachaRate->GetRateMinValue(), $this->specalGachaRate->GetRateMaxValue());
			$emmisionCharacters;
			$rate = $this->EmmisionRate($emmision, $emmisionCharacters, $ran);
			$this->Emmision($emmisionCharacters, $rate, $ran);
		}

		$this->GetUserDictionary();
	}

	private function EmmisionRate($emmision, &$emmisionCharacters, $ran)
	{
		if($ran >= $this->specalGachaRate->GetRMinValue() && $ran <= $this->specalGachaRate->GetRMaxValue())
		{
			$emmisionCharacters = $emmision->GetRareCharacters();
			return 1;
		}

		else if($ran >= $this->specalGachaRate->GetSRMinValue() && $ran <= $this->specalGachaRate->GetSRMaxValue())
		{
			$emmisionCharacters = $emmision->GetSuperRareCharacters();
			return 2;
		}

		else if($ran >= $this->specalGachaRate->GetSSRMinValue() && $ran <= $this->specalGachaRate->GetSSRMaxValue())
		{
			$emmisionCharacters = $emmision->GetSuperSuperRareCharacters();
			return 3;
		}
	}

	private function Emmision($emmisionArray, $rate)
	{
		$rateMaxCount = count($emmisionArray);
		$ran = rand(0,$rateMaxCount -1);
		$this->PushEmmisonCharacter($emmisionArray[$ran]);
		$result = $this->CheckDuplication($emmisionArray[$ran]);
		$duplication;
		$emmisionRate;

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
			$emmisionRate = self::R_RATE;
			break;
			case 2:
			$emmisionRate = self::SR_RATE;
			break;
			case 3:
			$emmisionRate = self::SSR_RATE;
			break;
		}

		$this->OutputGacha($emmisionArray[$ran], $emmisionRate, $duplication);
	}
}
?>
