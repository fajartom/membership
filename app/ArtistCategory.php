<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class ArtistCategory extends Model
{
    protected $table = 'artist_type';

    protected $fillable = [
        'type_artist', 'slug', 'lang', 'domain', 'author'
    ];
}
