<?php

namespace App\Http\Controllers;

use App\Models\Passings;
use App\Models\Question;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Debug\Debug;

class QuestionsController extends Controller
{
    /**
     * @var array
     */
    protected $correctAnswers = [];
    /**
     * @var bool
     */
    protected $isLastQuestion = false;

    /**
     * @param Passings $quiz
     * @param Question $question
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleAnswers(Passings $quiz, Question $question, Request $request)
    {
        $response = [];
        $currentQuestion = $quiz->answers_count;

        $this->getCorrectAnswers($question);


        $response += [
            'answersCount' => $quiz->answers_count,
            'correctAnswersCount' => $quiz->correct_answers,
            'isLastQuestion' => $this->isLastQuestion($currentQuestion),
            'correctAnswers' => $this->correctAnswers,
        ];
        //todo find lib to transform camel case to other cases

        if( $this->isCorrect($request->answer, $this->correctAnswers) ) {

            $quiz->correct_answers++;
            $quiz->save();
        }

        $quiz->answers_count++;
        $quiz->save();

        return response()->json($response,200);
    }

    /**
     * @param int $currentQuestion
     * @return bool
     */
    public function isLastQuestion(int $currentQuestion): bool
    {
        return $currentQuestion === Config::get('app.questionCount');
    }


    /**
     * @param array $requestAnswer
     * @param $correctAnswer
     * @return bool
     */
    public function isCorrect(array $requestAnswer, $correctAnswer): bool
    {
        return  $this->correctAnswers === $requestAnswer;
    }

    /**
     * @param Question $question
     */
    public function getCorrectAnswers(Question $question): void
    {
        foreach ($question->answers as $answer) {
            if ($answer->is_correct) {
                $this->correctAnswers += [$answer->id];
            }
        }
    }


}
