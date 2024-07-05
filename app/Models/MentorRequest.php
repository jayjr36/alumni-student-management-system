<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorRequest extends Model
{
    use HasFactory;

    protected $fillable = ['alumni_id', 'status'];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}
