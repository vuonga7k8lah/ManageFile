<?php


namespace ManageFile\Models;


use ManageFile\Database\DB;

class FilesModel
{
    public static function getAll()
    {
        $result = DB::Connect()->query("SELECT * FROM DoAn")->fetch_all();
        return !empty($result) ? $result : [];
    }

    public static function getOne($id): array
    {
        $result = DB::Connect()->query("SELECT * FROM DoAn WHERE ID=" . $id . " ")->fetch_assoc();
        return !empty($result) ? $result : [];
    }

    public static function insert($aData)
    {
        $sql = "INSERT INTO `DoAn`(`ID`, `IDGV`, `TenDA`, `MoTA`, `DinhKem`, `CreateDate`) VALUES (null ," .
            $aData['IDGV'] . ",'" . $aData['TenDA'] . "','" . $aData['MoTA'] . "','" . $aData['DinhKem'] . "',null)";
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
        if ($aData['MoTA'] ?? '') {
            $query [] = " MoTA = '" . $aData['MoTA'] . "'";
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

    public function getFields($id, $field)
    {
        $result=DB::Connect()->query("SELECT ".$field." FROM DoAn WHERE ID=" . $id . " ");
        return (!empty($result)) ? ($result->fetch_assoc())[$field] : '';
    }
}