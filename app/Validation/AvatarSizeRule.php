<?php
namespace App\Validation;

class AvatarSizeRule
{
    public function avatar_size_valid($avatar)
    {
        if (empty($avatar)) {
            return true; // No file was uploaded, so it's not an error.
        }

        if ($avatar->getSize() <= 5 * 1024 * 1024) {
            return true;
        }

        return false; // File does not meet the criteria.
    }
}
