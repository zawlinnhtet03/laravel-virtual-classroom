<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizSubmission extends Model
{
    protected $fillable = ['quiz_attempt_id', 'question_id', 'selected_option', 'is_correct'];

    public function attempt()
    {
        return $this->belongsTo(QuizAttempt::class, 'quiz_attempt_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id'); // Adjust 'student_id' if needed
    }
}


