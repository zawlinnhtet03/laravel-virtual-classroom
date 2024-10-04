<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher_id',
        'full_name',
        'email',
        'gender',
        'date_of_birth',
        'mobile', 
        'address',
        'city',
    
    ];

    // Relationship with assignments
    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'created_by');
    }
}
