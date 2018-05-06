<?php

class Master
{
	function __construct()
	{
		$this->Ini();
	}

	private function IniReadFile()
	{
	require_once("GlobalVariable.php");
	require_once("IniReadFile.php");
	require_once("ErrorCheck.php");
	}

	private function Ini()
	{
		$this->IniReadFile();
	}


}
?>
