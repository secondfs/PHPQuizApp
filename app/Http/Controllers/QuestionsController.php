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
    public function handleAnswers(int $id, Request $request)
    {

        $requestAnswer = request()->answer;
        $quiz = Passings::where('nickname',request()->nickname)->first();
        $currentQuestion = $quiz->current_question;



        $question = Question::firstWhere('id',$id);
        foreach ($question->answers as $key => $answer) {
            if($answer->is_correct == 1) {
                $this->correctAnswers[] = $key ;
            }
        }



        if( $this->isCorrect($requestAnswer) ) {
            $quiz->correct_answers++;
            $quiz->save();
        }

        $quiz->current_question++;
        $quiz->save();

//        \Debugbar::info($currentQuestion.' current');
//        \Debugbar::info($this->correctAnswers);
//        \Debugbar::info($quiz->correct_answers.' correct');
//        \Debugbar::info($requestAnswer);
//        \Debugbar::info($this->isCorrect($requestAnswer));
        $response = [
//                'currentQuestion' => $quiz->current_question,
            'correctAnswers' => $quiz->correct_answers,
            'isLastQuestion' => false,
        ];

        if(!$this->isLastQuestion($currentQuestion) ) {
            return response()->json($response,200);
        }

        $this->isLastQuestion = true;
        return response()->json($response,200);

    }

    public function isLastQuestion($currentQuestion)
    {
        return $currentQuestion === Config::get('app.questionCount') ? true : false;
    }

    public function isCorrect($requestAnswer)
    {
        return  $this->correctAnswers === $requestAnswer ?  true : false;
    }


}
