<?php

namespace App\Models;

use App\Models\User;
use App\Models\MentorshipOffer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MentorshipAcceptance extends Model
{
    use HasFactory;

    protected $fillable = ['mentorship_offer_id', 'student_id'];

    public function mentorshipOffer()
    {
        return $this->belongsTo(MentorshipOffer::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
