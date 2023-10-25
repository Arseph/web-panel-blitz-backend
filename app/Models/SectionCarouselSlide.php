<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionCarouselSlide extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_carousel_id',
        'media_id',
        'text',
        'backgroundColor',
    ];

    protected $with = [
        'media'
    ];

    public function carousel()
    {
        return $this->belongsTo(SectionCarousel::class, 'section_carousel_id', 'id');
    }

    public function media()
    {
        return $this->hasOne(Media::class, 'id', 'media_id');
    }
}
