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
    protected $correctAnswers = [];
    protected $isLastQuestion = false;
    // todo save and increment correct answers
    public function handleAnswers($id, Request $request)
    {
        $quiz = Passings::where('nickname',request()->nickname)->first();
        $currentQuestion = $quiz->current_question;
        $question = Question::firstWhere('id',$id);
        if( $this->isCorrect($request->answer,$question) ) {

            $quiz->correct_answers++;
            $quiz->save();
        }

        $quiz->current_question++;
        $quiz->save();


        $response = [
            'currentQuestion' => $quiz->current_question,
            'correctAnswers' => $quiz->correct_answers,
            'isLastQuestion' => false,
        ];

        if($this->isLastQuestion($currentQuestion) ) {
            $response['isLastQuestion'] = true;
            return response()->json($response,200);
        }

        return response()->json($response,200);
    }

    public function isLastQuestion(int $currentQuestion): bool
    {
        return $currentQuestion === Config::get('app.questionCount') ? true : false;
    }

    public function isCorrect(array $requestAnswer,Question $question): bool
    {
        foreach ($question->answers as $key => $answer) {
            if($answer->is_correct === 1) {
                $this->correctAnswers[] = $key ;
            }
        }

        return  $this->correctAnswers === $requestAnswer ?  true : false;
    }


}
