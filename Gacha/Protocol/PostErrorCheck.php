<?php
/////////////////////////////////////////////////////////////////////////////////////////
//制作者　名越大樹
//POST(データベースに使用する)データのエラーチェックを確認するクラス(SQLインジェクション対策)
/////////////////////////////////////////////////////////////////////////////////////////

class PostErrorCheck
{
	const ID_LENGTH = 13;
	const ID_FIRST_FONT = "5a";
	const NORMAL_GACHA = "normal";
	const SPECAL_GACHA = "specal";

	function CheckUserId($id)
	{
		$escapeId = htmlspecialchars($id);
		$length = strlen($escapeId);
		$common = substr($escapeId,0,2);
		if($length  == self::ID_LENGTH && $common == self::ID_FIRST_FONT)
		{
			return $escapeId;
		}
		return "";
	}

	function CheckGachaRate($rate)
	{
		$escapeRate = htmlspecialchars($rate);
		if($escapeRate == self::NORMAL_GACHA || $escapeRate == self::SPECAL_GACHA)
		{
				return $escapeRate;
		}
		return "";
	}

	function CheckLimit($limit)
	{
		$escapeLimit = htmlspecialchars($limit);
		$intLimit = intval($escapeLimit);
		return $intLimit;
	}

	function CheckUserName($name)
	{
		$escapeName = htmlspecialchars($name);
		return $escapeName;
	}

	function CheckUseTicket($ticket)
	{
		$escapeTicket = htmlspecialchars($ticket);
		$intTicket = intval($escapeTicket);
		if($intTicket >= 0 && $intTicket <= 10)
		{
			return $intTicket;
		}
		return NULL;
	}
}
?>
