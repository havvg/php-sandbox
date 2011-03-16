<?php

namespace Sandbox\Test;

use
  Sandbox\LateStaticBinding\Foo,
  Sandbox\LateStaticBinding\Bar;

require_once(__DIR__ . '/../../lib/LateStaticBinding.php');

class LateStaticBinding extends \PHPUnit_Framework_TestCase
{
  /**
   * @covers Sandbox\LateStaticBinding\Foo::getStaticValue
   * @covers Sandbox\LateStaticBinding\Bar::getStaticValue
   */
  public function testGetStaticValue()
  {
    $this->assertEquals('foo', Foo::getStaticValue(), 'self::$value is retrieved from methods context.');
    $this->assertEquals('foo', Bar::getStaticValue(), 'self::$value is retrieved from methods context.');
  }

  /**
   * @covers Sandbox\LateStaticBinding\Foo::getLateBoundStaticValue
   * @covers Sandbox\LateStaticBinding\Bar::getLateBoundStaticValue
   */
  public function testGetLateBoundStaticValue()
  {
    $this->assertEquals('foo', Foo::getLateBoundStaticValue(), 'static::$value is retrieved from instance context.');
    $this->assertEquals('bar', Bar::getLateBoundStaticValue(), 'static::$value is retrieved from instance context.');
  }
}