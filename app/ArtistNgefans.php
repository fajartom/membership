<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class ArtistNgefans extends Model
{
    protected $table = 'artist_ngefans';
    
    protected $fillable = [
        'title', 'subtitle', 'image', 'order', 'btn_link', 'btn_name', 'author', 'lang', 'domain'
    ];
}
