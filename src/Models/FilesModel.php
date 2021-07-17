<?php


namespace ManageFile\Models;


use ManageFile\Database\DB;

class FilesModel
{
    public static function getAll($id='',$limit=1,$page=1)
    {
        $aRawWhere='';
        $start = ($page - 1) * $limit;
        if (!empty($id)) {
            $aRawWhere= "WHERE ID =" . $id;
        }
        $sql=sprintf("SELECT * FROM DoAn ".$aRawWhere." ORDER BY CreateDate DESC LIMIT %d,%d",$start,$limit);
        $result = DB::Connect()->query($sql);
        return !empty($result) ? $result->fetch_all() : [];
    }
    public static function isProjectExist($id):bool
    {
        $result = self::getFields($id,'ID');
        return !empty($result);
    }
    public static function countProject():int
    {
        $result = DB::Connect()->query("SELECT count(ID) as ID FROM DoAn")->fetch_assoc();
        return !empty($result) ?(int) $result['ID'] : 0;
    }

    public static function getOne($id): array
    {
        $result = DB::Connect()->query("SELECT * FROM DoAn WHERE ID=" . $id . " ")->fetch_assoc();
        return !empty($result) ? $result : [];
    }

    public static function insert($aData)
    {
        $sql = "INSERT INTO `DoAn`(`ID`, `IDGV`, `TenDA`, `MoTA`, `DinhKem`, `CreateDate`) VALUES (null ," .
            $aData['IDGV'] . ",'" . $aData['TenDA'] . "','" . $aData['MoTa'] . "','" . $aData['DinhKem'] . "',null)";
        return DB::Connect()->query($sql);
    }

    public static function update($id, $aData)
    {
        $query = [];
        if ($aData['IDGV'] ?? '') {
            $query[] = " IDGV ='" . $aData['IDGV'] . "'";
        }
        if ($aData['TenDA'] ?? '') {
            $query [] = " TenDA = " . $aData['TenDA'];
        }
        if ($aData['MoTa'] ?? '') {
            $query [] = " MoTA = '" . $aData['MoTa'] . "'";
        }
        if (isset($aData['DinhKem'])) {
            $query [] = " DinhKem = '" . $aData['DinhKem'] . "'";
        }
        $query = array_merge($query, [" CreateDate = null"]);
        $sql = "UPDATE `DoAn` SET " . implode(',', $query) . " WHERE ID='" . $id . "'";

        return DB::Connect()->query($sql);
    }

    public static function delete($id)
    {
        return DB::Connect()->query("DELETE FROM `DoAn` WHERE ID=" . $id . " ");
    }

    public static function getFields($id, $field)
    {
        $result = DB::Connect()->query("SELECT " . $field . " FROM DoAn WHERE ID=" . $id . " ");
        return (!empty($result)) ? ($result->fetch_assoc())[$field] : '';
    }
}