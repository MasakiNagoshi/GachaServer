<?php
////////////////////////////////////////////
//����ҁ@���z���
//Mysql�̃A�N�Z�X�Ǝ��s�Ɋւ���t�@�C��
////////////////////////////////////////////

require_once("Common.php");
require_once("MySQLInfo.php");
require_once("ReadFile.php");

////////////////////////////////////
//�f�[�^�x�[�X�̏����ݒ�Ɋւ��鏈��
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
//MySQL�ɐڑ����鏈��
//$host = �ڑ���(string�^)
//$root = ���[�U�[��(string�^)
//$pass = �p�X���[�h(string�^)
//$database = �ڑ�����f�[�^�x�[�X(string�^)
//�Ԃ�l = mysqli�I�u�W�F�N�g�^
//////////////////////////////////////////
function Connect($host, $root, $pass, $database)
{
	$mysql = new mysqli($host, $root, $pass, $database);
	if(!$mysql)
	{
		echo"���s";
	}
	return $mysql;
}

?>