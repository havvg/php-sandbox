<?php

namespace Sandbox\Test;

use
  Sandbox\LateStaticBinding\Foo,
  Sandbox\LateStaticBinding\Bar;

require_once(__DIR__ . '/../../lib/LateStaticBinding.php');

class LateStaticBinding extends \PHPUnit_Framework_TestCase
{
  public function testGetStaticValue()
  {
    $this->assertEquals('foo', Foo::getStaticValue(), 'self::$value is retrieved from methods context.');
    $this->assertEquals('foo', Bar::getStaticValue(), 'self::$value is retrieved from methods context.');
  }

  public function testGetLateBoundStaticValue()
  {
    $this->assertEquals('foo', Foo::getLateBoundStaticValue(), 'static::$value is retrieved from instance context.');
    $this->assertEquals('bar', Bar::getLateBoundStaticValue(), 'static::$value is retrieved from instance context.');
  }
}