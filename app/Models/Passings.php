<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passings extends Model
{
    protected $fillable = [
        'nickname',
        'correct_answers',
    ];

    public $timestamps = false;

    use HasFactory;
}
