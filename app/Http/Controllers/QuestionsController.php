<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class QuestionsController extends Controller
{
    public function isCorrect($id)
    {

        $requestAnswer = request()->answer;


        $question = Question::firstWhere('id',$id);
        $correct_answers = [];
        foreach ($question->answers as $key => $answer) {
            if($answer->is_correct == 1) {
                $correct_answers[] = $key;
            }
        };
        $response = ($correct_answers == $requestAnswer) ?  1 : 0;

        return response($response,200);
    }

    public function test($id)
    {
        $question = Question::firstWhere('id',$id);
        $correct_answers = [];
        foreach ($question->answers as $key => $answer) {
            if($answer->is_correct == 1) {
                $correct_answers[] = $key;
            }
        };

        dd($correct_answers);
    }

}
