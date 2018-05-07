<?php
////////////////////////////////////////////
//製作者　名越大樹
//Mysqlのアクセスと実行に関するファイル
////////////////////////////////////////////

require_once("Common.php");
require_once("MySQLInfo.php");
require_once("ReadFile.php");

////////////////////////////////////
//データベースの初期設定に関する処理
////////////////////////////////////
function MySQLSetting()
{
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
function Connect($host, $root, $pass, $database)
{
	$mysql = new mysqli($host, $root, $pass, $database);
	if(!$mysql)
	{
		echo"失敗";
	}
	return $mysql;
}

?>