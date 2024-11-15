<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['category_id', 'name', 'percentage'];

    public function category()
    {
        return $this->belongsTo(SkillCategory::class, 'category_id');
    }
}
