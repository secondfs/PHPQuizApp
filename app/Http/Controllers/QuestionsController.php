<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use function MongoDB\BSON\toJSON;

class QuestionsController extends Controller
{

    protected $correctAnswers = 0;
    protected $currentQuestion = 1;
    protected $isLastQuestion = false;

    // todo save and increment correct answers
    public function handleAnswers(int $id, Request $request)
    {

//        $request->input('answer');
//        $requestAnswer = request()->answer;
//
//
//        $question = Question::firstWhere('id',$id);
//        $correctAnswers = [];
//        foreach ($question->answers as $key => $answer) {
//            if($answer->is_correct == 1) {
//                $this->correctAnswers = $key;
//            }
//        }
//
//        if( $this->isCorrect($requestAnswer) ) {
//            $this->correctAnswers++;
//        }
//
//        $this->currentQuestion++;
//        if(!$this->isLastQuestion() ) {
//            return response( 'ok',200);
//
//        }
//        $this->isLastQuestion = true;
//
//        $response = [
//            'correctAnswers' => $this->correctAnswers,
//            'isLastQuestion' => $this->isLastQuestion,
//
//        ];
//        return response( json_encode($response),200);
        return response()->json(["a" => "b"],200)->withCallback($request->input('callback'));

    }

    public function isLastQuestion()
    {
        return $this->currentQuestion === (Config::get('app.questionCount') - 1) ? true : false;
    }

    public function isCorrect($requestAnswer)
    {


        return  $this->correctAnswers === $requestAnswer ?  true : false;
    }


}
