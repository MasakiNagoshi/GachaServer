<?php
///////////////////////////////////
//製作者　名越大樹
//ガチャの排出するキャラクター全体を管理するクラス
///////////////////////////////////

class EmmisionCharacters
{
	private $nCharacters;//排出候補のノーマルキャラクター達(配列string型)
	private $rCharacters;//排出候補のレアキャラクター達(配列string型)
	private $srCharacters;//排出候補のスーパーレアキャラクター達(配列string型)
	private $ssrCharacters;//排出候補の超レアキャラクター達(配列string型)

	function SetNormalCharacteres($set)
	{
		$this->nCharacters = $set;
	}

	function GetNormalCharacters()
	{
		return $this->nCharacters;
	}

	function SetRareCharacters($set)
	{
		$this->rCharacters = $set;
	}

	function GetRareCharacters()
	{
		return $this->rCharacters;
	}

	function SetSuperRareCharacters($set)
	{
		$this->srCharacters = $set;
	}

	function GetSuperRareCharacters()
	{
		return $this->srCharacters;
	}

	function SetSuperSuperRareCharacters($set)
	{
		 $this->ssrCharacters = $set;
	}

	function GetSuperSuperRareCharacters()
	{
		return $this->ssrCharacters;
	}
}
?>
