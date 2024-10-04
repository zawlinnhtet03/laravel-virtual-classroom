<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    protected $fillable = ['quiz_id', 'student_id', 'started_at', 'completed_at', 'score'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    
    public function submissions()
    {
        return $this->hasMany(QuizSubmission::class);
    }

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];
}
