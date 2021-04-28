<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class DataMember extends Model
{
    protected $table = 'data_member';

    protected $fillable = [
        'artist_id', 'member_id', 'user_id', 'status'
    ];
}
