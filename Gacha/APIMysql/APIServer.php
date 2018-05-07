<?php
////////////////////////////////////////
//製作者　名越大樹
//MySQLのクエリを実行するクラス
////////////////////////////////////////

class APIMySQL
{
	private $mysqliObj;
	function __construct()
	{
		global $apiMySQL;
		$apiMySQL = $this;
		$mysqlinfo = $this->MySQLSetting();
		$mysqlinfo->SetTableName("GachaUser");
		$this->mysqliObj = $this->Connect($mysqlinfo->GetHostName(), $mysqlinfo->GetRoot(), $mysqlinfo->GetPassWord(), $mysqlinfo->GetDataBase());
	}

	private function MySQLSetting()
	{
		require_once("Common.php");
		require_once("APIMySQL/MySQLInfo.php");
		require_once("ReadFile.php");
		$common = new Common();
		$mysqliinfo = new MySQLInfo($common->DataBaseInfo());
		$filename = $common->DataBaseInfo();
		$splitfont = $common->DataSplitFont();
		$data = FileRead($filename, $splitfont);
		$mysqliinfo->SetPassWord($data[0]);
		$mysqliinfo->SetRoot($data[1]);
		$mysqliinfo->SetDataBase($data[2]);
		$mysqliinfo->SetHost($data[3]);
		return $mysqliinfo;
	}

	//////////////////////////////////////////
	//MySQLに接続する処理
	//$host = 接続先(string型)
	//$root = ユーザー名(string型)
	//$pass = パスワード(string型)
	//$database = 接続するデータベース(string型)
	//返り値 = mysqliオブジェクト型
	//////////////////////////////////////////
	private function Connect($host, $root, $pass, $database)
	{
		$mysql = new mysqli($host, $root, $pass, $database);
		if(!$mysql)
		{
			echo"失敗";
		}
		return $mysql;
	}



	/////////////////////////////////////////////////
	//排出したキャラクターの更新をする処理
	/////////////////////////////////////////////////
	function RequestUpdateEmmisionCharacter($param)
	{
		$sql ="UPDATE GachaUser SET getnumbers = '$param->getNumbers' WHERE id = '$param->userId'";
		$result = $this->QueryExecute($sql);
	}

	//////////////////////////////////////////
	//取得しているユーザーの図鑑を取得する処理
	//////////////////////////////////////////
	function RequestGetUserDictionary($param)
	{
		$sql = "SELECT * FROM GachaUser WHERE id = '$param->userId'";
		$result = $this->QueryExecute($sql);
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
	function RequestInsertGachaTicket($param)
	{
		$sql = "INSERT INTO GachaTicket(id,normal,specal) VALUES('$param->userId',0,0)";
		$result = $this->QueryExecute($sql);
	}

	///////////////////////////////////////////////
	//ログインの初期登録に関する処理
	///////////////////////////////////////////////
	function RequestInsertGachaLogin($param)
	{
		$sql = "INSERT INTO GachaLogin(id,islogin,count) VALUES('$param->userId',false,0)";
		$this->QueryExecute($sql);
	}

	////////////////////////////////////////////////
	//ユーザーのログイン状況に関する処理
	////////////////////////////////////////////////
	function RequestGetUserLogin($param)
	{
		$sql = "SELECT * FROM GachaLogin WHERE id = '$param->userId'";
		$result = $this->QueryExecute($sql);
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
	function RequestUpdateGachaLogin($param)
	{
		$sql = "UPDATE GachaLogin SET islogin = '$param->isLogin' , count = '$param->loginCount' WHERE id = '$param->userId'";
		$result = $this->QueryExecute($sql);
	}

	////////////////////////////////////////////
	//ガチャチケットを取得する処理
	////////////////////////////////////////////
	function RequestGetGachaTicket($param)
	{
		$sql = "SELECT * FROM GachaTicket WHERE id  = '$param->userId'";
		$result = $this->QueryExecute($sql);
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
	function RequestUpdateGachaTicket($param)
	{
		$sql = "UPDATE GachaTicket SET normal = '$param->normal' , specal = '$param->specal' WHERE id = '$param->userId'";
		$result = $this->QueryExecute($sql);
	}

	//////////////////////////////////////////////
	//ユーザーの名前とIDの初期登録に関する処理
	//////////////////////////////////////////////
	function RequestInsertUserId($param)
	{
		$sql = "INSERT INTO GachaUser(id,name) VALUES('$param->userId','$param->userName')";
		$result = $this->QueryExecute($sql);
	}

	//////////////////////////////////////////////
	//////////////////////////////////////////////
	function ResetLogin()
	{
		$sql = "UPDATE GachaLogin SET islogin = false";
		$result = $this->QueryExecute($sql);
	}

	///////////////////////////////////
	//SQLを実行する処理
	///////////////////////////////////
	function QueryExecute($sql)
	{
		if($result = $this->mysqliObj->query($sql))
		{
			return $result;
		}
		else
		{
			return $this->mysqliObj->error;
		}
	}
}
?>
