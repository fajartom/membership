<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PostRoles extends Model
{
    protected $table = 'post_roles';
    
    protected $fillable = ['type', 'id_post', 'role_member'];
}
