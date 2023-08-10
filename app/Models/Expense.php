<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    protected $fillable = ['date', 'amount', 'description', 'categorie_id', 'user_id'];

    function category():BelongsTo{
        return $this->belongsTo(Category::class,'categorie_id');
    }
}
