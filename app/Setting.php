<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Setting extends Model
{
	protected $guarded = [];
    protected $table = 'contact_information';

    protected $fillable = [
        'name', 'user_id', 'artist_type_id', 'country', 'province', 'city', 
        'zipcode', 'address', 'dob', 'about', 'cover', 'photo', 'domain',
        'pob', 'gender', 'logo'
    ];
}
