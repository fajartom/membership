<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Email extends Model
{
    protected $table = 'email';
    
    protected $fillable = [
        'subject', 'content', 'author', 'lang', 'domain'
    ];

}
