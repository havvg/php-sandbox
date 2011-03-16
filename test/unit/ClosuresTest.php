<?php

namespace Sandbox\Test;

use Sandbox\Closures\Foo;

require_once(__DIR__ . '/../../lib/Closures.php');

class Closures extends \PHPUnit_Framework_TestCase
{
  public function testUse()
  {
    global
      $fnUseValue,
      $fnUseReference;

    $this->assertEquals(250, $fnUseValue(), 'use() statement of anonymous functions use values by default.');
    $this->assertEquals(240, $fnUseReference(), 'use() statement accepts variables by reference.');
  }

  /**
   * @covers Sandbox\Closures\Foo
   */
  public function testFoo()
  {
    global $fnWithSelf;

    $foo = new Foo();
    $foo->setCallback($fnWithSelf);

    $this->assertEquals($fnWithSelf, $foo->getCallback(), 'The actual callback can be retrieved.');
    $this->assertEquals($foo, $foo->callback('a parameter'), 'We can pass the current object re-mapping the callback.');
  }
}