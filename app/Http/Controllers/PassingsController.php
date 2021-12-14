<?php

namespace App\Http\Controllers;

use App\Models\Passings;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\ValidationException;

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
//    public function storeCorrectAnswer(Request $request)
//    {
//        $params = $this->validatePassing($request);
//
//
//
//        $passing = Passings::query()->where('nickname', $request->input('nickname'))->findOrFail();
//        $passing->correct_answers = $params['correct_answers'];
//        $passing->save();
//
//        return response('saved',200);
//    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $params = $this->validatePassing($request);
        $params['correct_answers'] = 0;


        Passings::create($params);

        $questionCount = Config::get('app.questionCount');

        return view('quizes.index',[
//            'questions' => Question::inRandomOrder()->take($questionCount)->get(),
            'questions' => Question::take($questionCount)->get(),
            'respond_chars' => ['a','b','c'], //todo make this better
            'nickname' => $params['nickname'],
        ]);

    }

    /**
     * @param $nickname
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($nickname)
    {
        $all = Passings::query()->orderByDesc('correct_answers')->take(5)->get();
        \Debugbar::info($all);
        $passing = Passings::query()->where('nickname',$nickname)->firstOrFail();
        return view('quizes.results',[
            'passing' => $passing,
            'all' => $all,
        ]);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function validatePassing(Request $request)
    {
        return $request->validate([
            'nickname' => 'required|unique:passings|alpha-num|between:4,20',
            'correct_answers' => 'nullable|json',
        ]);

    }

}
