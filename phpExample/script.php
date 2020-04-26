<?php
echo strrev("because I can") . "<br>";
echo strlen("Hi " . "World <br>") . '<br>';
$a = 30;
$a *= $a;
echo "{$a} <br>"; // "$a" . "<br>";
echo "Script name: " . $_SERVER['SCRIPT_NAME'] . "<br>";
echo $GLOBALS['a'] . "<br>";

class Example{

    function __construct(){ // old style Example : deprecated
        $this->a = 10;
        $this->b = 20;
    }

    function addition(){
        return $this->a + $this->b;
    }
}

$obj = new Example();
echo "{$obj->addition()} <br>";

$example_arr = ["Hello", "World", "Earth"];
$example_arr[] = "Low life";
$assoc_array = [
    'a' => 1,
    'b' => 2,
    'c' => 3
];
eChO "{$assoc_array['b']} <br>";
var_dump($example_arr);

class Inherited extends Example{
    /**
     * @var int
     */
    private $c;

    public function __construct(){
        parent::__construct();
        $this->c = 100;
    }
    public function sum(){
        return $this->addition() + $this->c;
    }
}

class Singleton{
    protected function __construct(){}
    protected function __clone()
    {
        // TODO: Implement __clone() method.
    }
    protected function __wakeup()
    {
        // TODO: Implement __wakeup() method.
    }
    function example(){
        return "<br>Singleton s*cks";
    }
}

// $fail = new Singleton();
echo Singleton::example();
?>
