<?php
///////////////////////////////////////////////////////////
//����� ���z�@���
//�t�@�C�����@���[�U�[�����N�G�X�g���Ă����Ƃ��Ɏ��s����t�@�C��
///////////////////////////////////////////////////////////

//if($_SERVER['REQUEST_METHOD'] == "POST")
//{
	require_once("GlobalVariable.php");
	require_once("IniReadFile.php");
	require_once("ErrorCheck.php");

	$api = new APIMySQL();
	$post = new PostProtocol();
	$error = new ErrorCheck();
	if($_POST["status"] == "0")
	{
		require_once("CreateUserId.php");
		$user = new CreateUser();	
	}
	else if($_POST["status"] == "1")
	{
		require_once("GetRequest.php");
		require_once("MySQLSetting.php");
		require_once("APIServer.php");
		require_once("Protocol.php");
		$test = new GetRequest();
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