<?php
//////////////////////////////
//製作者　名越大樹
//ガチャの基底クラス
//////////////////////////////

require_once("OutPut/OutPut.php");

class GachaBase extends OutPut
{
	private $emmisionCharacter;//排出キャラクター
	private $emmisionArray;//排出した数
	private $postProtocol;//PostProtocolクラス
	private $emmisionCharacters;//EmmisionCharactersクラス型
	private $gachaLimit;//ガチャを回す回数(int型)
	private $api;//APIMySQLクラス型
	private $getNumbers;//ユーザーが取得している図鑑情報(string型)
	private $normalTicket;//ノーマルチケット数(int型)
	private $specalTicket;//スペシャルチケット数（int型）
	const NORMAL = "normal";
	const SPECAL = "specal";
	const N_CHARACTERS = "Info/NCharacters.txt";
	const R_CHARACTERS = "Info/RareCharacters.txt";
	const SR_CHARACTERS = "Info/SRCharacters.txt";
	const SSR_CHARACTERS = "Info/SSRCharacters.txt";
	const SPLIT_FONT = ",";
	function __construct($gachaStatus)
	{
		$this->Ini();
		$this->GachaTicket();
			switch($gachaStatus)
			{
				case 1:
				$this->ReadNormalGacha();
				break;
				case 2:
				$this->ReadSpecalGacha();
				break;
			}
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

	protected function GetLimit($rate)
	{
		switch($rate)
		{
			case 1:
			return $this->postProtocol->GetUseNormalTicket();
			case 2:
			return $this->postProtocol->GetUseSpecalTicket();
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

	///////////////////////////////////////////
	//ユーザが取得しているキャラクター情報を取得する処理
	///////////////////////////////////////////
	protected function GetUserDictionary()
	{
		$param = new RequestGetUserDictionary();
		$param->userId = $this->postProtocol->GetUserId();
		$response = $this->api->RequestGetUserDictionary($param);
		$this->UpdateEmmiision($response);
	}

	private function GetDictionary()
	{
		$param = new RequestGetUserDictionary();
		$param->userId = $this->postProtocol->GetUserId();
		$response = $this->api->RequestGetUserDictionary($param);
		return $response;
	}

	///////////////////////////////////////////
	//ユーザが取得しているキャラクター情報を更新する処理
	///////////////////////////////////////////
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

	private function Ini()
	{
		global $postProtocol;
		global $apiMySQL;
		$this->api = $apiMySQL;
		$this->postProtocol = $postProtocol;
		$this->emmisionCharacters = new EmmisionCharacters();
		$this->gachaLimit = $this->postProtocol->GetGachaLimit();
	}

	private function GachaTicket()
	{
		$result = $this->GetGachaTicket();
		$this->normalTicket = intval($result->normal);
		$this->specalTicket = intval($result->specal);
		$this->UpdateGachaTicket();
		$result = $this->GetDictionary();
		$this->getNumbers =  split('/', $result->getNumbers);
	}

	private function UpdateGachaTicket()
	{
		$param = new RequestUpdateGachaTicket();
		switch($this->postProtocol->GetGachaRate())
		{
			case self::NORMAL:
			$param->normal = $this->normalTicket - $this->postProtocol->GetUseNormalTicket();
			$param->specal = $this->specalTicket;
			break;
			case self::SPECAL:
			$param->normal = $this->normalTicket;
			$param->specal = $this->specalTicket - $this->postProtocol->GetUseSpecalTicket();
			break;
		}
		$param->userId = $this->postProtocol->GetUserId();
		$this->api->RequestUpdateGachaTicket($param);
	}

	//////////////////////////////////////////
	//ノーマルガチャを行う際のデータを読み込む処理
	//////////////////////////////////////////
	private function ReadNormalGacha()
	{
		$nCharacters = FileRead(self::N_CHARACTERS,self::SPLIT_FONT);
		$this->emmisionCharacters->SetNormalCharacteres($nCharacters);
	}

	/////////////////////////////////////////
	//ノーマルガチャを行う際のデータを読み込む処理
	/////////////////////////////////////////
	private function ReadSpecalGacha()
	{
		 $rCharacters = FileRead(self::R_CHARACTERS,self::SPLIT_FONT);
		 $srCharacters = FileRead(self::SR_CHARACTERS,self::SPLIT_FONT);
		 $ssrCharacters = FileRead(self::SSR_CHARACTERS,self::SPLIT_FONT);
		 $this->emmisionCharacters->SetRareCharacters($rCharacters);
		 $this->emmisionCharacters->SetSuperRareCharacters($srCharacters);
		 $this->emmisionCharacters->SetSuperSuperRareCharacters($ssrCharacters);
	}

	private function GetGachaTicket()
	{
		$param = new RequestGetGachaTicket();
		$param->userId = $this->postProtocol->GetUserId();
		$response = $this->api->RequestGetGachaTicket($param);
		return $response;
	}
}
?>
