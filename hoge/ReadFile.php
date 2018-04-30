<?php
////////////////////////////////////////////
//製作者　名越大樹
//指定したデータを読み込むファイル
//$filename = 指定したファイル
//$splitfont = 指定の分割する文字
//return = string型（配列)
////////////////////////////////////////////
function FileRead($filename, $splitfont)
{
  $readdata = file_get_contents($filename);
  $splitdata = split($splitfont, $readdata);
  return $splitdata;
}
?>
