<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsitePageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_page_id',
        'order',
        'section_id',
        'section_type',
        'component_type',
    ];

    public function section()
    {
        switch($this->section_type) {
            case 'heading':
                return $this->hasOne(SectionHeading::class, 'id', 'section_id');

            case 'banner':
                return $this->hasOne(SectionBanner::class, 'id', 'section_id');
                
            case 'carousel':
                return $this->hasOne(SectionCarousel::class, 'id', 'section_id')->with(['slides']);

            default:
                return null;
        }
    }

    public function titles()
    {
        return $this->hasMany(SectionTitle::class);
    }

    public function subtitles()
    {
        return $this->hasMany(SectionSubtitle::class);
    }

    public function buttons()
    {
        return $this->hasMany(SectionButtons::class);
    }

    public function options()
    {
        return $this->hasMany(SectionOption::class);
    }
}
