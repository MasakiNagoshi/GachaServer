<?php
class AutoExe
{
  function __construct()
  {
    require_once("AutoExe/ResetMySQL.php");
    $reset = new ResetMySQL();
  }
}
?>
