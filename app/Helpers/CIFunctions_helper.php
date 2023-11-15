<?php

use App\Libraries\CIAuth;
use Config\Services;

if (!function_exists('getUser')) {
    function getAdmin()
    {
        if (CIAuth::checkAdmin()) {
            $db = \Config\Database::connect();

            return $db->table('tbl_admin')
                ->where('id', CIAuth::adminId())
                ->where('is_deleted', 'no')
                ->get()->getRow();
        } else {
            return null;
        }
    }

    function getStudent()
    {
        if (CIAuth::checkStudent()) {
            $db = \Config\Database::connect();

            return $db->table('tbl_student')
            ->select('tbl_student.*, tbl_grade_level.grade')
            ->join('tbl_grade_level', 'tbl_student.grade_level_id = tbl_grade_level.id', 'left')
            ->where('tbl_student.id', CIAuth::studentId())
            ->where('tbl_student.is_deleted', 'no')
            ->get()
            ->getRow();
        } else {
            return null;
        }
    }
}
