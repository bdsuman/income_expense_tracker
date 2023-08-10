<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['firstName','lastName','email','mobile','password','otp'];
    protected $attributes = [
        'otp' => '0'
    ];

    function category():HasMany{
        return $this->hasMany(Category::class);
    }
    function income():HasMany{
        return $this->hasMany(Income::class);
    }
    function Expense():HasMany{
        return $this->hasMany(Expense::class);
    }
}
