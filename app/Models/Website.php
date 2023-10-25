<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;
    protected $table = 'websites';

    protected $fillable = [
        'user_id',
        'name'
    ];

    protected $hidden = [
        'user_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function details()
    {
        return $this->hasOne(WebsiteDetail::class, 'website_id', 'id');
    }

    public function pages()
    {
        return $this->hasMany(WebsitePage::class, 'website_id', 'id');
    }
}
