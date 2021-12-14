<x-layout>
    <div id="question-all" data-questionCount="{{ Config::get('app.questionCount') }}" data-nickname="{{ $nickname }}">
        @foreach($questions as $question)
            <div class="container mt-5 question-block">
                <span class="hidden question_id" data-question-id="{{ $question->id }}"></span> {{-- change this later --}}
                <div class="d-flex justify-content-center row">
                    <div class="col-md-10 col-lg-10">
                        <div class="border">
                            <div class="question bg-white p-3 border-bottom">
                                <div class="d-flex flex-row justify-content-between align-items-center mcq">
                                    <h4>PHP Quiz</h4><span>( {{ $loop->iteration }} of {{ Config::get('app.questionCount') }}</span>
                                </div>
                            </div>
                            <div class="question bg-white p-3 border-bottom">
                                <div class="d-flex flex-row align-items-center question-title">
                                    <h3 class="text-danger">Q.</h3>
                                    <h5 class="mt-1 ml-2">{{ $question->title }}</h5>
                                </div>
                                @foreach($question->answers as $answer)
                                    <div class="ans mt-2 ml-2">
                                        <button data-choise="{{ $answer->id }}"class="checkbox d-flex">
                                        <span class="respond-char py-2 px-3 mr-2 my-2">
                                            {{ strtoupper($respond_chars[$loop->index]) }}
                                        </span>
                                            <span>
                                        {{ $answer->answer }}$
                                        </span>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white">
                                <button class="btn btn-primary border-success align-items-center btn-success" type="button">Next<i class="fa fa-angle-right ml-2"></i></button>
                            </div>
{{--                            <div class="question bg-white p-3 border-bottom">--}}
{{--                                <h3>Right answer is </h3>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @push('quizJs')
        <script src="/quiz.js" defer></script>
            <link rel="stylesheet" href="/quizUnit.css">
    @endpush
</x-layout>

