<?php

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

$bar = new Bar();

try
{
  $bar->id = 'bla';
}
catch (Exception $e)
{
  echo 'Exception on __set(id, bla) caught.', PHP_EOL;
}

try
{
  echo $bar->id;
}
catch (Exception $e)
{
  echo 'Exception on __get(id) caught.', PHP_EOL;
}

$bar->id = 5;
echo $bar->id, PHP_EOL;

$bar->isActive = true;
echo (int) $bar->isActive, PHP_EOL;

$bar->name = 'BarName';
echo $bar->name, PHP_EOL;