<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorRequest extends Model
{
    use HasFactory;

    protected $fillable = ['alumni_id', 'status'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Define the relationship to the Alumni model
    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }

    // Define the relationship to the MentorshipOffer model (assuming there's a model for the offer)
    public function mentorshipOffer()
    {
        return $this->belongsTo(MentorshipOffer::class);
    }
}
