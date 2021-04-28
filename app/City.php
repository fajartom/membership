<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class City extends Model
{
    protected $table = 'provinces';

    protected $fillable = [
        'name', 'province_id'
    ];
}
