<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
#use App\Scopes\QueryScope;

class Other extends Model
{
    protected $table = 'other';
    
    protected $fillable = [
        'name', 'content', 'slug', 'order', 'author', 'lang', 'domain'
    ];

    /*protected static function boot() {
        parent::boot();
        static::addGlobalScope(new QueryScope);
    }*/
}
