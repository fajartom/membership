<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberBenefit extends Model
{
    protected $table = 'member_benefit';
    
    protected $fillable = [
        'member_id', 'benefit_id', 'domain', 'lang'
    ];
    /* protected $casts = [
    	'benefit' => 'array',
    ];*/
}
