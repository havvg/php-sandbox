<?php

namespace Sandbox\LateStaticBinding;

class Foo
{
  protected static $value = 'foo';

  public static function getStaticValue()
  {
    return self::$value;
  }

  public static function getLateBoundStaticValue()
  {
    return static::$value;
  }
}

class Bar extends Foo
{
  protected static $value = 'bar';
}