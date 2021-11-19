<?php

namespace App\Http\Controllers;

use App\Models\Passings;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class PassingsController extends Controller
{

    public function save($id_or_nick)
    {
        $correctAnswers = request('correct_answers');
//        $user = User::where('id' , '=', $id_or_username)->orWhere('username', $id_or_username)->firstOrFail();
        $passings = Passings::where('id', $id_or_nick)->orWhere('nickname',$id_or_nick)->firstOrFail();
        $passings->correct_answers = $correctAnswers;
        $passings->save();

        return response('save',200);
    }

    public function create()
    {
        $this->saveNickname();
        $nickname = request('nickname');
        $questionCount = Config::get('app.questionCount');

        return view('quizes.index',[
//            'questions' => Question::inRandomOrder()->take($questionCount)->get(),
            'questions' => Question::take($questionCount)->get(),
            'respond_chars' => ['a','b','c'],
            'nickname' => $nickname,
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

    public function index($nickname)
    {
        $all = Passings::all()->sortByDesc('correct_answers')->take(5);
//        dd($all);
        $passing = Passings::where('nickname',$nickname)->first();
        return view('quizes.results',[
            'passing' => $passing,
            'all' => $all,
        ]);
    }

}
