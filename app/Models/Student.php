<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'regNumber', 'year', 'major', 'bio', 'profile_picture'];

    public function mentors()
    {
        return $this->belongsToMany(Alumni::class, 'mentor_mentee', 'student_id', 'mentor_id')->withPivot('status');
    }
}
