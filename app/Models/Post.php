<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'title',
        'body',
        'date',
        'creator_name',
        'creator_email'
    ];


   
}
