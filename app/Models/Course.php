<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'level',
        'price',
        'duration',
        'day_time',
        'image',
        'instructor_id',
        'course_category_id',
        'course_level_id',
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }

    public function level()
    {
        return $this->belongsTo(CourseLevel::class, 'course_level_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'registrations');
    }
}
