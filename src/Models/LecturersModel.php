<?php


namespace ManageFile\Models;


use ManageFile\Database\DB;

class LecturersModel
{
    public static function isLecturersExist($id): bool
    {
        return !empty(self::getFields($id, 'ID'));
    }

    public static function getFields($id, $field)
    {
        $result = DB::Connect()->query("SELECT " . $field . " FROM GiangVien WHERE ID=" . $id . " ");
        return (!empty($result->num_rows)) ? ($result->fetch_assoc())[$field] : '';
    }

    public static function getOneGV($id): array
    {
        $result = DB::Connect()->query("SELECT * FROM GiangVien WHERE ID=" . $id . " ");
        return (!empty($result->num_rows)) ? ($result->fetch_assoc()) : [];
    }

    public static function insert($aData)
    {
        $sql="INSERT INTO `GiangVien`(`ID`, `TenGV`, `DiaChi`, `SDT`, `Khoa`, `CreateDate`) VALUES (null,'".$aData['TenGV']."','".$aData['DiaChi']."','".$aData['SDT']."','".$aData['Khoa']."',null)";
        return DB::Connect()->query($sql);
    }
    public static function getAll($id='',$limit=1,$page=1)
    {
        $aRawWhere='';
        $start = ($page - 1) * $limit;
        if (!empty($id)) {
            $aRawWhere= "WHERE ID =" . $id;
        }
        $sql=sprintf("SELECT * FROM GiangVien ".$aRawWhere." ORDER BY CreateDate DESC LIMIT %d,%d",$start,$limit);
        $result = DB::Connect()->query($sql);
        return !empty($result) ? $result->fetch_all() : [];
    }
    public static function countProject():int
    {
        $result = DB::Connect()->query("SELECT count(ID) as ID FROM GiangVien")->fetch_assoc();
        return !empty($result) ?(int) $result['ID'] : 0;
    }
}