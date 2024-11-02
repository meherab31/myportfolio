<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'user_id',
        'bio',
        'address',
        'phone',
        'image',
    ];

    //relation with user model
    public function user(){
        return $this->belongsTo(User::class);
    }
}
