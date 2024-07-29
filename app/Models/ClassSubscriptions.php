<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubscriptions extends Model
{
    use HasFactory;

    protected $fillable = ['class_id', 'student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function classModel()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
