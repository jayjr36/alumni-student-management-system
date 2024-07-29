<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorMentee extends Model
{
    use HasFactory;


    protected $fillable = ['mentor_id', 'student_id', 'status'];

    protected $table = 'mentor_mentee';

    public function mentor()
    {
        return $this->belongsTo(Alumni::class, 'mentor_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
