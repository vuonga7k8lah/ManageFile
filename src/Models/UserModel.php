<?php


namespace ManageFile\Models;


use ManageFile\Database\DB;

class UserModel
{
    public static function isLogin($aData): bool
    {
        $db = DB::Connect();
        $result = $db->query("SELECT ID FROM users where username='" . $db->escape_string($aData['username']) .
            "' AND password='" .md5( $db->escape_string($aData['password'])) . "'");
        return !empty($result->num_rows);
    }
}