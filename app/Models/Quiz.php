<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'start_time', 'end_time', 'created_by'];

    public function submissions()
    {
        return $this->hasMany(QuizSubmission::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'created_by');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }


    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
}

