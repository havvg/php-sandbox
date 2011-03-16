<?php

namespace MyNamespace
{
  class Foo
  {
    public function __toString()
    {
      return get_class($this);
    }
  }

  class DateTime extends Foo
  {

  }
}

namespace MyOtherNamespace
{
  use MyNamespace\Foo as LibFoo;

  class Foo
  {
    public function __toString()
    {
      return get_class($this);
    }
  }

  class Bar extends Foo
  {

  }

  class OtherBar extends LibFoo
  {

  }

  class YetAnotherBar extends \MyNamespace\Foo
  {

  }
}

# global namespace
namespace
{
  use MyOtherNamespace\Bar;                          # available as Bar, implies 'as Bar'
  use MyOtherNamespace\Foo;                          # available as Foo, implies 'as Foo'
  use MyNamespace\Foo as OriginalFoo;                # would collide with class above

  // get the correct class
  $foo = new \MyNamespace\Foo();
  $originalFoo = new OriginalFoo();
  $otherFoo = new Foo();
  $bar = new Bar();

  $myDt = new \MyNamespace\DateTime;
  $dt = new DateTime();

  echo
    $foo, PHP_EOL,
    $originalFoo, PHP_EOL,
    $otherFoo, PHP_EOL,
    $bar, PHP_EOL
  ;
}