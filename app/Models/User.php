<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "first_name",
        "last_name",
        "address",
        "postcode",
        "phone_number",
        "email",
        "username",
        "password",
        "role"
    ];

    protected $hidden = [
        "password"
    ];

    protected $casts = [
        "password" => "hashed"
    ];
}
