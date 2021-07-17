<?php


namespace ManageFile\Controller;


use Exception;
use ManageFile\Core\HandleResponse;
use ManageFile\Models\FilesModel;
use ManageFile\Models\LecturersModel;

class ManageFIleController
{
    protected array $defileData
        = [
            'TenDA',
            'IDGV',
            'MoTa'
        ];

    public function createProject($aData)
    {
        try {
            if (!isset($_FILES) || empty($_FILES['files'])) {
                throw new Exception('Chua Upload', 400);
            }
            checkDataIsset($this->defileData, $aData);
            if (checkDataEmpty($aData)) {
                $aData['DinhKem'] = uploadFile($_FILES['files']);
                $status = FilesModel::insert($aData);
                if ($status) {
                    echo HandleResponse::success('create Project successfully');
                    die();
                } else {
                    throw new Exception('create Project  error', 400);
                }
            }
        } catch (Exception $exception) {
            echo HandleResponse::error($exception->getMessage(), $exception->getCode());
        }
    }

    public function getProjects($aData)
    {
        $limit =(int) (isset($aData['limit']) && !empty($aData['limit'])) ?$aData['limit']: 1;
        $page = (int) (isset($aData['page']) && !empty($aData['page'])) ?$aData['page']: 1;
        $id = $aData['ID'] ?? '';
        $aData = [];
        $aRawData = FilesModel::getAll($id, $limit, $page);
        foreach ($aRawData as $data) {
            $aDataGVCover = LecturersModel::getOneGV($data[1]);
            $aData[] = [
                'id'         => $data[0],
                'info_gv'    => [
                    'id'          => $aDataGVCover['ID'],
                    'ten_gv'      => $aDataGVCover['TenGV'],
                    'dia_chi'     => $aDataGVCover['DiaChi'],
                    'sdt'         => $aDataGVCover['SDT'],
                    'khoa'        => $aDataGVCover['Khoa'],
                    'create_date' => $aDataGVCover['CreateDate'],
                ],
                'ten_da'     => $data[2],
                'mo_ta'      => $data[3],
                'dinh_kem'   => $data[4],
                'ceate_date' => $data[5],
            ];
        }
        if (count($aRawData) == 1) {
            $aResponse = $aData;
        } else {
            $aResponse = [
                'items' => $aData,
                'limit' => $limit,
                'page'  => ceil(FilesModel::countProject() / $limit)
            ];
        }
        echo HandleResponse::success('list data', $aResponse);
        die();
    }

    public function updateProject($aData)
    {
        try {
            if (checkDataEmpty($aData)) {
                if (!FilesModel::isProjectExist($aData['ID'])) {
                    throw new Exception('Project Chưa Tồn Tại', 400);
                }
                $status = FilesModel::update($aData['ID'], $aData);
                if ($status) {
                    echo HandleResponse::success('update Project successfully');
                    die();
                } else {
                    throw new Exception('create Project  error', 400);
                }
            }
        } catch (Exception $exception) {
            echo HandleResponse::error($exception->getMessage(), $exception->getCode());
        }
    }

    public function deleteProject($aData)
    {
        try {
            if (checkDataEmpty($aData)) {
                if (!FilesModel::isProjectExist($aData['ID'])) {
                    throw new Exception('Project Chưa Tồn Tại', 400);
                }
                $status = FilesModel::delete($aData['ID']);
                $nameFile = FilesModel::getFields($aData['ID'], 'DinhKem');
                unlink('./assets/uploads/files/' . $nameFile);
                if ($status) {
                    echo HandleResponse::success('DELETE Project successfully');
                    die();
                } else {
                    throw new Exception('DELETE Project  error', 400);
                }
            }
        } catch (Exception $exception) {
            echo HandleResponse::error($exception->getMessage(), $exception->getCode());
        }
    }
}