<?php


namespace ManageFile\Database;

use Exception;
use ManageFile\Core\App;
use mysqli;

/**
 *
 * @throws  Exception
 */
class DB
{
    private static $self=null;

    public static function Connect(): mysqli
    {
        if (empty(self::$self)) {
            self::$self= new mysqli(
                App::get('config/app')['Database']['host'],
                App::get('config/app')['Database']['username'],
                App::get('config/app')['Database']['password'],
                App::get('config/app')['Database']['database']
            );
        }
        return self::$self;
    }

}