<?php
//class Base
//{
//    public function hello()
//    {
//        echo 'method hello from class Base'.'<br>';
//    }
//}

trait Hello
{
    public function hello()
    {
        echo 'method hello from Trait Hello!'.'<br>.';
    }

    public function hi()
    {
        echo 'method hi from Trait Hello'.'<br>';
    }
    abstract public function getValue();
    static public function staticMethod()
    {
        echo 'static method staticMethod from trait Hello'.'<br>';
    }

    public function staticValue()
    {
        static $value;
        $value++;
        echo "Value".'<br>';
    }
}

trait Hi
{
    public function hello()
    {
        parant::hello();
        echo 'method hello from Trait Hi'.'<br>';
    }

    public function hi()
    {
        echo 'method hi from Trait Hi'.'<br>';
    }
}

trait HelloHi
{
    use Hello,Hi{
        Hello::hello insteadof Hi;
        Hi::hi insteadof Hello;
    }
}

class MyNew extends Base
{
    use HelloHi;
    private $value = 'class MyNew'.'<br>';

    public function hi()
    {
        echo 'method hi frim class MyNew'.'<br>';
    }

    public function getValue()
    {
        return $this->value;
    }
}

$objOther=new MyNew();
echo $objOther->staticValue();