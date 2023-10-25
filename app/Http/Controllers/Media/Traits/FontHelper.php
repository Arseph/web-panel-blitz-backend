<?php

namespace App\Http\Controllers\Media\Traits;

/**
 * Helper trait for anything font
 */
trait FontHelper
{
    public function isValidFont($fontname)
    {
        $fontValidator = '/^[.a-zA-z0-9_-]*\.(eot|ttf|otf|woff|woff2)$/';
        return preg_match($fontValidator, $fontname);
    }
}