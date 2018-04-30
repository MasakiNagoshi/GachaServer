<?php
////////////////////////////////////////////////
//データに関する定数を管理するクラス
////////////////////////////////////////////////
class Common
{
//////////////////////////////////////////////////////////
//定数の宣言開始
//////////////////////////////////////////////////////////
  const DATA_BASE_INFO = "Info/databaseinfo.txt";//Mysqlのデータベースのファイル
  const DATA_TABLE_INFO = "Info/tableinfo.txt";//ゲームのテーブルに関するファイル
  const DATA_SPLIT_FONT = ",";//文字を分割する時のキーワード
  const SCORE = "score";//スコアに関するキーワード
  const NEW_NAME = "newname";
  const USER_NAME = "name";
  const USER_ID = "id";
  const LIMIT = "limit";
//////////////////////////////////////////////////////////
//定数の宣言終了
//////////////////////////////////////////////////////////

	function Score()
	{
		return self::SCORE;
	}

	function NewName()
	{
		return self::NEW_NAME;
	}

	function UserName()
	{
		return self::USER_NAME;
	}

	function UserId()
	{
		return self::USER_ID;
	}

	function Limit()
	{
		return self::LIMIT;
	}

	function DataBaseInfo()
	{
		return self::DATA_BASE_INFO;
	}

	function DataTableInfo()
	{
		return self::DATA_TABLE_INFO;
	}

	function DataSplitFont()
	{
		return self::DATA_SPLIT_FONT;
	}
}
?>
