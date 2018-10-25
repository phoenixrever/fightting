<?php

interface TravelTool
{
    public function go();
}

class Container
{
    protected $bindings = [];

    public function bind($abstract, $concrete = null, $shared = false)
    {
        echo $abstract.'---------'.$concrete.'<br>';

        //$concrete = function ($c) use (Visit, Train) {
        //    $method = ($abstract == $concrete) ? 'bulid' : 'make';
        //    return $c->$method(Train);
        //};

        if (! $concrete instanceof Closure) {
            $concrete = $this->getClosure($abstract, $concrete);
            //$a = new Reflectionclass($concrete);
            echo 'getClosure'.'<br>';
            print "<pre>";
            print_r($concrete);
            print "</pre>";
        }
        $this->bindings[$abstract] = compact('concrete', 'shared');
        print("<pre>"); // 格式化输出数组
        print_r($this->bindings);
        print("</pre>");
    }

    protected function getClosure($abstract, $concrete)
    {
        echo 'getClosure-realy'."<br>";

        return function ($c) use ($abstract, $concrete) {
            echo "use--------------------------------------------------------------------<br>";
            echo $abstract.'<--------->'.$concrete."<br>";
            $method = ($abstract == $concrete) ? 'bulid' : 'make';
            echo $abstract."---getClosure----"."<br>";
            //$a = new Reflectionclass($c);
            echo "$method";
            echo "return getClosure<br>";

            echo "</pre>";
            print_r($concrete);
            echo "</pre>";

            return $c->$method($concrete);
        };
    }

    public function make($abstract)//'traveller Visit
    {
        $concrete = $this->getConcrete($abstract);//$concrete=traveller
        echo "nnnnnnnnnnnnnnnnn<br>";
        print("<pre>"); // 格式化输出数组
        print_r($concrete);
        print("</pre>");
        if ($this->isBuildable($concrete, $abstract)) {
            $object = $this->build($concrete);
            print("<pre>"); // 格式化输出数组
            print_r($object);
            print("</pre>");
        } else {
            $object = $this->make($concrete);
        }

        return $object;
    }

    protected function isBuildable($concrete, $abstract)
    {
        return $concrete === $abstract || $concrete instanceof Closure;
    }

    protected function getConcrete($abstract)
    {
        if (! isset($this->bindings[$abstract])) {
            echo "yes".$abstract."<<<----------->>>>>";

            return $abstract;
        }
        echo "!!!!!!!!!!!!!!!!!!!!!!!!!<br>";
        print("<pre>"); // 格式化输出数组
        print_r($this->bindings[$abstract]['concrete']);
        print("</pre>");

        return $this->bindings[$abstract]['concrete'];
    }

    public function build($concrete)
    {
        if ($concrete instanceof Closure) {

            return $concrete($this);
        }
        echo "$concrete<-----------------------<br>";
        $reflector = new ReflectionClass($concrete);
        echo "$concrete>>>>>>>>>>>>>>------<br>";
        print("<pre>"); // 格式化输出数组
        print($reflector);
        print("</pre>");

        if (! $reflector->isInstantiable()) {
            echo $message = "Target [$concrete] is not instantiabl.e";
        } else {
            echo $message = "Target [$concrete] is  instantiabl.e";
        }

        $constructor = $reflector->getConstructor();
        echo "null----------------";
        print("<pre>"); // 格式化输出数组
        print($constructor);
        print("</pre>");

        if (is_null($constructor)) {
            echo "<<<<<<< $concrete>>>>>>>>>>";

            return new $concrete;
        }

        $dependencies = $constructor->getParameters();
        $instances = $this->getDependencies($dependencies);

        echo "++++++++++";
        print_r($reflector->newInstanceArgs($instances));
        echo "++++++++++";

        return $reflector->newInstanceArgs($instances);

    }

    protected function getDependencies($parameters)
    {
        $dependencies = [];
        foreach ($parameters as $parameter) {
            print_r($parameter);
            $dependency = $parameter->getClass();
            echo "oooooooooo<br>";
            print_r($dependency);
            echo "oooooooooo<br>";
            if (is_null($dependency)) {
                $dependencies[] = null;
            } else {
                echo "dependencies>>>>>>>>>>>>>";
                print("<pre>"); // 格式化输出数组
                print_r($dependencies);
                print("</pre>");
                echo "dependencies>>>>>>>>>>>>>";
                $dependencies[] = $this->resolveClass($parameter);//---------
                echo "dependencies>>>>>>>>>>>>>";
                print("<pre>"); // 格式化输出数组
                print_r($dependencies);
                print("</pre>");
                echo "dependencies>>>>>>>>>>>>>";
            }
        }

        return (array) $dependencies;
    }

    protected function resolveClass(ReflectionParameter $parameter)
    {
        return $this->make($parameter->getClass()->name);//make visit
    }
}

class Traveller
{
    protected $trafficTool;

    public function __construct(TravelTool $trafficTool)
    {
        $this->trafficTool = $trafficTool;
    }

    public function visitTibet()
    {
        $this->trafficTool->go();
    }
}

class Train implements TravelTool
{
    public function go()
    {
        // TODO: Implement go() method.
        echo "go to tibet by train!!!";
    }
}

$app = new Container();
$app->bind("TravelTool", "Train");
//$app->bind("traveller", "Traveller");

$traveller = $app->make("traveller");
$traveller->visitTibet();

