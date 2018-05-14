<?php
class Log
{
private $date;
private $postData = "";
private $ip;

 function __construct()
 {
   $this->Date();
   $this->IP();
   $this->POST();
   $this->OutputLog();
 }

 private function Date()
 {
   $this->date = date("Y/m/d - M (D) H:i:s");
 }

 private function IP()
 {
   $this->ip = $_SERVER["REMOTE_ADDR"];
 }

 private function POST()
 {
   foreach(array_keys($_POST) as $key)
   {
   $post[$key] = $_POST[$key];
   $this->postData .= $key . "=>"  . $post[$key] . ",";
   }

 }

 private function OutputLog()
 {
   $data = "IP = " . $this->ip ."; ". " 日付 = " . $this->date . "; " . "POST = " . $this->postData;
   $bynary = bin2hex($data);
   file_put_contents("Log/log.txt", $bynary . PHP_EOL, FILE_APPEND);
 }
}
?>
