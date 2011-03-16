<?php

class Foo
{
  private $attribute;

  public function __construct()
  {
    echo 'called Foo::__construct()', PHP_EOL;
  }
  
  public function __destruct()
  {
    echo 'called Foo::__destruct()', PHP_EOL;
  }
  
  public function __toString()
  {
    echo 'called Foo::__toString()', PHP_EOL;
    return get_class($this);
  }

  public function __set($name, $value)
  {
    echo sprintf('called Foo::__set(%s, %s)', $name, $value), PHP_EOL;
    $this->$name = $value;
  }
  
  public function __get($name)
  {
    echo sprintf('called Foo::__get(%s)', $name), PHP_EOL;
    return $this->$name;
  }
}

$foo = new Foo();                                    # __construct
echo $foo, PHP_EOL;                                  # __toString

$foo->attribute = 'MyAttribute';                     # __set
echo $foo->attribute, PHP_EOL;                       # __get

unset($foo);                                         # __destruct