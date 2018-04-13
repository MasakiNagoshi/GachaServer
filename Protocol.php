<?php
class RequestGetUserDictionary
{
	public $userId;
	public $table;
	public $database;
}

//////////////////////////////////
//ユーザーのチケットを取得するリクエストクラス
//$userId = ユーザーのID（string型）
//////////////////////////////////
class RequestGetGachaTicket
{
	public $userId;
}
///////////////////////////////////////
//ユーザのチケットを取得するレスポンスクラス
//$userId = ユーザーのID(string型)
//$normal = ノーマルチケット（int型）
//$specal = スペシャルチケット（int型）
///////////////////////////////////////
class ResponseGetGachaTicket
{
	public $userId;
	public $normal;
	public $specal;
}

///////////////////////////////////
//ユーザのログインの更新に関するリクエストクラス
//$userId = ユーザーのID(string型)
//isLogin = ログインをしたかどうか(bool型)
///////////////////////////////////
class RequestUpdateGachaLogin
{
	public $userId;
	public $isLogin;
}


///////////////////////////////////
//ガチャチケットの更新に関するリクエストクラス
//$userId = ユーザーのID(string型)
//$normal = ノーマルチケット（int型）
//$specal = スペシャルチケット（int型）
///////////////////////////////////
class RequestUpdateGachaTicket
{
	public $userId;
	public $normal;
	public $specal;
}


/////////////////////////////////////
//ユーザーのガチャチケットのテーブルに登録するリクエストクラス
//$userId = ユーザーのID(string型)
/////////////////////////////////////
class RequestInsertGachaTicket
{
	public $userId;
}

///////////////////////////////////////
//ログインテーブルに登録するリクエストクラス
//$userId = ユーザーのID(string型)
///////////////////////////////////////
class RequestInsertGachaLogin
{
	public $userid;
}

//////////////////////////////////////////////
//ログインのユーザーを取得するリクエストクラス
//$userId = ユーザーのID(string型)
///////////////////////////////////////////////
class RequestGetUserLogin
{
	public $userId;
}


//////////////////////////////////////
//ログインのユーザーを取得するレスポンスクラス
//$userId = ユーザーのID(string型)
//$isLogin = ログイン状況(bool型) false = ログインしていない
//////////////////////////////////////
class ResponseGetUserLogin
{
	public $userId;
	public $isLogin;
}


///////////////////////////////////////
//ユーザの図鑑情報を取得するレスポンスクラス
//$userId = ユーザーID(string型)
//$getNumbers = 取得した番号(string型)
///////////////////////////////////////
class ResponseGetUserDictionary
{
	public $userId;
	public $getNumbers;
}

/////////////////////////////////////////
//ユーザーのIDを登録するリクエストクラス
//$userId = ユーザID(string型)
//$useName = ユーザー名(string型)
/////////////////////////////////////////
class RequestInsertUserId
{
	public $userId;
	public $userName;
}


////////////////////////////////////////
//排出したキャラクターを更新するリクエストクラス
//$userId = ユーザーID(string型)
//$getNumbers = 取得した番号(string型)
////////////////////////////////////////
class RequestUpdateEmmisionCharacter
{
	public $userId;
	public $getNumbers;
}


///////////////////////////////////////////
//ガチャのチケットを更新するリクエストクラス
//$userId = ユーザーID(string型)
//$normal = ノーマルチケット（int型）
//$specal = スペシャルチケット（int型）
///////////////////////////////////////////
class ResponseUpdateGachaTicket
{
		public $userId;
		public $normal;
		public $specal;
}
/*
class OutPutWord
{
	const R_RATE = "r";
	const SR_RATE = "sr";
	const N_RATE = "n";
	const SSR_RATE = "ssr";

	function NRate()
	{
		return self::N_RATE;
	}
	
	function RRate()
	{
		return self::R_RATE;
	}
	
	function SRRate()
	{
		return self::SR_RATE;
	}
	
	function SSRRate()
	{
		return self::SSR_RATE;
	}
}
*/
?>