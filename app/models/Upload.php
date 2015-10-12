<?php

namespace BITS;

/**
 * BITS Upload Services.
 *
 * Class to simply upload file with additional name and make new folder if not exist.
 * This script written with Object Oriented Style (PSR-2) and use static method.
 *
 * @author Nurul Imam
 *
 * @link https://bits.co.id Banten IT Solutions
 *
 * @version 1.1
 */
class Upload
{
    public function upload($file, $temp, $folder)
    {
        if (is_dir($folder) == false) {
            // Create folder if empty
            mkdir("$folder", 0755);
        }

        /*
         * Rename filename with additional date format to firstname
         * Replace space to "-".
         * @var string
         */
        $new = date('Y-m-d').'-'.strtolower(str_replace(' ', '-', $file));

        /*
         * Upload file if no exist.
         */
        if (is_dir("$folder/".$new) == false) {
            move_uploaded_file($temp, "$folder/".$new);
        }
    }
}
