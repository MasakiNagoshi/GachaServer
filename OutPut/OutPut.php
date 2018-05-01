<?php
/////////////////////////////////////////////
//製作者　名越大樹
//出力に関するクラス
/////////////////////////////////////////////

class OutPut
{
	////////////////////////////////////////
	//図鑑情報を出力する処理
	//param = ユーザーの取得している図鑑(string型)
	////////////////////////////////////////
	protected function OutputDictionary($param)
	{
		$output = "6,".$param->getNumbers;
		echo$output;
	}
	
	//////////////////////////////////////
	//ログインの情報を出力する処理
	//$param = ログイン情報(bool型)
	//////////////////////////////////////
	protected function OutputLogin($param)
	{
		$output = "7," . $param->isLogin;
		echo$output;
	}
	
	///////////////////////////////////////
	//ログインプレゼントを出力関する処理
	//$param = ログイン情報(bool型)
	//$present = プレゼント内容(string型)
	///////////////////////////////////////
	protected function OutputLoginPresent($param,$present)
	{
		$output = "7," . $param->isLogin . "," .$present;		
		echo $output;
	}
	
	///////////////////////////////
	//ガチャチケットの出力に関する処理
	///////////////////////////////
	protected function OutputTicket($param)
	{
		echo "5,". "n" .":" .$param->normal ."," . "s" . ":" . $param->specal;
	}
	
	//////////////////////////////////
	//排出したキャラクターを出力する処理
	//$emmision = 排出キャラクターの番号(string型)
	//$rate = 排出キャラクターのレート（string型）
	//$duplication = 重複しているかどうか(string型)
	//////////////////////////////////
	protected function OutputGacha($emmision,$rate,$duplication)
	{
		$output =  $emmision . ":" . $rate . ":" . $duplication. ",";
		echo $output;
	}
	
	protected function OutputCreateUser($createid,$username)
	{
		$output = "0," .$createid . "," . $username;
		echo$output;
	}
}
?>