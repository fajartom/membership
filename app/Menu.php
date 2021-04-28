<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
#use App\Scopes\QueryScope;

class Menu extends Model
{
    protected $table = 'menu';
    
    protected $fillable = [
        'order', 'author', 'name', 'slug', 'domain', 'lang', 'seo_title', 'meta_keyword', 'meta_description'
    ];

   /* protected static function boot() {
        parent::boot();
        static::addGlobalScope(new QueryScope);
    }*/
}
