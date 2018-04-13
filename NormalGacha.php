<?php

class NormalGacha extends GachaBase
{
	private $status = 1;
	function __construct()
	{
		parent::__construct($this->status);
	$this->EmmisionCharacter();
	}
	
	private function EmmisionCharacter()
	{
		$limit = $this->GetLimit();
		$emmision = $this->GetEmmisionCharacters();
		$emmisionCharacters = $emmision->GetNormalCharacters();
		$rateMaxCount = count($emmisionCharacters);
		for($count = 0;$count < $limit; $count++)
		{
			$ran = rand(0,$rateMaxCount - 1);
			$this->PushEmmisonCharacter($emmisionCharacters[$ran]);
			$result = $this->CheckDuplication($emmisionCharacters[$ran]);
			echo$emmisionCharacters[$ran];
			echo":";
			echo"n:";
			if($result)
			{
				echo"1,";
			}
			else
			{
				echo"0,";
			}
		}
		$this->GetUserDictionary();
	}
}
?>