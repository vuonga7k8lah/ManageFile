<?php


namespace ManageFile\Controller;


use ManageFile\Core\HandleResponse;

class HomeController
{
    public function loadView($aData)
    {
        var_dump($aData);die();
    }

    public function testUpdate($aData)
    {
        echo HandleResponse::success('sdsdsdsds',$aData);die();
    }
    public function testPost($aData)
    {
        echo HandleResponse::success('oke',$aData);die();
    }

}