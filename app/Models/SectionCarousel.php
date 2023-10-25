<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionCarousel extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_page_id',
        'component_id',
    ];

    public function section()
    {
        return $this->belongsTo(WebsitePageSection::class, 'id', 'section_id');
    }

    public function slides()
    {
        return $this->hasMany(SectionCarouselSlide::class);
    }

    public function options()
    {
        return $this->hasManyThrough(
            SectionOption::class,
            WebsitePageSection::class,
            'id',
            'website_page_section_id',
            'id',
            'section_id'
        );
    }
}
