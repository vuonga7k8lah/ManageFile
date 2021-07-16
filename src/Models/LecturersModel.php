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

    public static function getOneGV($id):array
    {
        $result=DB::Connect()->query("SELECT * FROM GiangVien WHERE ID=" . $id . " ");
        return (!empty($result->num_rows)) ? ($result->fetch_assoc()) : [];
    }
}