<?php
namespace App\Validation;

class ValidateMediafireURL
{
    public function mediafire_url($url)
    {
        return strpos($url, 'https://www.mediafire.com/') !== false;
    }
}
