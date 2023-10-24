<?php

use App\Libraries\CIAuth;
use Config\Services;

if (!function_exists('getUser')) {
    function getUser()
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
}
