<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Transaction extends Model
{
    protected $table = 'payment';

    protected $fillable = [
        'invoice', 'user_id', 'name', 'email', 'member_id', 'member_name', 'artist_id', 'artist_name', 'status_payment', 'payment_method_id', 'payment_method_name', 'periode', 'date_entry', 'date_pay', 'date_end', 'amount', 'unique_code', 'total_amount', 'reff_id'
    ];
}
