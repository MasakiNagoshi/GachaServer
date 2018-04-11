<?php

class GachaBase
{
	private $rateArray;
	private $mysqli;
	private $mysqlInfo;
	private $outPutData;
	private $emmisionCharacter;//排出キャラクター
	private $emmisionArray;//排出した数
	private $post;
	private $emmisionCharacters;
	private $gachaLimit;
	private $api;
	function __construct($gachaStatus)
	{
		$this->Ini();
		switch($gachaStatus)
		{
			case 1:
			$this->rateArray = FileRead("Info/NormalRate.txt",",");
			break;
			case 2:
			$this->ReadSpecalGacha();
			break;
		}
		//$this->EmmishionCharacter();
	}

	private function ReadSpecalGacha()
	{
		 $rCharacters = FileRead("Info/RCharacters.txt",",");
		 $srCharacters = FileRead("Info/SRCharacteres.txt",",");
		 $ssrCharacters = FileRead("Info/SSRCharacteres.txt",",");
		 $this->emmisionCharacters->SetRareCharacters($rCharacters);
		 $this->emmisionCharacters->SetSuperRareCharacters($srCharacters);
		 $this->emmisionCharacters->SetSuperRareCharacters($ssrCharacters);
	}
	protected function GetLimit()
	{
		return $this->gachaLimit;
	}
	protected function GetEmmisionCharacters()
	{
		return $this->emmisionCharacters;
	}
	protected function GetOutPut()
	{
		return $this->output;
	}

	protected function SetOutPut($set)
	{
		$this->output = $set;
	}

	protected function GetRateArray()
	{
		return $this->rateArray;
	}

	protected function GetMysqli()
	{
		return $this->mysqli;
	}

	protected function PushEmmisonCharacter($push)
	{
			$this->emmisionArray[] = $push;
	}

	private function EmmishionCharacter()
	{
		global $apiMySQL;
		$rateMaxCount;
		$ran;
		$limit = $this->post->GetGachaLimit();
		$limit = intval($limit);
		for($count = 0; $count < $limit; $count++)
		{
			$rateMaxCount = count($this->rateArray);
			$ran = rand(0,$rateMaxCount);
			$this->emmisionArray[] = $this->rateArray[$ran];
		}
		$this->outPutData = $this->rateArray[$ran];
		$this->emmisionCharacter = $this->rateArray[$ran];
		$this->GetUserDictionary();
	}
	
	protected function GetUserDictionary()
	{
		$param = new RequestGetUserDictionary();
		$param->userId = $this->post->GetUserId();
		$response = $this->api->RequestGetUserDictionary($param,$this->mysqli);
		$this->UpdateEmmiision($response);	
	}
	protected function UpdateEmmiision($response)
	{
		$response = $this->SortUpdateEmmision($response);
		$param = new RequestUpdateEmmisionCharacter();
		$param->userId = $response->userId;
		$param->getNumbers = $response->getNumbers;
		$this->api->RequestUpdateEmmisionCharacter($param,$this->mysqli);
	}

	private function SortUpdateEmmision($response)
	{
		$splitData = split('/', $response->getNumbers);
		$splitDataMaxCount = count($splitData);
		$index = 0;
		$copy = $this->emmisionArray;
		$sort = array_unique($copy);
		$sort = array_filter($sort, "strlen");
		$sort = array_values($sort);
		$emmisionMaxCount = count($sort);//削除しない
		for($count = 0; $count < $emmisionMaxCount; $count++)
		{
			$result = false;
			for($index = 0; $index < $splitDataMaxCount - 1;$index++)
			{
				if($sort[$count] == $splitData[$index])
				{
					$result = true;
					break;
				}
			}
			if($result == false)
			{
				$response->getNumbers .= $sort[$count] . "/";
			}
		}
		return $response;
	}
	private function Ini()
	{
		global $postProtocol;
		global $apiMySQL;
		$this->api = $apiMySQL;
		$this->post = $postProtocol;
		$this->emmisionCharacters = new EmmisionCharacters();
		$this->gachaLimit = $this->post->GetGachaLimit();
		$this->mysqlInfo = MySQLSetting();
		$this->mysqlInfo->SetTableName("GachaUser");
		$this->mysqli = Connect($this->mysqlInfo->GetHostName(), $this->mysqlInfo->GetRoot(), $this->mysqlInfo->GetPassWord(), $this->mysqlInfo->GetDataBase());
	}
}
?>