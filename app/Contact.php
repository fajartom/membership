<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
#use App\Scopes\QueryScope;

class Contact extends Model
{
	protected $guarded = [];
    protected $table = 'contact';

    protected $fillable = [
        'phone_number', 
        'facebook', 
        'instagram', 
        'youtube', 
        'address', 
        'twitter', 
        'medium', 
        'author', 
        'email', 
        'spotify', 
        'domain', 
        'title', 
        'lang'
    ];

    /*protected static function boot() {
        parent::boot();
        static::addGlobalScope(new QueryScope);
    }*/
}
