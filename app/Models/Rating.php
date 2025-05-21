<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'student_id',
        'booking_id',
        'quality_teaching',
        'communication',
        'discipline',
        'teaching_method',
        'teaching_result',
        'comment',
    ];


    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

