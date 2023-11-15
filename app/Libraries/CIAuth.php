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

    public static function setCIAuthStudent($result)
    {
        $session = session();
        $array = ['studentIsLoggedIn' => true];
        $studentData = $result;
        $session->set('studentData', $studentData);
        $session->set($array);
    }

    public static function studentId()
    {
        $session = session();
        if ($session->has('studentIsLoggedIn')) {
            if ($session->has('studentData')) {
                return $session->get('studentData')->id;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public static function checkStudent()
    {
        $session = session();
        if ($session->has('studentIsLoggedIn')) {
            return true;
        } else {
            return false;
        }
    }

    public static function forgetStudent()
    {
      $session = session();
      $session->remove('studentIsLoggedIn');
      $session->remove('studentData');
    }
}
