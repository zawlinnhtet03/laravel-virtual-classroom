<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'subject_id',
        'created_by',   
        'attachment',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'created_by');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    protected $casts = [
        'due_date' => 'datetime',
    ];
}

