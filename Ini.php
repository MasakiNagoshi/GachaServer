<?php
///////////////////////////////////////////////////////////
//制作者 名越　大樹
//ファイル名　ユーザーがリクエストしてきたときに実行するファイル
///////////////////////////////////////////////////////////

//if($_SERVER['REQUEST_METHOD'] == "POST")
//{
	require_once("IniReadFile.php");
	$post = new PostProtocol();
	if($_POST["status"] == "0")
	{
		require_once("CreateUserId.php");
		$user = new CreateUser();	
	}
	else if($_POST["status"] == "1")
	{
		require_once("GetAllNumbers.php");
		$test = new GetAllNumbers();
	}
	
	else if($_POST["status"] == "3")
	{
		echo"request";
	}
	else
	{
		require_once("GachaManager.php");
		$gacha = new GachaManager();
	}
//}
?>