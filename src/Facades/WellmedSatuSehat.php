<?php

namespace Projects\WellmedSatuSehat\Facades;

class WellmedSatuSehat extends \Illuminate\Support\Facades\Facade
{
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor()
  {
    return \Projects\WellmedSatuSehat\Contracts\WellmedSatuSehat::class;
  }
}
