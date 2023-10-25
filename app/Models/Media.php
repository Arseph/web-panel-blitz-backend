<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'media_id',
        'provider_src',
        'src',
        'provider',
        'mediaType',
        'altText',
    ];

    public function slides()
    {
        return $this->morphedByMany(SectionCarouselSlide::class, 'section_media');
    }
}
