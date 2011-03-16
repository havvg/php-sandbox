<?php

namespace Sandbox\Test;

use
  Sandbox\MyOtherNamespace\Foo,
  Sandbox\MyOtherNamespace\Bar,
  Sandbox\MyNamespace\Foo as OriginalFoo;

require_once(__DIR__ . '/../../lib/Namespaces.php');

class Namespaces extends \PHPUnit_Framework_TestCase
{
  public function constructorProvider()
  {
    return array(
      array(new \Sandbox\MyNamespace\Foo(),     'Sandbox\MyNamespace\Foo'),
      array(new OriginalFoo(),                  'Sandbox\MyNamespace\Foo'),
      array(new Foo(),                          'Sandbox\MyOtherNamespace\Foo'),
      array(new Bar(),                          'Sandbox\MyOtherNamespace\Bar'),
      array(new \Sandbox\MyNamespace\DateTime,  'Sandbox\MyNamespace\DateTime'),
    );
  }

  /**
   * @dataProvider constructorProvider
   *
   * @covers Sandbox\MyNamespace\Foo
   * @covers Sandbox\MyOtherNamespace\Foo
   * @covers Sandbox\MyOtherNamespace\Bar
   * @covers Sandbox\MyNamespace\DateTime
   */
  public function testConstructors($object, $expected)
  {
    $this->assertInstanceOf($expected, $object);
  }
}
