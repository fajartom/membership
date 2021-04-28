<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
#use App\Scopes\QueryScope;

class Media extends Model
{
    protected $table = 'media';
    
    protected $fillable = [
        'file', 'link', 'author', 'domain', 'order', 'album'
    ];

    /*protected static function boot() {
        parent::boot();
        static::addGlobalScope(new QueryScope);
    }*/
}
