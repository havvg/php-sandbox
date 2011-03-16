<?php

namespace Sandbox\Reflection;

use
  \Exception,
  \ReflectionClass;

class Foo
{
  public function __set($name, $value)
  {
    $valid = false;

    $reflection = new ReflectionClass($this);
    if ($reflection->hasProperty($name))
    {
      $doc = $reflection->getProperty($name)->getDocComment();
      foreach (explode(PHP_EOL, $doc) as $eachLine)
      {
        $matches = array();
        if (preg_match('/^@var (.*)$/', trim($eachLine, " \t\n\r*"), $matches))
        {
          $type = $matches[1];
          if (class_exists($type, true) and ($value instanceof $type))
          {
            $valid = true;
          }
          else
          {
            $fnName = 'is_' . $type;
            if (function_exists($fnName))
            {
              $valid = call_user_func($fnName, $value);
            }
          }
        }
      }
    }

    if ($valid)
    {
      $this->$name = $value;
    }
    else
    {
      throw new Exception('The given value is invalid.');
    }
  }

  public function __get($name)
  {
    if (isset($this->$name))
    {
      return $this->$name;
    }
    else
    {
      throw new Exception('Property does not exist.');
    }
  }
}

class Bar extends Foo
{
  /**
   * @var int
   */
  protected $id;

  /**
   * @var string
   */
  protected $name;

  /**
   * @var bool
   */
  protected $isActive;
}