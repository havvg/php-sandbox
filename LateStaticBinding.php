<?php

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

echo
  Foo::getStaticValue(), PHP_EOL,            # foo
  Foo::getLateBoundStaticValue(), PHP_EOL,   # foo
  Bar::getStaticValue(), PHP_EOL,            # foo
  Bar::getLateBoundStaticValue(), PHP_EOL    # bar
;