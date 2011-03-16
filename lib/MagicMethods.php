<?php

namespace Sandbox\MagicMethods;

class Foo
{
  private $attribute;

  public function __construct()
  {
    echo 'called Foo::__construct()';
  }

  public function __destruct()
  {
    echo 'called Foo::__destruct()';
  }

  public function __toString()
  {
    echo 'called Foo::__toString()';
    return get_class($this);
  }

  public function __set($name, $value)
  {
    echo sprintf('called Foo::__set(%s, %s)', $name, $value);
    $this->$name = $value;
  }

  public function __get($name)
  {
    echo sprintf('called Foo::__get(%s)', $name);
    return $this->$name;
  }
}