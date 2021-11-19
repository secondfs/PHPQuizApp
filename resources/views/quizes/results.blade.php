<x-layout>
    <div class="container">
        <div class="leaderboard">
            <div class="head">
                <i class="fas fa-crown"></i>
            </div>
            <div class="body">
                <ol>
                    <li>
                        <mark>{{ $passing->nickname }}</mark>
                        <mark> {{ $passing->correct_answers  }}/{{ Config::get('app.questionCount') }}</mark>
                        <small> {{  date("d-m-Y", strtotime($passing->created_at))  }}</small>
                    </li>

                    @foreach($all as $user )
                        <li class="{{ $user->nickname == $passing->nickname ? "bg-success" : ''}}">
                            <mark>{{ $user->nickname }}</mark>
                            <mark> {{ $user->correct_answers ?? 0 }}/{{ Config::get('app.questionCount') }}</mark>
                            <small> {{  date("d-m-Y", strtotime($user->created_at))  }}</small>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>

    <div>
        <div class="leaderboard">

            <div class="body">
                <p>Your have {{ $passing->correct_answers }} correct answers from {{ Config::get('app.questionCount') }} </p>
            </div>
        </div>
    </div>
    @push('quizJs')
{{--        <script src="/quiz.js" defer></script>--}}
        <link rel="stylesheet" href="/quizLeaderboard.css">
    @endpush
</x-layout>

