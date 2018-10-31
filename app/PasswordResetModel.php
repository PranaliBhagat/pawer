<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordResetModel extends Model
{
    protected $table = 'password_resets'; // table name
   // public $timestamps = false;
    protected $fillable = [
        'email', 'token'
    ];
}
