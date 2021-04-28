<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
#use App\Scopes\QueryScope;

class Post extends Model
{
    protected $table = 'post';
    
    protected $fillable = [
        'title', 'excerpt', 'seo_title', 'body', 'image', 'order', 'btn_link', 'btn_name', 'author', 'category_id', 'image', 'slug', 'lang', 'author', 'domain', 'meta_description', 'meta_keywords', 'status', 'member_allow', 'featured', 'album'
    ];

    protected $casts = [
    	'member_allow' => 'array',
        'album'=>'array'
    ];
   /* protected static function boot() {
        parent::boot();
        static::addGlobalScope(new QueryScope);
    }*/
}
