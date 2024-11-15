<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillCategory extends Model
{
    protected $fillable = ['name'];

    public function skills()
    {
        return $this->hasMany(Skill::class, 'category_id');
    }
}
