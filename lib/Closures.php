<?php

namespace Sandbox\Closures;

use \Closure;

$global = 250;
$fnUseValue = function() use($global) # use() call by value
{
  return $global;
}; # This semi-colon is important.

$fnUseReference = function() use(&$global) # use() call by reference
{
  return $global;
};
$global = 240;

$fnWithSelf = function ($param, $self) {
  return $self;
};

class Foo
{
  protected $callbackFn;

  public function setCallback(Closure $fn)
  {
    $this->callbackFn = $fn;
  }

  public function getCallback()
  {
    return $this->callbackFn;
  }

  public function callback($param)
  {
    /*
     * This does not work:
     * $this->callbackFn($param);
     */

    # How to pass the current object to the closure.
    $self = $this;
    $fn = $this->getCallback();

    $callback = function ($param) use(&$self, $fn)
    {
      return $fn($param, $self);
    };

    return $callback($param);
  }
}