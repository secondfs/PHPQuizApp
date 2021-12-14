<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Passings
 * @package App\Models
 * @property string $currentQuestion
 */
class Passings extends Model
{
    // todo find library for highlate model properties
    protected $fillable = [
        'nickname',
        'correct_answers',
    ];

    public $timestamps = false;

    use HasFactory;
}
