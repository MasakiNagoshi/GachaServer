<?php

class PostErrorCheck
{
	function CheckUserId($id)
	{
		$escapeId = htmlspecialchars($id);
		$length = strlen($escapeId);
		$common = substr($escapeId,0,2);
		if($length  == 13 && $common == "5a")
		{
			return $escapeId;
		}
		return "";
	}
	
	function CheckGachaRate($rate)
	{
		$escapeRate = htmlspecialchars($rate);
		if($escapeRate == "normal" || $escapeRate == "specal")
		{
				return $escapeRate;
		}
		return "";
	}
	
}
?>