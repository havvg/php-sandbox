<?php

namespace Sandbox\Test;

use Sandbox\MagicMethods\Foo;

require_once(__DIR__ . '/../../lib/MagicMethods.php');

/**
 * @outputBuffering enabled
 */
class MagicMethods extends \PHPUnit_Extensions_OutputTestCase
{
  public function testConstruct()
  {
    $this->expectOutputString('called Foo::__construct()');

    return new Foo();
  }

  /**
   * @depends testConstruct
   */
  public function testToString($foo)
  {
    $this->assertEquals('Sandbox\MagicMethods\Foo', (string) $foo);

    return $foo;
  }

  /**
   * @depends testToString
   */
  public function testSet($foo)
  {
    $this->expectOutputString('called Foo::__set(attribute, MyAttribute)');
    $foo->attribute = 'MyAttribute';

    return $foo;
  }

  /**
   * @depends testSet
   */
  public function testGet($foo)
  {
    $this->expectOutputString('called Foo::__get(attribute)');
    $this->assertEquals('MyAttribute', $foo->attribute);
  }

  /**
   * @depends testGet
   */
  public function testDestruct()
  {
    $this->expectOutputString('called Foo::__construct()called Foo::__destruct()');

    $foo = new Foo();
    unset($foo);
  }
}