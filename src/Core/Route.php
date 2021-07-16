<?php


namespace ManageFile\Core;


class Route
{
    private static $_sefl  = null;
    private static $aRoute = null;

    public static function Load($route)
    {
        if (self::$_sefl == null) {
            self::$_sefl = new self();
        }
        $aRoute = self::$_sefl;
        include $route;
        return self::$_sefl;
    }

    public static function get($uri, $controller)
    {
        self::$aRoute['GET'][$uri] = $controller;
    }

    public static function post($uri, $controller)
    {
        self::$aRoute['POST'][$uri] = $controller;
    }

    public static function put($uri, $controller)
    {
        self::$aRoute['PUT'][$uri] = $controller;
    }

    public function direct($uri, $method)
    {
        if (!$controller = $this->routeIsExist($uri, $method)) {
            echo "404";
            die();
        } else {
            $oinit = explode('@', $controller);
            $this->callRoute($oinit[0], $oinit[1],$this->getPara($method));
        }
    }

    public function routeIsExist($uri, $method)
    {
        return array_key_exists($uri, self::$aRoute[$method]) ? self::$aRoute[$method][$uri] : false;
    }

    public function callRoute($controller, $method, $para = [])
    {

        $oInit = new $controller;
        call_user_func_array([$oInit, $method], [$para]);
    }

    public function getPara($method): array
    {
        $aData = [];
        switch (strtoupper($method)) {
            case 'GET':
            case 'DELETE':
                $aData = $_GET;
                break;
            case 'POST':
                $aData = $_POST;
                break;
            case 'PUT':
                $aData=[];
                $rawData=file_get_contents("php://input");
                foreach (explode('&',$rawData) as $data){
                    $aCoverData=explode('=',$data);
                    $aData[$aCoverData[0]]=$aCoverData[1];
                }
                break;
        }
        return $aData;
    }
}