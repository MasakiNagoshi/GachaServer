<?php
/////////////////////////////////////////////
//製作者　名越大樹
//出力に関するクラス
/////////////////////////////////////////////
class OutPut
{
	///////////////////////////////////
	//図鑑情報を出力する処理
	///////////////////////////////////
	protected function OutputDictionary($param)
	{
		$output = "6,".$param->getNumbers;
		echo$output;
	}
	
	//////////////////////////////////////
	//ログインの情報を出力する処理
	//////////////////////////////////////
	protected function OutputLogin($param)
	{
		$output = "7," . $param->isLogin;
		echo$output;
	}
	
	///////////////////////////////
	//ガチャチケットの出力に関する処理
	///////////////////////////////
	protected function OutputTicket($param)
	{
		echo "5,". "n" .":" .$param->normal ."," . "s" . ":" . $param->specal;
	}
}
?>