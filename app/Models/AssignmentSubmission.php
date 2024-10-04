<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'student_id',
        'submitted_at',
        'file_path',
        'grade',
        'feedback',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'created_by');
    }

    public function assignments()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }
}

