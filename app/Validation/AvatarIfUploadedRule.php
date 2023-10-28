<?php
namespace App\Validation;


class AvatarIfUploadedRule
{
  public function avatar_if_uploaded($avatar)
  {
      if (empty($avatar)) {
          return true; // No file was uploaded, so it's not an error.
      }

      // Check if the uploaded file is an image
      if (in_array(mime_content_type($avatar), ['image/jpeg', 'image/png', 'image/gif'])) {
          return true;
      }

      return false; // File is not a valid image.
  }
}