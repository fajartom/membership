<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
#use App\Scopes\QueryScope;

class Slider extends Model
{
    protected $table = 'slider';
    
    protected $fillable = [
        'title', 'subtitle', 'image', 'order', 'btn_link', 'btn_name', 'author', 'domain', 'lang'
    ];

    /*protected static function boot() {
        parent::boot();
        static::addGlobalScope(new QueryScope);
    }*/
}
