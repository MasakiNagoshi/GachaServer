<?php
class SpecalGachaRate
{
  const RATE_MAX_VALUE = 100;
  const RATE_MIN_VALUE = 0;
  const R_MAX_VALUE = 100;
  const R_MIN_VALUE = 30;
  const SR_MAX_VALUE = 29;
  const SR_MIN_VALUE = 2;
  const SSR_MAX_VALUE = 1;
  const SSR_MIN_VALUE = 0;

  function GetRateMaxValue()
  {
    return self::RATE_MAX_VALUE;
  }
  function GetRateMinValue()
  {
    return self::RATE_MIN_VALUE;
  }

  function GetRMaxValue()
  {
    return self::R_MAX_VALUE;
  }

  function GetRMinValue()
  {
    return self::R_MIN_VALUE;
  }

  function GetSRMaxValue()
  {
    return self::SR_MAX_VALUE;
  }

  function GetSRMinValue()
  {
    return self::SR_MIN_VALUE;
  }

  function GetSSRMaxValue()
  {
    return self::SSR_MAX_VALUE;
  }
  
  function GetSSRMinValue()
  {
    return self::SSR_MIN_VALUE;
  }
}
?>
