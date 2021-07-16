<?php
/**
 * @throws Exception
 */
function uploadFile($aData)
{
    $nameFile = '';
    $allowed = [
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/pdf',
        'application/vnd.ms-excel',
        'application/zip',
        'application/xml',
        'application/x-rar',
        'application/msword'
    ];
    if (in_array(strtolower($aData['type']), $allowed)) {
        $nameFile = $aData['name'];
        if (!move_uploaded_file($aData['tmp_name'], "./assets/uploads/files/" . $aData['name'])) {
            throw new Exception('Server problem',400);
        }
        // Xoa file da duoc upload va ton tai trong thu muc tam
        if (isset($aData['tmp_name']) && is_file($aData['tmp_name']) && file_exists($aData['tmp_name'])) {
            unlink($aData['tmp_name']);
        }
    }else{
        throw new Exception('File Upload Không Đúng Định Dạng',400);
    }
    return $nameFile;
}

/**
 * @throws Exception
 */
function checkDataEmpty($aData): bool
{
        foreach ($aData as $key => $data) {
            switch ($key){
                case 'IDGV':
                    if (empty($data)){
                        throw new Exception('ID Giang Vien Không Được Rỗng',400);
                    }
                    if (empty(\ManageFile\Models\LecturersModel::isLecturersExist($data))){
                        throw new Exception('ID Giang Vien Không Tồn Tại',400);
                    }
                    break;
                case 'TenDA':
                    if (empty($data)){
                        throw new Exception('Tên Đồ An Không Được Rỗng',400);
                    }
                    break;
                case 'MoTa':
                    if (empty($data)){
                        throw new Exception('Mô Tả Không Được Rỗng',400);
                    }
                    break;
                case 'DinhKem':
                    if (empty($data)){
                        throw new Exception('Đính Kèm Không Được Rỗng',400);
                    }
                    break;
            }
        }
        return true;
}
