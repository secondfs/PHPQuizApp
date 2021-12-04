<?php

namespace App\Http\Controllers;

use App\Models\Passings;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

/**
 * Class PassingsController
 * @package App\Http\Controllers
 */
class PassingsController extends Controller
{

    /**
     * @param $nickname
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function save($nickname)
    {
        $correctAnswers = request('correct_answers');
        $passings = Passings::query()->where('nickname', $nickname)->findOrFail();
        $passings->correct_answers = $correctAnswers;
        $passings->save();

        return response('save',200);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
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

    /**
     *
     */
    public function saveNickname()
    {
        $passing = new Passings;
        $passing->nickname = request('nickname');
        $passing->total_answers = 10;//todo change this to config
        $passing->save();
//        $passing = Passings::create([
//            'nickname' => \request('nickname'),
//            'total_answers' => 10,
//        ]);
    }

    /**
     * @param $nickname
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($nickname)
    {
        $all = Passings::query()->orderByDesc('correct_answers')->take(5);
//        dd($all);
        $passing = Passings::query()->where('nickname',$nickname)->firstOrFail();
        return view('quizes.results',[
            'passing' => $passing,
            'all' => $all,
        ]);
    }

}
