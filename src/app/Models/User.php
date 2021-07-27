<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'date_of_birth',
        'is_active',
        'phone_number',
    ];

    protected $hidden = [];

    public function phone()
    {
        return $this->hasOne(PhoneNumber::class);
    }
}
