<?php

use ManageFile\Core\App;
use ManageFile\Core\Request;
use ManageFile\Core\Route;
use ManageFile\Database\DB;

require_once 'vendor/autoload.php';
require_once 'src/Shares/function.php';
ini_set("allow_url_fopen", true);
ini_set('default_charset', 'utf-8');
App::bind('config/app', require_once 'config/app.php');
App::bind('config/route.php', require_once 'config/router.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
if (Request::method()=='GET' || Request::method()=='DELETE'){
    if (count($_GET) > 1 || count(explode('/', Request::uri()))>1) {
        $aData = $_GET;
        unset($aData['route']);
        if (isset($_GET['route'])){
            $aURI = explode('/', $_GET['route']);
            $aData['route'] = $_GET['route'];
        }else{
            $aURI=explode('/', Request::uri());
        }
        if (count($aURI) > 1) {
            $aData['route'] = $aURI[0];
            $aData['ID'] = $aURI[1];
        }
        Route::Load('config/route.php')->directRoute($aData, strtolower(Request::method()));
    }else{
        Route::Load('config/route.php')->direct(Request::uri(), strtolower(Request::method()));
    }
}
 else {
    Route::Load('config/route.php')->direct(Request::uri(), strtolower(Request::method()));
}
