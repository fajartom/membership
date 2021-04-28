<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Fitur extends Model
{
    protected $table = 'fitur';
    
    protected $fillable = [
        'name', 'content', 'icon', 'order', 'author', 'domain', 'lang'
    ];
}
