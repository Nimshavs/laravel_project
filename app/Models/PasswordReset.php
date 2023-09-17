<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    public $table = "password_reset_tokens";
    public $timestamps = false;

    protected $primarykey = 'email';

    protected $filltable = [
        'email',
        'token',
        'created_at'
    ];
}