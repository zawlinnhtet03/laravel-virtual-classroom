<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // Specify the attributes that are mass assignable
    protected $fillable = ['quiz_id', 'question', 'options', 'correct_answer'];

    // Cast JSON attributes to array for easier handling
    protected $casts = [
        'options' => 'array',
        'correct_answer' => 'integer',
    ];

    // Define the relationship with the Quiz model
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // // Define the relationship with the Answer model
    // public function answers()
    // {
    //     return $this->hasMany(Answer::class);
    // }

    public function submissions()
    {
        return $this->hasMany(QuizSubmission::class);
    }
}
