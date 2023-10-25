<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_page_id',
        'heading',
    ];
}
