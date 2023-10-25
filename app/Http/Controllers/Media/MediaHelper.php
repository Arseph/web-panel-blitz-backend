<?php

namespace App\Http\Controllers\Media;

use App\Models\Media;

class MediaHelper
{
    public static function save($media)
    {
        return Media::create([
            'media_id' => $media['id'],
            'provider_src' => $media['src'],
            'src' => $media['src'],
            'provider' => $media['provider'],
            'mediaType' => $media['mediaType'],
            'altText' => $media['altText'],
        ]);
    }
}