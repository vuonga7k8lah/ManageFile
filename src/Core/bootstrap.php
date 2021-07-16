<?php
use ManageFile\Core\App;
use ManageFile\Core\Request;
use ManageFile\Core\Route;
use ManageFile\Database\DB;
require_once 'vendor/autoload.php';
require_once 'src/Shares/function.php';
ini_set("allow_url_fopen", true);
App::bind('config/app',require_once 'config/app.php');
Route::Load('config/router.php')->direct(Request::uri(),Request::method());
