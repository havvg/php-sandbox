<?php

$global = 250;
# simple anonymous function
$fn = function ($param, $self = null) use($global)
{
  echo
    $param, PHP_EOL,
    $global, PHP_EOL
  ;

  if (!is_null($self))
  {
    echo get_class($self), PHP_EOL;
  }
};                                                   # This semi-colon is important.

$fn('ehlo');
echo PHP_EOL, PHP_EOL;

# changing global vars
$global = 240;
$fn('ehlo');                                         # will still echo 250

$fn = function ($param, $self = null) use(&$global)  # call by reference instead of value
{
  echo
    $param, PHP_EOL,
    $global, PHP_EOL
  ;

  if (!is_null($self))
  {
    echo get_class($self), PHP_EOL;
  }
};
$global = 240;
$fn('ehlo');                                           # will now echo 240
echo PHP_EOL, PHP_EOL;

class Foo
{
  private $callbackFn;

  public function setCallback(Closure $fn)
  {
    # How to pass the current object to the closure.
    $self = $this;
    $this->callbackFn = function ($param) use(&$self, $fn)
    {
      $fn($param, $self);
    };
  }

  public function getCallback()
  {
    return $this->callbackFn;
  }

  public function callback($param)
  {
    /**
     * This does not work:
     *
     * $this->callbackFn($param);
     */

     $fn = &$this->callbackFn;
     $fn($param);
  }
}

$foo = new Foo();
$foo->setCallback($fn);
$foo->callback('ehlo');

echo PHP_EOL;
echo get_class($foo->getCallback());

echo PHP_EOL;