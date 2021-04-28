<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Payment extends Model
{
    protected $table = 'master_payment';

    protected $fillable = [
        'name', 'description', 'domain', 'author', 'lang', 'logo'
    ];
}
