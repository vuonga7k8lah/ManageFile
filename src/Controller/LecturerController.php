<?php


namespace ManageFile\Controller;


use Exception;
use ManageFile\Core\HandleResponse;
use ManageFile\Models\FilesModel;
use ManageFile\Models\LecturersModel;

class LecturerController
{
    protected array $defineParam
        = [
            'TenGV',
            'DiaChi',
            'SDT',
            'Khoa'
        ];

    public function getLecturers($aData)
    {
        $limit =(int) (isset($aData['limit']) && !empty($aData['limit'])) ?$aData['limit']: 1;
        $page = (int) (isset($aData['page']) && !empty($aData['page'])) ?$aData['page']: 1;
        $id = $aData['ID'] ?? '';
        $aData = [];
        $aRawData = LecturersModel::getAll($id, $limit, $page);
        foreach ($aRawData as $data) {
            $aData[] = [
                'id'          => $data[0],
                'ten_gv'      => $data[1],
                'dia_chi'     => $data[2],
                'sdt'         => $data[3],
                'khoa'        => $data[4],
                'create_date' => $data[5],
            ];
        }
        if (count($aRawData) == 1) {
            $aResponse = $aData;
        } else {
            $aResponse = [
                'items' => $aData,
                'limit' => $limit,
                'page'  => ceil(LecturersModel::countProject() / $limit)
            ];
        }
        echo HandleResponse::success('list data', $aResponse);
        die();
    }

    public function getLecturer($aData)
    {
        echo HandleResponse::success('sdsdsdsds', $aData);
        die();
    }

    public function createLecturer($aData)
    {
        try {
            checkDataIsset($this->defineParam,$aData);
            if (checkDataEmpty($aData)) {
                $status = LecturersModel::insert($aData);
                if ($status) {
                    echo HandleResponse::success('create Lecturer successfully');
                    die();
                } else {
                    throw new Exception('create Lecturer  error', 400);
                }
            }
        } catch (Exception $exception) {
            echo HandleResponse::error($exception->getMessage(), $exception->getCode());
        }
    }

    public function updatelecturer($aData)
    {

    }

    public function deletelecturer($aData)
    {

    }
}