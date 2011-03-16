<?php

namespace Sandbox\Test;

use
  Sandbox\Reflection\Foo,
  Sandbox\Reflection\Bar;

require_once(__DIR__ . '/../../lib/Reflection.php');

class Reflection extends \PHPUnit_Framework_TestCase
{
  private $bar;

  protected function setUp()
  {
    parent::setUp();

    $this->bar = new Bar();
  }

  public function validProvider()
  {
    return array(
      //    name        value       message
      array('id',       1337,       'The int has been set correctly.'),
      array('id',       -5,         'The int has been set correctly.'),
      array('name',     'Foobar',   'The string has been set correctly.'),
      array('isActive', false,      'The bool has been set correctly.'),
      array('isActive', true,       'The bool has been set correctly.'),
    );
  }

  /**
   * @dataProvider validProvider
   */
  public function testValidInput($name, $value, $message)
  {
    $this->bar->$name = $value;
    $this->assertEquals($value, $this->bar->$name, $message);
  }

  public function invalidProvider()
  {
    return array(
      //    name        value       exception    message
      array('id',       false,      'Exception', 'A bool is no integer.'),
      array('id',       'string',   'Exception', 'A string is no integer.'),
      array('id',       1.85,       'Exception', 'A float is no integer.'),
      array('id',       array(5),   'Exception', 'An array is no integer.'),
      array('name',     5,          'Exception', 'An integer is no string.'),
      array('isActive', 5,          'Exception', 'An integer is no bool.'),
    );
  }

  /**
   * @dataProvider invalidProvider
   */
  public function testInvalidInput($name, $value, $exception, $message)
  {
    $this->setExpectedException($exception);
    $this->bar->$name = $value;
  }
}