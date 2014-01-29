<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    if ( ! function_exists('filesize_to_mb'))
    {
        function filesize_to_mb($bytes, $precision = 2)
        {

            $mb = round(($bytes * .0009765625) * .0009765625,$precision);
            return $mb." MB";
        }
    }