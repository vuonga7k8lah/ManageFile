<?php


namespace ManageFile\Controller;


use Exception;
use ManageFile\Core\HandleResponse;
use ManageFile\Models\FilesModel;

class ManageFIleController
{
    public function createFile($aData)
    {
        try {
            if (!isset($_FILES) || empty($_FILES['files'])) {
                throw new Exception('Chua Upload', 400);
            }
            if (checkDataEmpty($aData)) {
                $aData['DinhKem'] = uploadFile($_FILES['files']);
                $status = FilesModel::insert($aData);
                if ($status) {
                    echo HandleResponse::success('create Do An successfully');
                    die();
                } else {
                    throw new Exception('create Do An  error', 400);
                }
            }
        } catch (Exception $exception) {
            echo HandleResponse::error($exception->getMessage(), $exception->getCode());
        }
    }
}