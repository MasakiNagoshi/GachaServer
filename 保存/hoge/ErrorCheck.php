<?php
////////////////////////////////
//製作者　名越大樹
//エラー原因を管理するクラス
////////////////////////////////

class ErrorCheck
{
		private $post;
		private $error;
		function __construct()
		{
			global $errorCheck;
			global $postProtocol;
			$errorCheck = $this;
			$this->post = $postProtocol;
		}

		function UseNormalGachaTicket($param)
		{

			$useTicketCount = $this->post->GetUseNormalTicket();
			$intcast = intval($param->normal);
			$result = 1;
			if($intcast - $useTicketCount <= 0)
			{
					$this->error = "e";
					$result = 0;
			}
			return $result;
		}

		function ErrorOutput()
		{
			echo"error";
		}

		function UserId($id)
		{
			var_dump($id);
		}
}
?>
