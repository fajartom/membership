<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Member extends Model
{
    protected $table = 'master_member';
    
    protected $fillable = [
        'name', 'description', 'domain', 'author', 'lang'
    ];

    public function periode()
    {
        return $this->hasMany('App\UserMemberPeriode', 'member_id', 'id');
    }
}
