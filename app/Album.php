<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Album extends Model
{
    protected $table = 'album';
    
    protected $fillable = [
        'name', 'image', 'author', 'domain', 'lang', 'description', 'slug'
    ];
}
