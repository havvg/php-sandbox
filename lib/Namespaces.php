<?php

namespace Sandbox\MyNamespace
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

namespace Sandbox\MyOtherNamespace
{
  use \Sandbox\MyNamespace\Foo as LibFoo;

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

  class YetAnotherBar extends \Sandbox\MyNamespace\Foo
  {

  }
}