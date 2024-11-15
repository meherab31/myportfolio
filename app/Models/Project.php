<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'skill_category_id',
        'title',
        'description',
        'technologies',
        'github_link',
        'live_demo_link',
        'youtube_url',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skillCategory()
    {
        return $this->belongsTo(SkillCategory::class);
    }
}
