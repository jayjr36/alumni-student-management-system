<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'regNumber','graduation_year', 'degree', 'bio'];

    public function mentorRequests()
    {
        return $this->hasMany(MentorRequest::class);
    }

    public function mentees()
    {
        return $this->belongsToMany(Student::class, 'mentor_mentee', 'mentor_id', 'student_id')->withPivot('status');
    }

}
