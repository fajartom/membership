<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMemberPeriode extends Model
{
    protected $table = 'master_member_periode';
    
    protected $fillable = [
        'periode', 'amount', 'member_id'
    ];

    public function master_member()
    {
        return $this->belongsTo('App\Member', 'member_id');
    }
}
