<?php
namespace App\Libraries;

class Hash
{
    public static function make($password)
    {
        return md5($password);
    }

    public static function check($password, $dbPassword)
    {
      $encrypt = md5($password);
        if ($encrypt == $dbPassword) {
            return true;
        } else {
            return false;
        }
    }
}
