<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionHeading extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_page_id',
        'component_id',
    ];
}
