<?php  
namespace App\Validation;

class isContactNum 
{
  public function is_contact_num($contact) {
    $contact = trim($contact);

    if(!preg_match('/^9\d{9}$/', $contact)) {
      return false;
    } 

    return true;
  }
}