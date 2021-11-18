<?php

namespace App\Http\Controllers;

use App\Models\Passings;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class QuizController extends Controller
{
    public function create()
    {
        $this->saveNickname();
        $questionCount = Config::get('app.questionCount');
        return view('quizes.index',[
            'questions' => Question::inRandomOrder()->take($questionCount)->get(),
            'respond_chars' => ['a','b','c'], // need to replace with something normal
        ]);

    }

    public function saveNickname()
    {
        $passing = new Passings;
        $passing->nickname = request('nickname');
        $passing->total_answers = 10;
        $passing->save();
//        $passing = Passings::create([
//            'nickname' => \request('nickname'),
//            'total_answers' => 10,
//        ]);

    }

    public function index()
    {
        $questionCount = Config::get('app.questionCount');
        return view('quizes.index',[
//            'questions' => Question::inRandomOrder()->take($questionCount)->get(),
            'questions' => Question::take($questionCount)->get(),
            'respond_chars' => ['a','b','c'],
        ]);
    }
}
