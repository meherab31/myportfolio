<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_title',
        'company_name',
        'start_date',
        'end_date',
        'description',
    ];
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}