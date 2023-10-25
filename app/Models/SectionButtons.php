<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionButtons extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_page_section_id',
        'parameter',
        'value',
        'datatype',
    ];
}
