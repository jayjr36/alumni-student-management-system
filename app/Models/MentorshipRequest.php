<?php

namespace App\Models;

use App\Models\User;
use App\Models\MentorshipOffer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MentorshipRequest extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'mentorship_offer_id'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function mentorshipOffer()
    {
        return $this->belongsTo(MentorshipOffer::class, 'mentorship_offer_id');
    }
}
