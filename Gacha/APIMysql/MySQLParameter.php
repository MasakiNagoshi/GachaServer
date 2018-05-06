<?php
class MySQLParameter
{
  const INI_NORMAL_TICKET_VALUE = 0;
  const INI_SPECAL_TICKET_VALUE = 0;
  const INI_LOGIN_COUNT = 0;
  const LOGIN_IS_LOGIN = "islogin";
  const LOGIN_COUNT = "count";
  const TICKET_NORMAL = "normal";
  const TICKET_SPECAL = "specal";
  const ID = "id";
  const USER_NAME = "name";
  const USER_GET_NUMBERS = "getnumbers";

  protected function GetIniNoramlTicketValue()
  {
    return self::INI_NORMAL_TICKET_VALUE;
  }

  protected function GetIniSpecalTicketValue()
  {
    return self::INI_SPECAL_TICKET_VALUE;
  }

  protected function GetIniLoginCount()
  {
    return self::INI_LOGIN_COUNT;
  }

  protected function GetIsLogin()
  {
    return self::LOGIN_IS_LOGIN;
  }
}
 ?>
