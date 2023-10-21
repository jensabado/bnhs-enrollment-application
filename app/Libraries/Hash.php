<?php
namespace App\Libraries;

class Hash
{
    public static function make($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
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
