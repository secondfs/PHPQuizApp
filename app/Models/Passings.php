<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Passings
 *
 * @package App\Models
 * @property string $currentQuestion
 * @property int $id
 * @property string $nickname
 * @property int|null $correct_answers
 * @property int $total_answers
 * @property int $answers_count
 * @property string $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|Passings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Passings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Passings query()
 * @method static \Illuminate\Database\Eloquent\Builder|Passings whereAnswersCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passings whereCorrectAnswers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passings whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passings whereTotalAnswers($value)
 * @mixin \Eloquent
 */
class Passings extends Model
{
    // todo find library for typehinting model properties(done  (laravel-ide-helper) )
    protected $fillable = [
        'nickname',
        'correct_answers',
    ];

    public $timestamps = false;

    use HasFactory;
}
