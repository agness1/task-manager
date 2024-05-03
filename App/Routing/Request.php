<?php

namespace App\Routing;

class Request 
{
    public function getPath()
    {

        $path =  $_SERVER['REQUEST_URI'] ?? '/';

        $position = strpos($path, '?');
        if($position === false){
            return $path;
        }

        $path = substr($path, 0, $position);

    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);

    }
    public function isGet()
    {
        return $this->method() === 'get';

    }
    public function isPost()
    {
        return $this->method() === 'post';

    }

    public function getBody()
    {
        $body = [];
        $method = $this->method();

    
    if ($method === 'post' && isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if ($data !== null) {
            foreach ($data as $key => $value) {
                $body[$key] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
    } elseif ($method === 'get') {
        foreach ($_GET as $key => $value) {
            $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
    } elseif ($method === 'post') {
        foreach ($_POST as $key => $value) {
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
    }


        return $body;
    }
}