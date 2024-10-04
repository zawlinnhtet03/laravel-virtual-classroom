<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id', 
        'full_name',
        'gender',
        'date_of_birth',
        'roll',
        'blood_group',
        'religion',
        'email',
        'class',
        'section',
        'admission_id',
        'phone_number',
        'upload',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'created_by');
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class, 'student_id');
    }

}
