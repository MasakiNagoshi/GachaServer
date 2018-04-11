<?php
//require_once("MySQLSetting.php");

$apiMySQL = new APIMySQL();

class APIMySQL
{
	function RequestUpdateEmmisionCharacter($param, $mysqli)
	{
		$sql ="UPDATE GachaUser SET getnumbers = '$param->getNumbers' WHERE id = '$param->userId'";
		$result = $this->QueryExecute($mysqli, $sql);
	}
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

	function RequestInsertGachaTicket($param, $mysqli)
	{
		$sql = "INSERT INTO GachaTicket(id) VALUES('$param->userId')";
		$result = $this->QueryExecute($mysqli,$sql);
		var_dump($result);
	}
	
	function RequestInsertGachaLogin($param,$mysqli)
	{
		$sql = "INSERT INTO GachaLogin(id) VALUES('$param->userId')";
		$this->QueryExecute($mysqli,$sql);
	}
	
	function RequestGetUserLogin($param,$mysqli)
	{
		$sql = "SELECT * FROM GachaLogin WHERE id = '$param->userId'";
		$result = $this->QueryExecute($mysqli,$sql);
		$response = new ResponseGetUserLogin();
		while ($row = $result->fetch_assoc())
		{
			$response->userId = $row["id"];
			$response->isLogin = $row["islogin"];
		}
		$result->close();
		return $response;			
	}
	
	function RequestUpdateUserLogin($param,$mysqli)
	{
		$sql = "UPDATE GachaLogin SET islogin = '$param->isLogin' WHERE id = '$param->userId'";
		$result = $this->QueryExecute($mysqli,$sql);		
	}
		
	function RequestGetUserTicket($param,$mysqli)
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
	function RequestUpdateGachaTicket($param,$mysqli)
	{

	}
	
	function RequestInsertUserId($param,$mysqli)
	{
		$sql = "INSERT INTO GachaUser(id,name) VALUES('$param->userId','$param->userName')";
		$result = $this->QueryExecute($mysqli,$sql);
	}

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