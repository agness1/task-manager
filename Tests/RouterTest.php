<?php
use PHPUnit\Framework\TestCase;
use App\Routing\Request;

class RouterTest extends TestCase
{

    public function testPath () 
    {
        $_SERVER['REQUEST_URI'] = '/example';
        $request = new Request();
        $this->assertEquals('/example', $request->getPath());
    }

    public function testMethod () 
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $request = new Request();
        $this->assertEquals('post', $request->method());
    }

    public function testIsGet () 
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $request =  new Request();
        $this->assertTrue($request->isGet());
    }

    public function testIsPost () 
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $request =  new Request();
        $this->assertTrue($request->isPost());
    }

}