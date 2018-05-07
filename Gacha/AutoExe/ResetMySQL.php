<?php
class ResetMySQL
{
  private $mysqliObj;//mysqliオブジェクト型

  function __construct()
  {
    $mysqlinfo = $this->MySQLSetting();
    $mysqlinfo->SetTableName("GachaUser");
    $this->mysqliObj = $this->Connect($mysqlinfo->GetHostName(), $mysqlinfo->GetRoot(), $mysqlinfo->GetPassWord(), $mysqlinfo->GetDataBase());
    $this->Reset();
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

  /////////////////////////////////////////////////////////
  //Mysqlの設定に関するクラス
  /////////////////////////////////////////////////////////
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

  private function Reset()
  {
    $this->ResetLogin();
    echo"ハゲ";
  }

  private function ResetLogin()
  {
    $sql = "UPDATE GachaLogin SET islogin = false";
    $this->QueryExecute($sql);
  }

  ///////////////////////////////////
  //SQLを実行する処理
  //$sql = SQL(string型)
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
