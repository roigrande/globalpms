<?php
echo "hello world";

echo "<hr>";

class A
{
	
	function foo()
	{		
		if (isset($this)) 
		{
			echo '$this is defined (';
			echo get_class($this);
			echo ")\n";
		} 
		else 
		{
			echo "\$this is not defined.\n";
		}
	}
	

}


$nombreObj = new A();
$nombreObj->foo();



echo "<hr>";


class SimpleClass
{
	public $var8 = array(true, false);
	
	function displayVar()
	{
		echo "estoy en diplay de: ".get_class($this);
	}
	
	function padreDelObjeto()
	{
		echo "Soy padre: ".get_class($this);
	}
}

echo "<hr>";


class ExtendClass extends SimpleClass
{
	// Redefine the parent method
	function displayVar()
	{
		echo "Extending class\n";
		parent::displayVar();
	}
}
$extended = new ExtendClass();
$extended->displayVar();
$extended->padreDelObjeto();


echo "<hr>";


class MyDestructableClass 
{
	function MyDestructableClass()
	{
		echo "esto contruye si no existe contruct";
	}
	
	function __construct() 
	{
		print "In constructor\n";
		$this->name = "MyDestructableClass";
	}
	
	function __destruct() 
	{
		print "Destroying " . $this->name . "\n";
	}
}
$obj = new MyDestructableClass();


echo "<hr>";

class MyClass
{
	public $public = 'Public';
	protected $protected = 'Protected';
	private $private = 'Private';
	
	function printHello()
	{
		echo $this->public;
		echo $this->protected;
		echo $this->private;
	}
}


$obj=new MyClass();
$obj->printHello();

echo "<hr>";

class perro extends MyClass
{
	function printHello()
	{
//		echo $this->public;
//		echo $this->protected;
//		echo $this->private;
		
		parent::printHello();
	}
}

$objperro=new perro();
$objperro->printHello();

echo "<hr>";


class OtherClass extends MyClass
{
	public static $my_static = 'static var';
	
	function __construct()
	{
		echo "construye";
		self::doubleColon();
		
	}
	protected static function doubleColon() 
	{
		//echo parent::CONST_VALUE . "\n";
		echo self::$my_static . "\n";
	}
}
//OtherClass::doubleColon();
$obj = new OtherClass();

echo "<hr>";

class MyClass2
{
	const constant = 'constant value';
	function showConstant() 
	{
		echo self::constant . "\n";
	}
}
echo "-del echo-".MyClass2::constant . "\n";
$class = new MyClass2();
$class->showConstant();
// echo $class::constant; is not allowed



