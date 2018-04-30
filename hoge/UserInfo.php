<?php
$userInfo;

class UserInfo
{
	private $id;
	private $name;
	private $status;
	function __construct()
	{
		global $userInfo;
		$userInfo = $this;
	}
}
?>