<?php
////////////////////////////////////////////
//����ҁ@���z���
//�w�肵���f�[�^��ǂݍ��ރt�@�C��
//$filename = �w�肵���t�@�C��
//$splitfont = �w��̕������镶��
//return = string�^�i�z��)
////////////////////////////////////////////
function FileRead($filename, $splitfont)
{
  $readdata = file_get_contents($filename);
  $splitdata = split($splitfont, $readdata);
  return $splitdata;
}
?>
