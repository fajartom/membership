<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
#use App\Scopes\QueryScope;

class Info extends Model
{
    protected $table = 'info';
    
    protected $fillable = [
        'name', 'content', 'slug', 'order', 'author', 'lang', 'domain', 'excerpt'
    ];

    /*protected static function boot() {
        parent::boot();
        static::addGlobalScope(new QueryScope);
    }*/
}
