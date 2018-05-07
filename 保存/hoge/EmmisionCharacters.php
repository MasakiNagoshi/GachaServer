<?php
class EmmisionCharacters
{
	private $nCharacters;
	private $rCharacters;
	private $srCharacters;
	private $ssrCharacters;

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