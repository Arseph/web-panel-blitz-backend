<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionClimber extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_page_id',
        'text',
    ];
}
