<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteDetail extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $hidden = [
        'website_id',
        'created_at',
        'updated_at',
    ];

    protected $with = [
        'domain',
        'locations',
    ];

    public function website()
    {
        return $this->hasOne('App\Models\Website', 'id', 'website_id');
    }

    public function domain()
    {
        return $this->hasOne('App\Models\WebsiteDetailDomain', 'website_detail_id', 'id');
    }

    public function locations()
    {
        return $this->hasMany('App\Models\WebsiteDetailLocation', 'website_detail_id', 'id');
    }
}
