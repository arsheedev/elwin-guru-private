<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['day', 'clock', 'teacher_id', 'is_available'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}
