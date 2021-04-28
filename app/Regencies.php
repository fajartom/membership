<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Regencies extends Model
{
    protected $table = 'regencies';

    protected $fillable = [
        'name'
    ];
}
