<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    protected $table = 'benefit';
    
    protected $fillable = [
        'benefit', 'domain', 'author', 'lang'
    ];
    /* protected $casts = [
    	'benefit' => 'array',
    ];*/
}
