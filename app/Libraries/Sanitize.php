<?php
namespace App\Libraries;

class Sanitize
{
    public static function sanitize($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = $this->sanitize($value);
            }
        } else {
            switch (gettype($data)) {
                case 'string':
                    $data = filter_var($data, FILTER_SANITIZE_STRING);
                    break;
                case 'integer':
                    $data = filter_var($data, FILTER_SANITIZE_NUMBER_INT);
                    break;
                case 'float':
                    $data = filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    break;
                case 'boolean':
                    $data = filter_var($data, FILTER_VALIDATE_BOOLEAN);
                    break;
                case 'object':
                    foreach ($data as $key => $value) {
                        $data->$key = $this->sanitize($value);
                    }
                    break;
            }
        }

        return $data;
    }
}
