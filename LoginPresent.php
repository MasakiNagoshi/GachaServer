<?php

class LoginPresent
{
	private $present;
	function __construct($count)
	{
		$this->Present($count);
	}
	
	private function Present($count)
	{
		$presents = FileRead("Info/LoginPresents.txt","/");
		$this->present = $presents[$count];
	}
	
	public function GetPresent()
	{
		return $this->present;
	}
}
?>