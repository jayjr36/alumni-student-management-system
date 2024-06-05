<?php

namespace App\Models;

use App\Models\User;
use App\Models\MentorshipAcceptance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MentorshipOffer extends Model
{
    use HasFactory;

    protected $fillable = ['alumni_id', 'title', 'description'];

    public function alumni()
    {
        return $this->belongsTo(User::class, 'alumni_id');
    }

    public function acceptances()
    {
        return $this->hasMany(MentorshipAcceptance::class);
    }
}
