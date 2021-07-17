<?php


namespace ManageFile\Controller;


use Exception;
use ManageFile\Core\HandleResponse;
use ManageFile\Models\UserModel;

class UserController
{
    protected array $defineLogin=[
      'username',
      'password'
    ];
    public function login($aData)
    {
        try {
            checkDataIsset($this->defineLogin,$aData);
            if (checkDataEmpty($aData)) {

                $status = UserModel::isLogin($aData);
                if ($status) {
                    echo HandleResponse::success('Congratulations, The account id Login successfully');
                    die();
                } else {
                    throw new Exception('Sorry, You have entered an invalid username or password', 400);
                }
            }
        } catch (Exception $exception) {
            echo HandleResponse::error($exception->getMessage(), $exception->getCode());
        }
    }
}