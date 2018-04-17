<?php
////////////////////////////////////////
//製作者　名越大樹
//MySQLのクエリを実行するクラス
////////////////////////////////////////

class APIMySQL
{
	function __construct()
	{
		global $apiMySQL;
		$apiMySQL = $this;
	}
	/////////////////////////////////////////////////
	//排出したキャラクターの更新をする処理
	/////////////////////////////////////////////////
	function RequestUpdateEmmisionCharacter($param, $mysqli)
	{
		$sql ="UPDATE GachaUser SET getnumbers = '$param->getNumbers' WHERE id = '$param->userId'";
		$result = $this->QueryExecute($mysqli, $sql);
	}

	//////////////////////////////////////////
	//取得しているユーザーの図鑑を取得する処理
	//////////////////////////////////////////
	function RequestGetUserDictionary($param,$mysqli)
	{
		$sql = "SELECT * FROM GachaUser WHERE id = '$param->userId'";
		$result = $this->QueryExecute($mysqli, $sql);
		$response = new ResponseGetUserDictionary();
		$response->userId = $param->userId;
		$slash = "/";
		$com = ":";
		$ret = "";
		$response = new ResponseGetUserDictionary();
		while ($row = $result->fetch_assoc())
		{
			$response->userId = $row["id"];
			$response->getNumbers = $row["getnumbers"];
			$getnumbers = $row["getnumbers"];
			$ret .= $getnumbers.$com;
			$chachedata += $ret;
		}		
		$result->close();
		return $response;
	}
	
	//////////////////////////////////////////////////
	//チケットの初期登録に関する処理
	//////////////////////////////////////////////////
	function RequestInsertGachaTicket($param, $mysqli)
	{
		$sql = "INSERT INTO GachaTicket(id,normal,specal) VALUES('$param->userId',0,0)";
		$result = $this->QueryExecute($mysqli,$sql);
	}
	
	///////////////////////////////////////////////
	//ログインの初期登録に関する処理
	///////////////////////////////////////////////
	function RequestInsertGachaLogin($param,$mysqli)
	{
		$sql = "INSERT INTO GachaLogin(id,islogin,count) VALUES('$param->userId',false,0)";
		$this->QueryExecute($mysqli,$sql);
	}
	
	////////////////////////////////////////////////
	//ユーザーのログイン状況に関する処理
	////////////////////////////////////////////////
	function RequestGetUserLogin($param,$mysqli)
	{
		$sql = "SELECT * FROM GachaLogin WHERE id = '$param->userId'";
		$result = $this->QueryExecute($mysqli,$sql);
		$response = new ResponseGetUserLogin();
		while ($row = $result->fetch_assoc())
		{
			$response->userId = $row["id"];
			$response->isLogin = $row["islogin"];
			$response->loginCount = $row["count"];
		}
		$result->close();
		return $response;			
	}
	
	//////////////////////////////////////////////
	//ログイン状況を更新する処理
	//////////////////////////////////////////////
	function RequestUpdateGachaLogin($param,$mysqli)
	{
		$sql = "UPDATE GachaLogin SET islogin = '$param->isLogin' , count = '$param->loginCount' WHERE id = '$param->userId'";
		$result = $this->QueryExecute($mysqli,$sql);		
	}
	
	////////////////////////////////////////////
	//ガチャチケットを取得する処理
	////////////////////////////////////////////
	function RequestGetGachaTicket($param,$mysqli)
	{
		$sql = "SELECT * FROM GachaTicket WHERE id  = '$param->userId'";	
		$result = $this->QueryExecute($mysqli,$sql);
		$response = new ResponseGetGachaTicket();
		while ($row = $result->fetch_assoc())
		{
			$response->userId = $row["id"];
			$response->normal = $row["normal"];
			$response->specal = $row["specal"];			
		}
		$result->close();
		return $response;			
	}	
	
	////////////////////////////////////////
	//ガチャチケットの更新に関する処理
	////////////////////////////////////////
	function RequestUpdateGachaTicket($param,$mysqli)
	{
		$sql = "UPDATE GachaTicket SET normal = '$param->normal' , specal = '$param->specal' WHERE id = '$param->userId'";
		$result = $this->QueryExecute($mysqli,$sql);
	}
	
	//////////////////////////////////////////////
	//ユーザーの名前とIDの初期登録に関する処理
	//////////////////////////////////////////////
	function RequestInsertUserId($param,$mysqli)
	{
		$sql = "INSERT INTO GachaUser(id,name) VALUES('$param->userId','$param->userName')";
		$result = $this->QueryExecute($mysqli,$sql);
	}
	
	//////////////////////////////////////////////
	//////////////////////////////////////////////
	function ResetLogin($mysqli)
	{
		$sql = "UPDATE GachaLogin SET islogin = false";
		$result = $this->QueryExecute($mysqli,$sql);
	}
	
	///////////////////////////////////
	//SQLを実行する処理
	///////////////////////////////////
	function QueryExecute($mysqli, $sql)
	{
		if($result = $mysqli->query($sql))
		{
			return $result;
		}
		else
		{
			return $mysqli->error;
		}
	}
}
?>