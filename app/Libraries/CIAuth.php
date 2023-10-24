<?php
namespace App\Libraries;

class CIAuth
{
    public static function setCIAuthAdmin($result)
    {
        $session = session();
        $array = ['adminIsLoggedIn' => true];
        $adminData = $result;
        $session->set('adminData', $adminData);
        $session->set($array);
    }

    public static function adminId()
    {
        $session = session();
        if ($session->has('adminIsLoggedIn')) {
            if ($session->has('adminData')) {
                return $session->get('adminData')->id;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public static function checkAdmin()
    {
        $session = session();
        if ($session->has('adminIsLoggedIn')) {
            return true;
        } else {
            return false;
        }
    }

    public static function forgetAdmin()
    {
      $session = session();
      $session->remove('adminIsLoggedIn');
      $session->remove('adminData');
    }
}
