<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = ['mentor_id', 'title', 'description'];

    public function mentor()
    {
        return $this->belongsTo(Alumni::class, 'mentor_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(ClassSubscriptions::class, 'class_id');
    }
}
