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

    public function getProjects($aDataParam)
    {
        $id = '';
        if (isset($aDataParam['ID']) && !empty($aDataParam['ID'])) {
            $limit = 1;
            $page = 1;
            $id = $aDataParam['ID'];
        } else {
            $limit = (int)(isset($aDataParam['limit']) && !empty($aDataParam['limit'])) ? $aDataParam['limit'] : 1000;
            $page = (int)(isset($aDataParam['page']) && !empty($aDataParam['page'])) ? $aDataParam['page'] : 1;
        }
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

    public function updateProject($aData)
    {
        try {
            if (checkDataEmpty($aData)) {
                checkDataIsset(['ID'], $aData);
                if (isset($_FILES['files'])) {
                    if (empty($_FILES['files'])) {
                        throw new Exception('Chua Upload', 400);
                    } else {
                        $aData['DinhKem'] = uploadFile($_FILES['files']);
                    }
                }
                if (!FilesModel::isProjectExist($aData['ID'])) {
                    throw new Exception('Project Chưa Tồn Tại', 400);
                }
                $status = FilesModel::update($aData['ID'], $aData);
                if ($status) {
                    echo HandleResponse::success('update Project successfully');
                    die();
                } else {
                    throw new Exception('update Project  error', 400);
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