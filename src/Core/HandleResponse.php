<?php


namespace ManageFile\Core;


class HandleResponse
{
    public static function error($msg, $code)
    {
        header(self::_build_http_header_string($code));
        header("Content-Type: application/json");
        return json_encode([
            'status' => 'error',
            'msg'    => $msg,
            'code'   => $code
        ]);
    }

    public static function success($msg, $aData = [])
    {
        header(self::_build_http_header_string(200));
        header("Content-Type: application/json");
        return json_encode([
            'status' => 'success',
            'msg'    => $msg,
            'data'   => $aData,
            'code'   => 200
        ]);
    }
    private static function _build_http_header_string($statusCode):string
    {
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error'
        );
        return "HTTP/1.1 " . $statusCode . " " . $status[$statusCode];
    }
}