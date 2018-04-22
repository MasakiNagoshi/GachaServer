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

	public function SetNormalCharacteres($set)
	{
		$this->nCharacters = $set;
	}

	public function GetNormalCharacters()
	{
		return $this->nCharacters;
	}

	public function SetRareCharacters($set)
	{
		$this->rCharacters = $set;
	}

	public function GetRareCharacters()
	{
		return $this->rCharacters;
	}

	public function SetSuperRareCharacters($set)
	{
		$this->srCharacters = $set;
	}

	public function GetSuperRareCharacters()
	{
		return $this->srCharacters;
	}
	
	public function SetSuperSuperRareCharacters($set)
	{
		 $this->ssrCharacters = $set;
	}

	public function GetSuperSuperRareCharacters()
	{
		return $this->ssrCharacters;
	}
}
?>