<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    protected $fillable = ['firstName','lastName','email','mobile','password','otp'];
    protected $attributes = [
        'otp' => '0'
    ];
}
