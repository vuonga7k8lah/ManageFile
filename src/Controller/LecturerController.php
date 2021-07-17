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

    public function getLecturers($aDataParam)
    {
        $id='';
        if (isset($aDataParam['ID']) && !empty($aDataParam['ID'])){
            $limit=1;
            $page=1;
            $id = $aDataParam['ID'];
        }else{
            $limit =(int) (isset($aDataParam['limit']) && !empty($aDataParam['limit'])) ?$aDataParam['limit']: 1000;
            $page = (int) (isset($aDataParam['page']) && !empty($aDataParam['page'])) ?$aDataParam['page']: 1;
        }
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
        if (!empty($id)) {
            $aResponse = $aData;
        } else {
            if (count($aDataParam) == 1) {
                $aResponse = [
                    'items' => $aData
                ];
            } else {
                $aResponse = [
                    'items' => $aData,
                    'limit' => $limit,
                    'page'  => ceil(FilesModel::countProject() / $limit)
                ];
            }
        }
        echo HandleResponse::success('list data', $aResponse);
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
        try {
            if (checkDataEmpty($aData)) {
                if (!LecturersModel::isLecturersExist($aData['ID'])) {
                    throw new Exception('Lecturer Chưa Tồn Tại', 400);
                }
                $status = LecturersModel::update($aData['ID'], $aData);
                if ($status) {
                    echo HandleResponse::success('update Lecturer successfully');
                    die();
                } else {
                    throw new Exception('create Lecturer  error', 400);
                }
            }
        } catch (Exception $exception) {
            echo HandleResponse::error($exception->getMessage(), $exception->getCode());
        }
    }

    public function deletelecturer($aData)
    {
        try {
            if (checkDataEmpty($aData)) {
                if (!LecturersModel::isLecturersExist($aData['ID'])) {
                    throw new Exception('Lecturer Chưa Tồn Tại', 400);
                }
                $status = LecturersModel::delete($aData['ID']);
                if ($status) {
                    echo HandleResponse::success('DELETE Lecturer successfully');
                    die();
                } else {
                    throw new Exception('DELETE Lecturer  error', 400);
                }
            }
        } catch (Exception $exception) {
            echo HandleResponse::error($exception->getMessage(), $exception->getCode());
        }
    }
}