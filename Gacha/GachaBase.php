<?php
//////////////////////////////
//製作者　名越大樹
//ガチャの基底クラス
//////////////////////////////

require_once("OutPut.php");

class GachaBase extends OutPut
{
	private $outPutData;
	private $emmisionCharacter;//排出キャラクター
	private $emmisionArray;//排出した数
	private $post;
	private $emmisionCharacters;
	private $gachaLimit;
	private $api;
	private $errorCheck;
	private $error;
	private $getNumbers;//ユーザーが取得している図鑑情報(string型)
	private $normalTicket;//ノーマルチケット数(int型)
	private $specalTicket;//スペシャルチケット数（int型）

	function __construct($gachaStatus)
	{
		$this->Ini();
		$this->ErrorCheck();
//		if($this->error != 0)
//		{
			switch($gachaStatus)
			{
				case 1:
				$this->ReadNormalGacha();
				break;
				case 2:
				$this->ReadSpecalGacha();
				break;
			}
//		}
		//$this->EmmishionCharacter();
	}

	private function Ini()
	{
		global $postProtocol;
		global $apiMySQL;
		global $errorCheck;
		$this->errorCheck = $errorCheck;
		$this->api = $apiMySQL;
		$this->post = $postProtocol;
		$this->emmisionCharacters = new EmmisionCharacters();
		$this->gachaLimit = $this->post->GetGachaLimit();
	}


	private function ErrorCheck()
	{
		$result = $this->GetGachaTicket();
		$errorresult;
		switch($this->post->GetGachaRate())
		{
			case"normal":
			$errorresult = $this->errorCheck->UseNormalGachaTicket($result);
			break;
		}
//		if($errorresult == 0)
//		{
//			$this->error = 0;
		//	$this->errorCheck->ErrorOutput();
		//	return false;
//		}
//		else
//		{
			$this->normalTicket = intval($result->normal);
			$this->specalTicket = intval($result->specal);
			$this->UpdateGachaTicket();
			$result = $this->GetDictionary();
			$this->getNumbers =  split('/', $result->getNumbers);
			$this->error = 1;
//		}
//		return 1;
	}

	private function UpdateGachaTicket()
	{
		$param = new RequestUpdateGachaTicket();
		switch($this->post->GetGachaRate())
		{
			case "normal":
			$param->normal = $this->normalTicket - $this->post->GetUseNormalTicket();
			$param->specal = $this->specalTicket;
			break;
			case "specal":
			$param->normal = $this->normalTicket;
			$param->specal = $this->specalTicket - $this->post->GetUseSpecalTicket();
			break;
		}
		$param->userId = $this->post->GetUserId();
		$this->api->RequestUpdateGachaTicket($param);
	}

	/////////////////////////////////////////////
	//排出キャラクターが重複しているかを確認する処理
	//$emmision = 排出キャラクター(string型)
	/////////////////////////////////////////////
	protected function CheckDuplication($emmision)
	{
		$maxIndex = count($this->getNumbers);
		for($count = 0; $count < $maxIndex - 1; $count++)
		{
			if($this->getNumbers[$count] == $emmision)
			{
				return true;
			}
		}
		return false;
	}

	//////////////////////////////////////////
	//ノーマルガチャを行う際のデータを読み込む処理
	//////////////////////////////////////////
	private function ReadNormalGacha()
	{
		$nCharacters = FileRead("Info/NCharacters.txt",",");
		$this->emmisionCharacters->SetNormalCharacteres($nCharacters);
	}

	/////////////////////////////////////////
	//ノーマルガチャを行う際のデータを読み込む処理
	/////////////////////////////////////////
	private function ReadSpecalGacha()
	{
		 $rCharacters = FileRead("Info/RCharacters.txt",",");
		 $srCharacters = FileRead("Info/SRCharacteres.txt",",");
		 $ssrCharacters = FileRead("Info/SSRCharacteres.txt",",");
		 $this->emmisionCharacters->SetRareCharacters($rCharacters);
		 $this->emmisionCharacters->SetSuperRareCharacters($srCharacters);
		 $this->emmisionCharacters->SetSuperRareCharacters($ssrCharacters);
	}

	protected function GetLimit($rate)
	{
		switch($rate)
		{
			case 1:
			return $this->post->GetUseNormalTicket();
			case 2:
			return $this->post->GetUseSpecalTicket();
			break;
		}
		return 0;
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

	protected function PushEmmisonCharacter($push)
	{
			$this->emmisionArray[] = $push;
	}


	protected function GetUserDictionary()
	{
		$param = new RequestGetUserDictionary();
		$param->userId = $this->post->GetUserId();
		$response = $this->api->RequestGetUserDictionary($param);
		$this->UpdateEmmiision($response);
	}

	private function GetDictionary()
	{
		$param = new RequestGetUserDictionary();
		$param->userId = $this->post->GetUserId();
		$response = $this->api->RequestGetUserDictionary($param);
		return $response;
	}

	protected function UpdateEmmiision($response)
	{
		$response = $this->SortUpdateEmmision($response);
		$param = new RequestUpdateEmmisionCharacter();
		$param->userId = $response->userId;
		$param->getNumbers = $response->getNumbers;
		$this->api->RequestUpdateEmmisionCharacter($param);
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


	private function GetGachaTicket()
	{
		$param = new RequestGetGachaTicket();
		$param->userId = $this->post->GetUserId();
		$response = $this->api->RequestGetGachaTicket($param);
		return $response;
	}
}
?>
